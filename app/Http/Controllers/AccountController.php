<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Pagination\LengthAwarePagination;
use Illuminate\Support\Facades\Input;
use App\Exp;
use App\User;
use App\Image;
use App\JoinUserExp;
use App\Http\Controllers\Controller;
use App\UploadedFile;
use App\Http\Requests;
use App\Http\Requests\ExpRequest;

use \Storage;
use File;
use Auth;
use DB;
use Session;
use Carbon\Carbon;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //========on recupère les info de l'utilisateur non supprimé de l'utilisateur ==========
        $users = User::where('id', (Auth::user()->id))
            ->where('is_delete', '!=', '1')
            ->get();

        //============on joint les exps  et on les récupère,(optionnel, c'est pour anciens changement en attente, et pas peter le style)=========================
        $experiences = DB::table('exps')
            ->join('join_user_exps', 'exps.id', '=', 'join_user_exps.exp_id')
            ->get();

        //=========on recupère les images de couvertures==========
        $images = Image::find(Auth::user()->id);//pour la cover

        //============== exprience bien join OK !!============
        $exps = DB::table('exps')
            ->where('join_user_exps.user_id', (Auth::user()->id))
            ->join('join_user_exps', 'exps.id', '=', 'join_user_exps.exp_id')
            ->where('exps.is_delete', '!=', '1')
            ->orderBy('exps.id', 'desc')
            ->get();


        return view('auth.account.index', compact('exps', 'users', 'images', 'experiences'));
        //============variable de retour===================
        // exps : les exp de l'utilisateur
        // users : les id de l'user
        // images: pour la photo de couverture de l'exp
        // expériences (otpionnel, utile avant)
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    // ==============redirection vers la page create==============
        return view('auth.account.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     *
     * variable d'entrée
     * $request : on recupère les infos du formulaire d'inscription pour les mettre dans la bas users
     *
     *
     */
    public function store(ExpRequest $request)
    {

        $nouvel = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'email_save' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password,
            'avatar' => $request->avatar,
            'society' => $request->society,
            'adress' => $request->adress,
            'town' => $request->town,
            'country' => $request->country,
            'option' => $request->option,
            'paid_at' => $request->paid_at,
            'iban' => $request->iban,
            'duration' => $request->duration,
        ]);

        return redirect()->route('auth.account.index')->with('message', trans('account.alertadd'));
        //==========redirection vers l'index du compte client===========
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    //===============affichage du compte utilisateur===========
    // on recupèr edirectement l'id de l'utilisateur en entrée
    public function show()
    {
        //========on recupère les info de l'utilisateur non supprimé de l'utilisateur ==========
        $users = User::where('id', (Auth::user()->id))
            ->where('is_delete', '!=', '1')
            ->get();

        //============== exprience bien join OK !!============
        $exps = DB::table('exps')
            ->where('join_user_exps.user_id', (Auth::user()->id))
            ->join('join_user_exps', 'exps.id', '=', 'join_user_exps.exp_id')
            ->where('exps.is_delete', '!=', '1')
            ->orderBy('exps.id', 'desc')
            ->get();

        return view('auth.account.edit', compact('users', 'exps'));
        //============variable de retour===================
        // exps : les exp de l'utilisateur
        // users : les info liées à l'id de l'user
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     *
     *
     * ====variable d'entrée : users
     * les infos de l'utilisateur (nom, prenom, mail etc....)
     *
     *
     */

    //================variable d'entrée ==================
    //les infos de l'utilisateur issue du formulaire
    public function edit(User $users)
    {
        //==============vérification de l'user avec email validé ==================
        $validate = DB::table('users')
            ->where('id', Auth::user()->id)
            ->value('validate');
        $actif = DB::table('users')
            ->where('id', Auth::user()->id)
            ->value('actif');
        $is_delete = DB::table('users')
            ->where('id', Auth::user()->id)
            ->value('is_delete');
        if ($actif == '0' || $validate == '0' || $is_delete) {
            Auth::logout();
            return view('404', compact('$users'));
        }

        /*====tester de la fonction mise à jours des exp à facturer POUR CHAQUE USER====*/
        $user = DB::table('users')
            ->where('is_delete', '!=', '1')
            ->where('validate', '!=', '0')
            ->get();
        //==========on parcours tous les utilisateurs et on met à jour leur nombre d'experience maximum=============
        //==========possibilité de seulement visé l'utlisateur en cours : Auth::user()->id=============
        foreach ($user as $key => $user_id) {//on recupere le max d'exp non delete % user_id
            $nbexp = DB::table('join_user_exps')
                ->where('join_user_exps.user_id', $user_id->id)
                ->where('join_user_exps.is_delete', '!=', '1')
                ->count();
            //===========on met à jour le nombe max d'exp si l'ex inférieur ================
            // var_dump($user[$key]->max_exp_online_month.' '.$user_id->email.' '.$nbexp);//affichage des exp
            if ($nbexp >= $user[$key]->max_exp_online_month) {
                $max = User::find($user[$key]->id);
                $max->update(['max_exp_online_month' => $nbexp,
                ]);
            }
        }

        // =================toutes les infos de l'utilisateur en cours=======================
        $users = User::where('id', (Auth::user()->id))
            ->where('is_delete', '!=', '1')
            ->get();

        //=============compte le nombre d'experiences de l'users================
        $nbexps = DB::table('exps')
            ->where('join_user_exps.user_id', (Auth::user()->id))
            ->join('join_user_exps', 'exps.id', '=', 'join_user_exps.exp_id')
            ->where('exps.is_delete', '!=', '1')
            ->orderBy('exps.id', 'desc')
            ->count();

        ///////////// ne prend pas en compte le max utiliseen fonction du mois /////////
        $maxepx = JoinUserExp::where('user_id', (Auth::user()->id))
            ->where('is_delete', '!=', '1')
            ->count();

        $mytime = Carbon::now()->toDateTimeString();
        ////////  compte le max exp mais pas en fct du mois ////////
        $users = User::where('id', (Auth::user()->id))
            ->where('is_delete', '!=', '1')
            ->get();
        $maxexp = $users[0]->max_exp_online_month;

        return view('auth.account.edit', compact('users', 'nbexps', 'mytime', 'maxexp'));
        //============variable de retour===================
        // users : info de l'utilisateur en cours
        // nbexps : nombre de d'exp de l'utilisatuer non supprimé
        // mytime : date en actuelle
        // maxexp : nombre max d'exp non surppimés de l'utilisateur
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     *
     *
     *  ====variable d'entrée : users
     * les infos de l'utilisateur (nom, prenom, mail etc....)
     * $request : pareil avec les fontion laravel
     *
     */
    public function update(ExpRequest $request, User $users)
    {
        $users->update($request->all());

        //=====mise a jour des infos du formulaire=======
        $user = User::where('id', (Auth::user()->id))
            ->where('is_delete', '!=', '1')
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'email_save' => $request->email,
                'phone' => $request->phone,
                'password' => $request->password,
                'avatar' => $request->avatar,
                'society' => $request->society,
                'adress' => $request->adress,
                'town' => $request->town,
                'country' => $request->country,
                'option' => $request->option,
                'paid_at' => $request->paid_at,
                'iban' => $request->iban,
                'duration' => $request->duration,
            ]);

        return redirect()->route('exp.index')->with('message', trans('account.profilmodify'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     *
     * ====== variable d'entrée =======
     * users :
     * pour les infos de l'utilisatuer
     *
     * request :
     * pour affficher un flash message
     *
     */
    public function destroy(User $users, Request $request)
    {

        $users = User::where('id', (Auth::user()->id))
            ->update([
                'email' => '',//a activer pour supprimer le mail
                'is_delete' => '1',
                'actif' => '0',
                'time_del' => Carbon::now()
            ]);

        // $exp->delete();//on ne supprime pas mais on met juste un indicateur supprimer
        $request->session()->flash('alert-success', trans('account.profildelete'));
        Auth::logout();
        return view('/home', compact('users'));
    }
}
