@extends('layouts.default')

@section('body')
    <header class="navbar-fixed-top">
      <div class="container-fluid">
        <div class="row">
            <div class="visible-xs hidden-sm hidden-md hidden-lg" id="xs-flag"></div>     
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">       
               <h1 class="title">MaskCamp<small class="beta">Beta</small></h1><!--05-10-15--->
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 pull-right login-section" id="login">
               <a class="btn btn-primary btn-login" href="{{URL::to('/login')}}"><span class="page-icon glyphicon glyphicon-log-in" aria-hidden="true"></span>Login</a><!--05-                          27-15-turash-->  
            </div>
        </div>
      </div>
    </header>

    <div class="container-fluid index-section">

       <div class="row">    
          <img src="{{asset('img/logo.png')}}" class="img-responsive index-img"><!--05-10-15--->
      </div>

      <div class="row index-text">    
          <h3><b>MaskCamp</b></h3>
          <h4>Put On A Mask , Speak Your Mind</h4>
          <a class="btn btn-large btn-join" href="#">Join Now!</a>
      </div>

      <div class="row signup-area">  
        <div class="checkbox checkbox-index"><!--05-23-15-turash-->
          <label>
            <input type="checkbox" id="checkbox-index"> I Agree To The <a href="{{URL::to('/terms')}}">Terms Of Uses</a>
          </label>
        </div>   
        <a href="{{URL::to('/login')}}"><button class="btn btn-large btn-fb"><b>Signup With Facebook<b><span class="fa fa-facebook"></span></button> </a>
      </div>
      
      <div class="row">    
        <a href="https://play.google.com/store/apps/details?id=com.mask.camp.maskcamp" target="_blank"><img src="img/play_store.png" class="img-responsive play_store_link"></a> <!--05-10-15--->
      </div>

    </div>

    <footer class="container-fluid index-footer"><!--05-10-15-->
    
          <div class="row footer-section">
            <div class="col-lg-4 col-md-4 col-sm-4 hidden-xs copyright">Copyright © MaskCamp <small>2015</small>, all rights reserved.</div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"><!--05-27-15-turash-->
              <div class="col-lg-7 col-md-6 col-sm-6 col-xs-12 terms terms-leftward"><a href="{{URL::to('/terms')}}">Terms Of Uses</a></div>
              <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12 terms" style="display:none"><a href="#">About MaskCamp</a></div>
            </div>
            <div class="visible-xs col-xs-12 copyright">Copyright © MaskCamp <small>2015</small>, all rights reserved.</div>      
          </div> 

    </footer>
    
@stop

@section('script')
  <!-- Javascripts -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/cm-xs-sidebars.js"></script>
    <script type="text/javascript">
         $(document).ready(function(){

            $(".btn-join").on("click",function(){

                  $(".signup-area").fadeToggle("200");
            });
            
            /*05-23-15*/
            var fbButton = $('.btn-fb');
            fbButton.attr('disabled','disabled');
          
            $('#checkbox-index').click(function(){

                var $this= $(this);
                if($this.prop("checked") == true){
                    fbButton.removeAttr('disabled','disabled');
                }

                else if($this.prop("checked") == false){
                    fbButton.attr('disabled','disabled');
                }
            });
            /*end 05-23-15*/
        });
    </script>
@stop