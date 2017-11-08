<!DOCTYPE html>
<html lang="en">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>DUvisio.com</title>
      <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" />
      <meta name="description" content="">
      <link href="{{ asset('assets/css/preload.css') }}" rel="stylesheet">
      <link href="{{ asset('assets/css/vendors.css') }}" rel="stylesheet">
      <link href="{{ asset('assets/css/syntaxhighlighter/shCore.css') }}" rel="stylesheet" >
      <link href="{{ asset('assets/css/style-blue.css') }}" rel="stylesheet" title="default">
      <link href="{{ asset('assets/css/width-full.css') }}" rel="stylesheet" title="default">
      <link href="{{ asset('assets/site.css') }} " rel="stylesheet">
   </head>
   <div id="preloader">
      <div id="status">&nbsp;</div>
   </div>
   <body>
      <div id="sb-site">
         <div class="boxed">
            <header id="header-full-top" class="header-full">
               <div class="container">
                  <div class="header-full-title">
                     <h1 class="animated fadeInRight">
                        <a href="index.php">
                           &nbsp;<!--DUvisio <span>Beta</span>-->
                        </a>
                     </h1>
                     <p class="animated fadeInRight">
                        &nbsp;<!--Internet Marketing Platform-->
                     </p>
                  </div>
                  <nav class="top-nav">
                     <div class="dropdown animated fadeInDown animation-delay-11">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Login</a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-login-box animated flipCenter">
                           <form role="form" method="post" action="login.php">
                              <h4>Login Form</h4>
                              <div class="form-group">
                                 <div class="input-group login-input">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" name="email" class="form-control" placeholder="Email">
                                 </div>
                                 <br>
                                 <div class="input-group login-input">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input type="password" name="pass" class="form-control" placeholder="Password">
                                 </div>
                                 <button type="submit" class="btn btn-ar btn-primary pull-right">Login</button>
                                 <div class="clearfix"></div>
                              </div>
                           </form>
                           <center>
                              <a href="LostPass.html">
                                 <font size="2">
                                    <center>
                                       <button class="btn btn-ar btn-default">
                                          Lost Password
                                    </center>
                                 </font>
                              </a>
                           </center>
                        </div>
                     </div>
                     <!-- dropdown -->
                  </nav>
               </div>
               <!-- container -->
            </header>
            <!-- header-full -->
            <nav class="navbar navbar-default navbar-header-full yamm navbar-static-top" role="navigation" id="header">
            <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <i class="fa fa-bars"></i>
            </button>
            <a id="ar-brand" class="navbar-brand hidden-lg hidden-md hidden-sm"></a>
            </div> <!-- navbar-header -->
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul style="float:right;" class="nav navbar-nav">
            <li>
            <a href="Home.html">Home</a>
            </li>
            <li>
            <a href="MarketPlace.html">Marketplace</a>
            </li>
            </ul>
            </div><!-- navbar-collapse -->
            </div><!-- container -->
            </nav>
            <section class="section-lines">
               <div class="container">
                  <div class="row">
                     <div class="col-md-1">
                     </div>
                     <div class="col-md-10">
                        <script type="text/javascript">
                           function add_product(product_id){
                           $("#ajaxloader_" + product_id).show();
                           var market_id = $("#market_" + product_id).val();
                           $.ajax({
                           type: "POST",
                           url: "https://DUvisio.com/ajax.php?type=add_product_to_custom_market",
                           data: {product_id: product_id, market_id: market_id},
                           success: function(str){
                           $("#ajaxloader_" + product_id).hide();
                           $("#result_" + product_id).html(str);
                           }
                           });
                           }
                        </script>
                        <center>
                           <h2><font color="#CC0000"><b>Products</b></font></h2>
                           <p>
                              Select Marketplace
                              <select name="network" onchange="window.location.href='MarketPlace.html?network=' + this.options[this.selectedIndex].value">
                                 <option  value="999">Main Marketplace</option>
                                 <option  value="10">Global Visibility Network TV</option>
                              </select>
                           </p>
                           <p>
                              Display only products in
                              <select name="category" id="category">
                                 <option value="">All Categories</option>
                                 <option value="Arts & Entertainment" >Arts & Entertainment</option>
                                 <option value="Business / Investing" >Business / Investing</option>
                                 <option value="Business to Business" >Business to Business</option>
                                 <option value="Computing & Internet" >Computing & Internet</option>
                                 <option value="Cooking, Food & Wine" >Cooking, Food & Wine</option>
                                 <option value="E-business & E-marketing" >E-business & E-marketing</option>
                                 <option value="Education" >Education</option>
                                 <option value="Employment & Jobs" >Employment & Jobs</option>
                                 <option value="Fiction" >Fiction</option>
                                 <option value="Free Reports" >Free Reports</option>
                                 <option value="Free Webinars" >Free Webinars</option>
                                 <option value="Fun & Entertainment" >Fun & Entertainment</option>
                                 <option value="Games" >Games</option>
                                 <option value="Gardening" >Gardening</option>
                                 <option value="Health & Fitness" >Health & Fitness</option>
                                 <option value="Home & Family" >Home & Family</option>
                                 <option value="InstaJV Funnel" >InstaJV Funnel</option>
                                 <option value="Languages" >Languages</option>
                                 <option value="Marketing & Ads" >Marketing & Ads</option>
                                 <option value="Misc" >Misc</option>
                                 <option value="Mobile" >Mobile</option>
                                 <option value="Money & Employment" >Money & Employment</option>
                                 <option value="Nutrition" >Nutrition</option>
                                 <option value="Pets" >Pets</option>
                                 <option value="Reference" >Reference</option>
                                 <option value="Self-Improvement" >Self-Improvement</option>
                                 <option value="Society & Culture" >Society & Culture</option>
                                 <option value="Software & Services" >Software & Services</option>
                                 <option value="Sports & Recreation" >Sports & Recreation</option>
                                 <option value="Wellness" >Wellness</option>
                              </select>
                              <input type="button" value="Refresh" onclick="var cate=document.getElementById('category');var cat=cate.options[cate.selectedIndex].value;window.location.href = 'MarketPlace.html?category='+cat"><br>
                           </p>
                        </center>
                        <?php
$email = "admin@admin.com";
?>

                        <div class="panel panel-default" id="modal">
                             <client-modal v-bind:email="email"></client-modal>

                           <div class="panel-body">
                              <div class="row">
                                 <div class="col-sm-3" style="text-align:center;"><img class="img-responsive" width="130" src="https://DUvisio.com/products/product_582/product_img/product_image.png"></div>
                                 <div style="text-align:left; font-size:smaller;" class="col-sm-9">
                                    <p><b>Flip Starter</b><br>Price: $97.00</p>
                                    <p style="text-align:justify;">The &#039;Flipping America&#039; Guy is going to show you the process and systems he uses to rehab and flip 100 houses a year. You supply the effort. We provide everything else you need.<br />
                                       <br />
                                       Join Us October 20th and October 21st in Atlanta for "FlipStarter," Where You&#039;ll Find Out How to Build True Wealth with Real Estate!
                                    </p>
                                    <a target="_blank" v-on:click.prevent="popModal('{{$email}}')" href="payment.php?itemid=582"><font color="#0000FF">Get This Product Now!</font></a> | <a href="http://www.flipstarterevent.com" target="_blank"><font color="#0000FF">View Sales Letter</font></a>
                                 </div>
                              </div>
                              <hr>
                              <div class="row">
                                 <div class="col-sm-3" style="text-align:center;"><img class="img-responsive" width="130" src="https://DUvisio.com/products/product_593/product_img/product_image.png"></div>
                                 <div style="text-align:left; font-size:smaller;" class="col-sm-9">
                                    <p><b>Be Seen as The Expert (Bronze)</b><br>Price: $2497.00</p>
                                    <p style="text-align:justify;">We will ghostwrite your book, create a cover, and load it on the AHAthat platform as a social media-enabled AHAbook. For $2,750, we will:<br />
                                       <br />
                                       • Interview you in a two-hour session.<br />
                                       • Content edit and copy edit your book.<br />
                                       • Design the book cover in multiple formats.<br />
                                       • Ensure you have compelling content to share on social.<br />
                                       • Provide one to two quarters of social media content for your business.<br />
                                       • Publish your book on the AHAthat platform.<br />
                                       • Make your content available to our rapidly expanding user base.<br />
                                       • List you on AHAthat as a published author.<br />
                                       In addition, you will:<br />
                                       • Receive an AHAblaster key ($50 list) to automatically share your entire book on Twitter.<br />
                                       • Receive a robust set of book marketing strategies.<br />
                                       • Own the copyright.
                                    </p>
                                    <a target="_blank" href="payment.php?itemid=593"><font color="#0000FF">Get This Product Now!</font></a> | <a href="https://www.ahathat.com/on/beseenbd/" target="_blank"><font color="#0000FF">View Sales Letter</font></a>
                                 </div>
                              </div>
                              <hr>
                              <div class="row">
                                 <div class="col-sm-3" style="text-align:center;"><img class="img-responsive" width="130" src="https://DUvisio.com/products/product_231/product_img/product_image.jpg"></div>
                                 <div style="text-align:left; font-size:smaller;" class="col-sm-9">
                                    <p><b>Secret Confessions of The JV Queen</b><br>Price: $27.00</p>
                                    <p style="text-align:justify;">JV&#039;s are all about relationships... The KEY is in creating a WIN-WIN-WIN proposition -- a win for each of the partners as well as for the customers.<br />
                                       <br />
                                       When you know how to build relationships and how to establish this WIN-WIN-WIN situation for each of the parties, no matter how you use Joint Ventures, they will assuredly increase your bottom line!<br />
                                       <br />
                                       Let "The JV Queen" show you how to build Joint Ventures and Strategic Alliances, as well as manage a team of Affiliates who sell YOUR products, using the unique system she devised while organizing million dollar deals for people like Shawn Casey, Willie Crawford, Russell Brunson, Henry Gold, David Garfinkel, Holly Cotter, and many more!<br />
                                       <br />
                                       You&#039;ll be building JV&#039;s that will stuff your wallet to overflowing in no time!
                                    </p>
                                    <a target="_blank" href="payment.php?itemid=231"><font color="#0000FF">Get This Product Now!</font></a> | <a href="http://www.directionsuniversity.com/courses/workshops/jvs/secret-confessions-of-the-jv-queen" target="_blank"><font color="#0000FF">View Sales Letter</font></a>
                                 </div>
                              </div>
                              <hr>
                              <div class="row">
                                 <div class="col-sm-3" style="text-align:center;"><img class="img-responsive" width="130" src="https://DUvisio.com/products/product_588/product_img/product_image.jpg"></div>
                                 <div style="text-align:left; font-size:smaller;" class="col-sm-9">
                                    <p><b>Grow Your 1099 (Silver Membership)</b><br>Price: $39.97</p>
                                    <p style="text-align:justify;">Join us for tips and tricks on growing your ability as a direct salesperson. Learn from a professional who was making $300k at 26. Either join us live for an hour once a week or binge-watch the content from the membership video area.<br />
                                       <br />
                                       Weekly session with upcoming Author of $300k at 26 Josh Jones and the AHA Guy Mitchell Levy.<br />
                                       <br />
                                       As an aside, with our healthy affiliate structure, you can turn this into a nice ongoing revenue stream.<br />
                                    </p>
                                    <a target="_blank" href="payment.php?itemid=588"><font color="#0000FF">Get This Product Now!</font></a> | <a href="https://www.ahathat.com/grow/dsi/" target="_blank"><font color="#0000FF">View Sales Letter</font></a>
                                 </div>
                              </div>
                              <hr>
                              <div class="row">
                                 <div class="col-sm-3" style="text-align:center;"><img class="img-responsive" width="130" src="https://duvisio.com/images/Generic.jpg"></div>
                                 <div style="text-align:left; font-size:smaller;" class="col-sm-9">
                                    <p><b>Tiger VIP Coaching & Mentoring Special Offer</b><br>Price: $797.00</p>
                                    <p style="text-align:justify;">Tiger VIP Coaching & Mentoring is designed to fast-track serious players to quickly setting up a lead-capture system in their niche. Teaching them how to be a real expert in that niche, be seen as such, and capitalise on that status of niche expert. <br />
                                       <br />
                                       Also, clients will be shown how to scale up quickly and aim for 7-figures, with the object of hitting 6!
                                    </p>
                                    <a target="_blank" href="payment.php?itemid=552"><font color="#0000FF">Get This Product Now!</font></a> | <a href="http://richmort.com/TigerVIP-Special/" target="_blank"><font color="#0000FF">View Sales Letter</font></a>
                                 </div>
                              </div>
                              <hr>
                              <div class="row">
                                 <div class="col-sm-3" style="text-align:center;"><img class="img-responsive" width="130" src="https://DUvisio.com/products/product_222/product_img/product_image.jpg"></div>
                                 <div style="text-align:left; font-size:smaller;" class="col-sm-9">
                                    <p><b>Fruits and Vegetables - Royalty Free Stock Photos</b><br>Price: $17.00</p>
                                    <p style="text-align:justify;">Stock Photo Package of 100 Vegetable and Fruit photos - Unlimited use of any or all - Extended License Package.<br />
                                       <br />
                                       Can be used for Websites, Blog Posts, Mailings, Specialty Products for resale: Shirts, Hats, Mugs, Calendars, Cards and your choice of whatever else.<br />
                                       <br />
                                       Some photos are simply of a fruit veggie on a plain background. Others are of the items set in original, handmade pottery pieces.
                                    </p>
                                    <a target="_blank" href="payment.php?itemid=222"><font color="#0000FF">Get This Product Now!</font></a> | <a href="http://healthyfoodstockphotos.com/vegetables-and-fruit-package-2/" target="_blank"><font color="#0000FF">View Sales Letter</font></a>
                                 </div>
                              </div>
                              <hr>
                              <div class="row">
                                 <div class="col-sm-3" style="text-align:center;"><img class="img-responsive" width="130" src="https://DUvisio.com/products/product_378/product_img/product_image.jpg"></div>
                                 <div style="text-align:left; font-size:smaller;" class="col-sm-9">
                                    <p><b>Platinum Wellness Plan Yearly</b><br>Price: $97.00</p>
                                    <p style="text-align:justify;">Platinum Wellness Plan Yearly Subscription</p>
                                    <a target="_blank" href="payment.php?itemid=378"><font color="#0000FF">Get This Product Now!</font></a> | <a href="http://platinumwellnessclub.com" target="_blank"><font color="#0000FF">View Sales Letter</font></a>
                                 </div>
                              </div>
                              <hr>
                              <div class="row">
                                 <div class="col-sm-3" style="text-align:center;"><img class="img-responsive" width="130" src="https://DUvisio.com/products/product_602/product_img/product_image.png"></div>
                                 <div style="text-align:left; font-size:smaller;" class="col-sm-9">
                                    <p><b>XLeads360</b><br>Price: $27.00</p>
                                    <p style="text-align:justify;">Description: Xleads 360 is a cloud-based software that works for any platform, browser or operating system. This is suitable for any online marketing angle such as: Local Marketing, Search Engine Optimization SEO, Video Marketing, Reputation Management, Email Marketing, Web Design and so much more. If your customers already make money online or they are just starting, they can use Xleads 360 to find clients and make a recurring income by selling them online services.<br />
                                       <br />
                                    </p>
                                    <a target="_blank" href="payment.php?itemid=602"><font color="#0000FF">Get This Product Now!</font></a> | <a href="http://www.xleads360.com/home/" target="_blank"><font color="#0000FF">View Sales Letter</font></a>
                                 </div>
                              </div>
                              <hr>
                              <div class="row">
                                 <div class="col-sm-3" style="text-align:center;"><img class="img-responsive" width="130" src="https://DUvisio.com/products/product_301/product_img/product_image.png"></div>
                                 <div style="text-align:left; font-size:smaller;" class="col-sm-9">
                                    <p><b>GreenSurance Natural Medicine Healthcare Co-op</b><br>Price: $249.99</p>
                                    <p style="text-align:justify;">Product Description: As the first and only co-op health plan for the green community, GreenSurance serves people whose healthcare needs have long been ignored by conventional medicine. Shattering the invisible barrier the insurance industry creates between natural and conventional medicine, GreenSurance fuses conventional and natural medicine in one convenient health plan. Independent of insurance and ensuring Obamacare penalty exemption, GreenSurance is a member owned co-op for better health and better healthcare.</p>
                                    <a target="_blank" href="payment.php?itemid=301"><font color="#0000FF">Get This Product Now!</font></a> | <a href="http://www.mygreensurance.com" target="_blank"><font color="#0000FF">View Sales Letter</font></a>
                                 </div>
                              </div>
                              <hr>
                              <div class="row">
                                 <div class="col-sm-3" style="text-align:center;"><img class="img-responsive" width="130" src="https://DUvisio.com/products/product_479/product_img/product_image.png"></div>
                                 <div style="text-align:left; font-size:smaller;" class="col-sm-9">
                                    <p><b>Find Your Money Voice</b><br>Price: $197.00</p>
                                    <p style="text-align:justify;">A video course for empowerment through personal finance and communication skills</p>
                                    <a target="_blank" href="payment.php?itemid=479"><font color="#0000FF">Get This Product Now!</font></a> | <a href="http://www.money-morphosis.com/find-your-money-voice-short/" target="_blank"><font color="#0000FF">View Sales Letter</font></a>
                                 </div>
                              </div>
                              <hr>
                              <div class="row" style="text-align:center;"> <a href="MarketPlace_step_10.html?category="><b><kbd>Next</kbd></b></a></div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-1">
                     </div>
                  </div>
               </div>
            </section>
            <footer id="footer">
               <p>
               <div align="center">
                  <p align="center">
                     <font face="Verdana" size="4">
                     <b>
                     <a target="_blank" href="Disclaimer.html" style="text-decoration: none">
                     <font face="Arial" size="2" color="#FFFFFF">Disclaimer</font></a>
                     <font face="Arial" size="2">
                     <font color="#FFFFFF">| </font>
                     <a target="_blank" href="TOS.html" style="text-decoration: none">
                     <font color="#FFFFFF">Terms Of
                     Service</font></a><font color="#FFFFFF">
                     | </font>
                     <a target="_blank" href="Earnings.html" style="text-decoration: none">
                     <font color="#FFFFFF">Earnings
                     Disclaimer</font></a><font color="#FFFFFF">
                     | </font>
                     <a target="_blank" href="Privacy.html" style="text-decoration: none">
                     <font color="#FFFFFF">Privacy
                     Notice</font></a><font color="#FFFFFF"> |
                     <a target="_blank" href="Anti-Spam.html" style="text-decoration: none">
                     <font color="#FFFFFF">Anti-Spam</font></a> |
                     <a target="_blank" href="FTC.html" style="text-decoration: none">
                     <font color="#FFFFFF">FTC</font></a> |
                     <a target="_blank" href="DMCA.html" style="text-decoration: none">
                     <font color="#FFFFFF">DMCA</font></a> |
                     <a target="_blank" href="Copyright.html" style="text-decoration: none">
                     <font color="#FFFFFF">Copyright</font></a> |
                     <a target="_blank" href="RefundPolicy.html" style="text-decoration: none">
                     <font color="#FFFFFF">Refund Policy</font></a></font></font></b>
               </div>
               </p>
            </footer>
         </div>
      </div>

      <script src="{{ asset('assets/js/vendors.js') }}"></script>
      <script src="{{ asset('assets/js/syntaxhighlighter/shCore.js') }}"></script>
      <script src="{{ asset('assets/js/syntaxhighlighter/shBrushXml.js') }}"></script>
      <script src="{{ asset('assets/js/syntaxhighlighter/shBrushJScript.js') }}"></script>
      <script src="{{ asset('assets/js/DropdownHover.js') }}"></script>
      <script src="{{ asset('assets/js/app.js') }}"></script>
      <script src="{{ asset('assets/js/holder.js') }}"></script>
      <script src="{{ asset('assets/js/index.js') }}"></script>
      <script src="{{ asset('assets/fieldtoclipboard.js') }}"></script>
      <script src="http://localhost/Applications/matProject/public/dist/js/service_modal.js"></script>

   </body>
</html>
