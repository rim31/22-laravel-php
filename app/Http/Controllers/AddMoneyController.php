<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\Controller;
use App\UploadedFile;
use App\User;
use App\Package;
use App\Exp;
use App\Http\Requests;

use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use \Storage;
use File;
use DB;
use Auth;
use Carbon\Carbon;

/** All Paypal Details class **/
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;

class AddMoneyController extends Controller
{
    //=========variable d'entrée : user =============
    // user : compte client avec toutes les infos

    public function selectpayment(Request $request, User $user)
    {
        return view('payments/selectpayment', compact( 'users', 'request'));
    }


    //==========variable d'entrée : ==============
    // request : pour le message de retour et pour les infos du formaulaire de
    // paypal et la quantité de mois choisi pour le formulaire de paiment
    //setName, setCurrency, setQuantity, setSku, setPrice

    public function sendtopaypal(Request $request, User $users)
    {
//        var_dump($request);
//              var_dump($users);
      //  var_dump($request->packageSku);
      //  die();

//===========on enregistre le formulaire dans une variable car elle sera ecrasé par l'api Paypal
        $array = array(
            'packageName' => $request->packageName,
            'packageQuantity' => $request->packageQuantity,
            'packageSku' => $request->packageSku,
            'token' =>  hash_hmac('sha256', str_random(40), config('app.key')),
            'durationMonth' => $request->packageQuantity,
        );

        // var_dump($array['packageSku']);
        // die();
        $packagePayment = $request;


        //======================== A mettre dans App/config/paypal.php =====================
        $clientId = 'AR_48wA2cZSVJ28ES8gYOOsgQ0wYpVAFpSg3kg_UJsAyANWBvbUJ547B4BQj-mNAkqdPfLMUMWPS-8W_';
        $clientSecret = 'EAT-5BLRjC0F3Qrp95PR09qaZWk5o5my-PSThlrywlz4AnJDCDSu9Mmg-1v5X8aow4Klkuym-Z4j92hg';

        $apiContext = new ApiContext(
            new OAuthTokenCredential(
                $clientId,
                $clientSecret
            )
        );

        $apiContext->setConfig(
            array(
                'mode' => 'sandbox',
                'log.LogEnabled' => true,
                'log.FileName' => '../PayPal.log',
                'log.LogLevel' => 'DEBUG', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
                'cache.enabled' => true,

            )
        );



        $package = DB::table('packages')
            ->where('id', $request->packageSku)
            ->get();

        if ($packagePayment->packageQuantity <= 0 || empty($package)) {
            echo 'error quantity or package not found';
            die();
        }

        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $item1 = new Item();
        $item1->setName($package[0]->name)
            ->setCurrency($package[0]->currency)
            ->setQuantity($packagePayment->packageQuantity)// A CHANGER SELON LE FORMULAIRE REQUEST !!!
            ->setSku($package[0]->sku)// Similar to `item_number` in Classic API
            ->setPrice($package[0]->price);

        $itemList = new ItemList();
        $itemList->setItems(array($item1));

        $details = new Details();
        $details->setShipping($package[0]->shipping)
            ->setTax($package[0]->tax * $packagePayment->packageQuantity)
            ->setSubtotal($packagePayment->packageQuantity * $package[0]->price);

        $amount = new Amount();
        $amount->setCurrency($package[0]->currency)
            ->setTotal($packagePayment->packageQuantity * $package[0]->price + $package[0]->tax * $packagePayment->packageQuantity + $package[0]->shipping)
            ->setDetails($details);

//=======================================================================




        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber(uniqid());


        $baseUrl = url('/');
        $redirectUrls = new RedirectUrls();

        // @todo tu mets une route : paymentOk
        // @todo une route : la route courante + success = false, afficher bandeau utilisateur

            $mypayment_tmp = User::find(Auth::user()->id);
            //==============on rajoute le nombre de mois inséré dans le formulaire à partir du nombre de mois choisi=======
            if (!empty($mypayment_tmp)) {
                $mypayment_tmp->update([
                  'package_select' => $array['packageSku'],
                  'subscription_end' => Carbon::now()->addMonths($array['packageQuantity']),
                  'token_payment' => $array['token'],
                ]);
            } else {
              die('error update user table');
            }

        // $redirectUrls->setReturnUrl("$baseUrl/ExecutePayment.php?success=true")
        //     ->setCancelUrl("$baseUrl/ExecutePayment.php?success=false");
        $redirectUrls->setReturnUrl("$baseUrl/paymentdone")
            ->setCancelUrl("$baseUrl/paymentcancel");

        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));

        $request = clone $payment;

        try {
            $payment->create($apiContext);
        } catch (Exception $ex) {
            die('connexion impossible');
            //  ResultPrinter::printError("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", null, $request, $ex);
            exit(1);
        }

        $paypalUrl = $payment->getApprovalLink();

echo $paypalUrl;


        return view('payments/gotopayment', compact('paypalUrl', 'users', 'packagePayment', 'array'));
        //=========== Variable de sortie ==========
        //paypalUrl :  url de redirection de paypal
        //user, les infos de l'utilisateur (en cours)
        //array : le choix selectionné du package, nom, n°sku, quantity
    }





    //=========== Variable d'entrée ==========
    //Request :  pour le message de sortie
    public function paymentredirection(Request $request)
    {
        // @todo renommer cancel

//@todo à mettre dans la bdd
        $clientId = 'AR_48wA2cZSVJ28ES8gYOOsgQ0wYpVAFpSg3kg_UJsAyANWBvbUJ547B4BQj-mNAkqdPfLMUMWPS-8W_';
        $clientSecret = 'EAT-5BLRjC0F3Qrp95PR09qaZWk5o5my-PSThlrywlz4AnJDCDSu9Mmg-1v5X8aow4Klkuym-Z4j92hg';

        $apiContext = new ApiContext(
            new OAuthTokenCredential(
                $clientId,
                $clientSecret
            )
        );


        if (empty($_GET['paymentId'])) {
            // @todo rediriger vers hp // OK
            $request->session()->flash('alert-success', 'no payment');
            return view('/home', compact('request'));
        }

        $paymentId = $_GET['paymentId'];
        $payment = Payment::get($paymentId, $apiContext);

        var_dump($payment->state);
        var_dump($payment->transactions);
        var_dump($payment->item);
        var_dump($payment->id);
        if (['state'] === 'created') {
            // @todo met à jour la BDD
        }
        print_r($payment); exit;

        $success = Input::get('v');

        if ($success == "false") {
            $request->session()->flash('alert-success', 'Payment canceled !');
            return view('/home');
        }
        $request->session()->flash('alert-success', 'Test en fonction du get !');
        return view('/home');
    }





    //=========== Variable d'entrée ==========
    //Request :  pour le message de sortie
    public function paymentcancel(Request $request)
    {
      $token = Input::get('token');
      if (!empty($token)) {
        echo $token;
      }
        // @todo renommer cancel //OK
        if (empty($_GET['paymentId'])) {
            // @todo rediriger vers homepage // OK
            $request->session()->flash('alert-success', 'no payment, canceled');
            return view('/home', compact('request'));
        }
        if ($success == "false") {
            $request->session()->flash('alert-success', 'Payment canceled !');
            return view('/home');
        }
        $request->session()->flash('alert-success', 'Test en fonction du get !');
        return view('/home');
    }



//http://localhost/immo-vr/public/ExecutePayment.php?success=true&paymentId=PAY-1AK80745BE837853SLCXLEGA&token=EC-2Y289930CY0789300&PayerID=MD6LE9TQ7Y2FN
    public function paymentexec(Request $request)
    {
        //======================== A mettre dans App/config/paypal.php =====================
        $clientId = 'AR_48wA2cZSVJ28ES8gYOOsgQ0wYpVAFpSg3kg_UJsAyANWBvbUJ547B4BQj-mNAkqdPfLMUMWPS-8W_';
        $clientSecret = 'EAT-5BLRjC0F3Qrp95PR09qaZWk5o5my-PSThlrywlz4AnJDCDSu9Mmg-1v5X8aow4Klkuym-Z4j92hg';

        $apiContext = new ApiContext(
            new OAuthTokenCredential(
                $clientId,
                $clientSecret
            )
        );

        $apiContext->setConfig(
            array(
                'mode' => 'sandbox',
                'log.LogEnabled' => true,
                'log.FileName' => '../PayPal.log',
                'log.LogLevel' => 'DEBUG', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
                'cache.enabled' => true,
                // 'http.CURLOPT_CONNECTTIMEOUT' => 30
                // 'http.headers.PayPal-Partner-Attribution-Id' => '123123123'
                //'log.AdapterFactory' => '\PayPal\Log\DefaultLogFactory' // Factory class implementing \PayPal\Log\PayPalLogFactory
            )
        );
        //========================/A mettre dans App/config/paypal.php =====================



        if (isset($_GET['success']) && $_GET['success'] == 'true') {
            $paymentId = $_GET['paymentId'];
            $payment = Payment::get($paymentId, $apiContext);

            $execution = new PaymentExecution();
            $execution->setPayerId($_GET['PayerID']);

            $transaction = new Transaction();
            $amount = new Amount();
            $details = new Details();

            $details->setShipping(2.2)
                ->setTax(1.3)
                ->setSubtotal(17.50);

            $amount->setCurrency('USD');
            $amount->setTotal(21);
            $amount->setDetails($details);
            $transaction->setAmount($amount);
            $execution->addTransaction($transaction);

            try {
                $result = $payment->execute($execution, $apiContext);
                echo 'payement';
                //ResultPrinter::printResult("Executed Payment", "Payment", $payment->getId(), $execution, $result);

                try {
                    $payment = Payment::get($paymentId, $apiContext);
                } catch (Exception $ex) {
                    echo 'error payement 1 ';
                    //ResultPrinter::printError("Get Payment", "Payment", null, null, $ex);
                    exit(1);
                }
            } catch (Exception $ex) {
                echo 'error payement 2';
                //ResultPrinter::printError("Executed Payment", "Payment", null, null, $ex);
                exit(1);
            }
            echo 'payement ok';
            //ResultPrinter::printResult("Get Payment", "Payment", $payment->getId(), null, $payment);

            return $payment;
        } else {
            echo 'payement canceled';
            //ResultPrinter::printResult("User Cancelled the Approval", null);
            exit;
        }

    }


}
