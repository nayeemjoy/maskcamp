<!DOCTYPE html>
<html lang="en">
<head>
  <title>MaskCamp</title>
  <link rel="shortcut icon" href="img/mc_logo_4.png" type="image/png"/><!--Title Image-->
  <!-- meta -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Stylesheets -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.4.0/animate.min.css">
  <link rel="stylesheet" href="css/index.css">

  <link href='https://fonts.googleapis.com/css?family=Abel|Roboto+Condensed:400,300,400italic,700,700italic|Dosis:400,500,600,700,800' rel='stylesheet' type='text/css'>
  <!-- Modernizr to provide HTML5 support for IE. -->
  <!--<script src="js/modernizr.custom.js"></script>-->
</head>

<body id="home">
    
  <div class="banner">
    <div class="container-fluid banner-content">
        <div class="banner-content-wrapper">
            <div class="header-container">
          <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
              <img src="img/mc_logo_4.png" class="img-responsive img-logo">
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
              <ul class="list-inline pull-right index-btn-list">
                <li>
                  <button class="btn btn-index btn-index-blue" data-placement="bottom" data-toggle="popover" data-container="body" type="button" data-html="true">JOIN NOW</button>
                </li>
                <div id="popover-content" class="hide">
                        <ul class="list-inline">
                            <label>
                            <input type="checkbox" id="index-checkbox">I Agree To The <a href="#">Terms Of Uses</a>
                            </label>
                            <a id="join" href="{{URL::to('/login')}}" class="btn btn-facebook">Sign in with Facebook</a>
                        </ul>           
                    </div>
                <li>
                  <a href="{{URL::to('/login')}}" class="btn btn-index">LOGIN</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="mc-header">
            <h1>MASKCAMP</h1>
          </div>
        </div>
        <div class="row">
            <div class="mc-sub-header">
              <h2><span>PUT ON A MASK,</span><span class="blue-header"> SPEAK YOUR MIND</span></h2>
            </div>        
        </div>
        <div class="row">
          <div class="google-play">
            <p>Get It On<span class="play-icon pull-right"><a href="https://play.google.com/store/apps/details?id=com.mask.camp.maskcamp" target="_blank"><img src="img/play.png" class="img-responsive"></a></span></p>
          </div>
        </div>
      </div>
    </div>
  </div>
    
  <!--Features section-->
  <section id="bigfeatures" class="img-block-3col block">

    <div class="container">

      <div class="title-box">
        <h1 class="block-title wow animated zoomIn">
          <span class="bb-top-left"></span>
          <span class="bb-bottom-left"></span>
          Features
          <span class="bb-top-right"></span>
          <span class="bb-bottom-right"></span>
        </h1>
      </div>

      <div class="row">
        <div class="col-sm-4">
          <ul class="item-list-right item-list-big">
            <li class="wow fadeInLeft animated">
                <span class="pull-right ion-ios-people ios-features-02"></span>
              <h3>Friends Room</h3>
              <p>
                  In friends room, everybody is your facebook friend (also using MaskCamp). You  can share contents anonymously with friends and also see, like/dislike, comment in anonymous contents posted by your facebook friends.
                </p>
            </li>
            <li class="wow fadeInLeft animated">
                <span class="pull-right ios-features glyphicon glyphicon-globe" aria-hidden="true"></span>
              <h3>Common Room</h3>
              <p>
                This is a place where all MasKCamp users are connected anonymously. A room for everybody. You can post using a name if you want, follow other people to see their posts updates, use hashtags, share posts in facebook and soo many more. 
              </p>
            </li>
            <li class="wow fadeInLeft animated">
                <span class="pull-right ios-features glyphicon glyphicon-education"
              aria-hidden="true"></span>
              <h3>Campus Room</h3>
              <p>
                  Once you select your Campus, you can become anonymously connected with people belong to the same campus. 
                  Its a kind of place where you can talk about things going on in your campus, but remain anonymous. 
              </p>
            </li>
          </ul>
        </div>
        <div class="col-sm-4 col-sm-push-4">
          <ul class="item-list-left item-list-big">
            <li class="wow fadeInRight animated">
                <span class="pull-left ion-ribbon-b ios-features-02"></span> 
              <h3>Social Judgment</h3>
              <p>
                How accepted or hated a person is? You can see anyone's social judgement , which is the ratio of their overall like and dislike. There is little bad in good, there is little good in bad, and there is life!
              </p>
            </li>
            <li class="wow fadeInRight animated">
                <span class="pull-left ion-mic-c ios-features-02"></span>
              <h3>Confession</h3>
              <p>
                Love someone? Commited a crime? You want to confess anything and share with people? Use confession from profile, your confession will be visible to others. Confessions will be automaticalloy deleted after 24 hours, and you remain anonymous.
              </p>
            </li>
            <li class="wow fadeInRight animated">
                <span class="pull-left ion-pie-graph ios-features-02"></span>
              <h3>Poll</h3>
              <p>
                Most liked and most disliked post will be featured in top/flop of the day section. They deserve attention!
              </p>
            </li>
          </ul>
        </div>
        <div class="col-sm-4 col-sm-pull-4 text-center">
          <div class="animation-box wow bounceIn animated">
            <img class="highlight-left wow animated" src="img/spark.png" height="192" width="48" alt=""> 
            <img class="highlight-right wow animated" src="img/spark.png" height="192" width="48" alt="">
            <img class="screen" src="img/ss2.png" alt="" height="581" width="300">
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer>
      
          <div class="footer-content">
          
            <ul class="footer-list list-inline">
              <li><span class="ion-document-text footer-icon page-icon"></span><a href="{{URL::to('/terms')}}">Terms of Uses</a></li>
              <li style="display:none;"><span class="ion-android-settings footer-icon page-icon"></span><a href="#">How to Use</a></li>
              <!--<li><button class="btn btn-facebook">Sign in with Facebook</button></li>-->
              <li><span class="ion-social-facebook footer-icon page-icon"></span><a href="{{URL::to('https://www.facebook.com/maskcamp/?fref=ts')}}">Find Us on Facebook</a></li>
            </ul>
            <div class="copyright">
              Copyright © MaskCamp 2015, All Rights Reserved
            </div>
          
        </div>
      
  </footer>

  <!--Back to top-->
  <a id="back-to-top" href="index-green.html#" class="btn btn-primary btn-lg back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>

  <!-- All the scripts -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.js"></script>
  <script src="js/smoothscroll.js"></script>
  <script src="js/index.js"></script>
</body>
</html>
