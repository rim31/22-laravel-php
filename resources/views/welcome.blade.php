@extends('layouts.app')
<link rel="stylesheet" href="{{ URL::asset('css/homePage.css')}}" />
@section('content')
<body>
	<main>
    <!-- ======= 1.02 Home Area ====== -->
    <div class="homeArea animated">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="homeContent">
                        <span class="topTxt">Simple &nbsp; - &nbsp; Easy to use &nbsp; - &nbsp; 10x faster!</span>
                        <span class="h2 homeTitle">Best web hosting service for your website.</span>
                        <p>Get the best speed for your website. Don’t lose anymore <br>clients for the slowest speed of your hosting service.</p>
                        <div class="homeBtn">
                            <a href="#" class="btnOne Btn"><i class="icofont icofont-rocket-alt-2"></i>Get Started Now</a>
                            <a href="#" class="btnTwo Btn">check pricing</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="homeImgTable">
                        <div class="homeImg">
                            <img src="img/home-dsk-1.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="clouds">
                <img src="img/clouds/cloud-1.png" alt="" class="cloud1">
                <img src="img/clouds/cloud-2.png" alt="" class="cloud2">
                <img src="img/clouds/cloud-3.png" alt="" class="cloud3">
                <img src="img/clouds/cloud-4.png" alt="" class="cloud4">
                <img src="img/clouds/cloud-5.png" alt="" class="cloud5">
            </div>
        </div>
    </div>
    <!-- ======= /1.02 Home Area ====== -->

    <!-- ======= 1.03 Domain Area ====== -->
    <div class="domainArea">
        <div class="container animated">
            <div class="row">
                <div class="col-md-12 clearfix">
                    <div class="domainTxt">
                        <p>Search your domain, <br>purchase one.</p>
                    </div>
                    <form action="domainSearch.html" class="domainForm" method="get"> <!-- replace domainSearch.html with your php file -->
                        <div class="domainTop">
                            <input type="search" name="search" placeholder="Enter your domain name here">
                            <input type="submit" name="submit" value="Search Domain">
                        </div>
                        <div class="domainCheck">
                            <span class="com"><input type="checkbox" id="com" name="com" value="com"> .com ($8.99) <label for="com"></label></span>
                            <span class="net"><input type="checkbox" id="net" name="net" value="net"> .net ($4.99)<label for="net"></label></span>
                            <span class="org"><input type="checkbox" id="org" name="org" value="org"> .org ($11.99)<label for="org"></label></span>
                            <span class="in"><input type="checkbox" id="in" name="in" value="in"> .in ($8.99)<label for="in"></label></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ======= /1.03 Domain Area ====== -->

    <!-- ======= 1.04 Service Area ====== -->
    <div class="serviceArea secPdng animated">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="sectionTitle">
                        <div class="h2">Lots of hosting services in town. <br>Why you should <span>choose us?</span></div>
                    </div>
                </div>
            </div>
            <div class="row service">
                <div class="col-md-4 col-sm-4">
                    <div class="singleService">
                        <div class="serviceIcon">
                            <img src="img/icon/gear.png" alt="">
                        </div>
                        <div class="serviceContent">
                            <span class="h3">Easy to Customize</span>
                            <p>Easily configurable with your popular CMS <br >platforms - Wordpress, Joomla & more.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="singleService">
                        <div class="serviceIcon">
                            <img src="img/icon/cloud-up.png" alt="">
                        </div>
                        <div class="serviceContent">
                            <span class="h3">99% server uptime</span>
                            <p>Easily configurable with your popular CMS <br >platforms - Wordpress, Joomla & more.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="singleService">
                        <div class="serviceIcon">
                            <img src="img/icon/care-support.png" alt="">
                        </div>
                        <div class="serviceContent">
                            <span class="h3">24/7 customer support</span>
                            <p>Easily configurable with your popular CMS <br >platforms - Wordpress, Joomla & more.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="singleService">
                        <div class="serviceIcon">
                            <img src="img/icon/serv-04.png" alt="">
                        </div>
                        <div class="serviceContent">
                            <span class="h3">Clean & Minimal Design</span>
                            <p>Easily configurable with your popular CMS <br >platforms - Wordpress, Joomla & more.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="singleService">
                        <div class="serviceIcon">
                            <img src="img/icon/serv-05.png" alt="">
                        </div>
                        <div class="serviceContent">
                            <span class="h3">Secured Server</span>
                            <p>Easily configurable with your popular CMS <br >platforms - Wordpress, Joomla & more.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="singleService">
                        <div class="serviceIcon">
                            <img src="img/icon/serv-06.png" alt="">
                        </div>
                        <div class="serviceContent">
                            <span class="h3">Live Chat Support</span>
                            <p>Easily configurable with your popular CMS <br >platforms - Wordpress, Joomla & more.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ======= /1.04 Service Area ====== -->

    <div class="sectionBar"></div>

    <!-- ======= 1.05 Pricing Area ====== -->
    <div class="pricingArea secPdng animated">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="sectionTitle">
                        <div class="h2">Pay for what you <span>actually</span> use. No hidden charge!</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="price clearfix">
                    <div class="col-md-3 priceCol col-sm-5 col-sm-offset-1 col-md-offset-0">
                        <div class="singlePrice">
                            <div class="priceHead">
                                <span class="priceTitle">Personal</span>
                                <div class="priceImg">
                                    <img src="img/icon/user.png" alt="">
                                </div>
                                <div class="currency">$3<span>/mo</span></div>
                                <p>best for personal use</p>
                            </div>
                            <ul class="priceBody">
                                <li><i class="icofont icofont-ui-check"></i>10GB Space</li>
                                <li><i class="icofont icofont-ui-check"></i>1 Free Domain</li>
                                <li><i class="icofont icofont-ui-check"></i>300GB SSD Disk</li>
                                <li><i class="icofont icofont-ui-close"></i>Special Offers</li>
                                <li><i class="icofont icofont-ui-check"></i>Unlimited Support</li>
                            </ul>
                            <a href="" class="priceBtn Btn">Get Started now</a>
                        </div>
                    </div>
                    <div class="col-md-3 priceCol col-sm-5">
                        <div class="singlePrice active">
                            <div class="priceHead">
                                <span class="priceTitle">small team</span>
                                <div class="priceImg">
                                    <img src="img/icon/users.png" alt="">
                                </div>
                                <div class="currency">$7<span>/mo</span></div>
                                <p>best for personal use</p>
                            </div>
                            <ul class="priceBody">
                                <li><i class="icofont icofont-ui-check"></i>10GB Space</li>
                                <li><i class="icofont icofont-ui-check"></i>1 Free Domain</li>
                                <li><i class="icofont icofont-ui-check"></i>300GB SSD Disk</li>
                                <li><i class="icofont icofont-ui-close"></i>Special Offers</li>
                                <li><i class="icofont icofont-ui-check"></i>Unlimited Support</li>
                            </ul>
                            <a href="" class="priceBtn Btn">Get Started now</a>
                        </div>
                    </div>
                    <div class="col-md-3 priceCol col-sm-5 col-sm-offset-1 col-md-offset-0">
                        <div class="singlePrice">
                            <div class="priceHead">
                                <span class="priceTitle">company</span>
                                <div class="priceImg">
                                    <img src="img/icon/home.png" alt="">
                                </div>
                                <div class="currency">$15<span>/mo</span></div>
                                <p>best for personal use</p>
                            </div>
                            <ul class="priceBody">
                                <li><i class="icofont icofont-ui-check"></i>10GB Space</li>
                                <li><i class="icofont icofont-ui-check"></i>1 Free Domain</li>
                                <li><i class="icofont icofont-ui-check"></i>300GB SSD Disk</li>
                                <li><i class="icofont icofont-ui-close"></i>Special Offers</li>
                                <li><i class="icofont icofont-ui-check"></i>Unlimited Support</li>
                            </ul>
                            <a href="" class="priceBtn Btn">Get Started now</a>
                        </div>
                    </div>
                    <div class="col-md-3 priceCol col-sm-5">
                        <div class="singlePrice">
                            <div class="priceHead">
                                <span class="priceTitle">big shot</span>
                                <div class="priceImg">
                                    <img src="img/icon/earth.png" alt="">
                                </div>
                                <div class="currency">$25<span>/mo</span></div>
                                <p>best for personal use</p>
                            </div>
                            <ul class="priceBody">
                                <li><i class="icofont icofont-ui-check"></i>10GB Space</li>
                                <li><i class="icofont icofont-ui-check"></i>1 Free Domain</li>
                                <li><i class="icofont icofont-ui-check"></i>300GB SSD Disk</li>
                                <li><i class="icofont icofont-ui-close"></i>Special Offers</li>
                                <li><i class="icofont icofont-ui-check"></i>Unlimited Support</li>
                            </ul>
                            <a href="" class="priceBtn Btn">Get Started now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ======= /1.05 Pricing Area ====== -->

    <!-- ======= 1.06 Cta Area ====== -->
    <div class="ctaArea secPdngB animated">
        <div class="container">
            <div class="row ctaRow">
                <div class="col-md-6">
                    <div class="ctaImgOne">
                        <img src="img/server.png" alt="">
                    </div>
                </div>
                <div class="col-md-6 ctaCol">
                    <div class="ctaRight ctaTxt">
                        <div class="ctaCell">
                            <div class="h2">Dedicated and Secured server for your website.</div>
                            <p>Get the best speed for your website. Don’t lose anymore <br>clients for the slowest speed of your hosting service.</p>
                            <a href="#" class="ctaBtn Btn"><i class="icofont icofont-rocket-alt-2"></i>Get Started Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 ctaCol">
                    <div class="ctaLeft ctaTxt">
                        <div class="ctaCell">
                            <div class="h2">Super speed for your website to impress your visitor.</div>
                            <p>Get the best speed for your website. Don’t lose anymore <br>clients for the slowest speed of your hosting service.</p>
                            <div class="ctaBtn">
                                <a href="#" class="btnOne Btn">read more</a>
                                <a href="#" class="btnTwo Btn">Get Started Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-md-offset-1 ctaColBtm">
                    <div class="ctaImgTwo">
                        <img src="img/home-dsk-2.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ======= /1.06 Cta Area ====== -->

    <!-- ======= 1.07 client Area ====== -->
    <div class="clientArea secPdng animated">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="sectionTitle">
                        <div class="h2">We give <span>awesome service,</span><br>Some of our trusted clients.</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 col-sm-4 col-xs-6">
                    <div class="singleClient"><a href="#"><img src="img/client-1.png" alt=""></a></div>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6">
                    <div class="singleClient"><a href="#"><img src="img/client-2.png" alt=""></a></div>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6">
                    <div class="singleClient"><a href="#"><img src="img/client-3.png" alt=""></a></div>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6">
                    <div class="singleClient"><a href="#"><img src="img/client-4.png" alt=""></a></div>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6">
                    <div class="singleClient"><a href="#"><img src="img/client-5.png" alt=""></a></div>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6">
                    <div class="singleClient"><a href="#"><img src="img/client-6.png" alt=""></a></div>
                </div>
            </div>
        </div>
    </div>
    <!-- ======= /1.07 client Area ====== -->

    <!-- ======= 1.08 ctaTwo Area ====== -->
    <div class="ctaTwo">
        <div class="container">
            <div class="row">
                <div class="col-md-12 animated">
                    <span class="ctaTxtTwo">20,000+ People trust Sparks! Be one of them today.</span>
                    <div class="ctaBtn"><a href="#" class="btnOne Btn">Get Started now</a></div>
                </div>
            </div>
        </div>
    </div>
    <!-- ======= /1.08 ctaTwo Area ====== -->

    <!-- ======= 1.09 footer Area ====== -->
    <footer class="secPdngT animated">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="footerInfo">
                        <a href="index-1.html" class="footerLogo">
                            <img src="img/footerLogo.png" alt="">
                        </a>
                        <div class="footerTxt">
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh eui smod tincidunt ut laoreet dolore magna.</p>
                        </div>
                        <ul class="footerLinkIcon">
                            <li><a href="#"><i class="icofont icofont-social-facebook"></i></a></li>
                            <li><a href="#"><i class="icofont icofont-social-twitter"></i></a></li>
                            <li><a href="#"><i class="icofont icofont-social-google-plus"></i></a></li>
                            <li><a href="#"><i class="icofont icofont-social-tumblr"></i></a></li>
                            <li><a href="#"><i class="icofont icofont-social-yelp"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="widget">
                        <div class="h4">Important Links</div>
                        <ul class="footerLink">
                            <li><a href="#">Support</a></li>
                            <li><a href="#">Privacy & Policy</a></li>
                            <li><a href="#">Terms & Conditions</a></li>
                            <li><a href="#">VPN Service</a></li>
                            <li><a href="#">Dedicated Server</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="widget">
                        <div class="h4">out pertners</div>
                        <ul class="footerLink">
                            <li><a href="#">ThemeForest</a></li>
                            <li><a href="#">GraphicRiver</a></li>
                            <li><a href="#">AudioJungle</a></li>
                            <li><a href="#">3DOcean</a></li>
                            <li><a href="#">CodeCanayon</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="contactInfo">
                        <div class="h4">contact with us</div>
                        <span class="call"><a href="tel:+214-5212-829"><i class="icofont icofont-ui-call"></i>+214-5212-829</a></span>
                        <span class="email"><a href="mailto:support@spark.com"><i class="icofont icofont-ui-v-card"></i>support@spark.com</a></span>
                        <a href="" class="contactBtn Btn">Send us a message</a>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="copyrightTxt">
                        <p>&copy; Copyright 2016 Spark, </p>
                        <p>All Rights Reserved</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ======= /1.09 footer Area ====== -->

    </body>
		<div class="container-fluid">
			<iframe width="100%" height="99" src="https://www.youtube.com/embed/EHZH-VJ5L8w" frameborder="0" allowfullscreen></iframe>
		</div>
		<div>
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2629.6320511233143!2d1.98263288269402!3d48.7698225503926!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e683ecfbdd90b3%3A0x401dda97667bc71!2s3+Rue+des+Bleuets%2C+78190+Trappes!5e0!3m2!1sen!2sfr!4v1476969554766" width="100%" height="99" frameborder="0" style="border:0" allowfullscreen></iframe>
		</div>
		</div>
	</main>
</body>
@endsection
