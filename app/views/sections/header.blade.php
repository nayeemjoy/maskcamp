<header class="navbar-fixed-top">

      <div class="container-fluid">
        <div class="row">
            <div class="visible-xs hidden-sm hidden-md hidden-lg" id="xs-flag"></div>
            <div class="col-lg-3 col-md-3 col-sm-3">
               	<a href="{{URL::to('/')}}" style="text-decoration:none"><h1 class="title">MaskCamp<small class="beta">Beta</small></h1></a>
            </div>

            <div class="col-lg-5 col-md-5 col-sm-4"> <!-- 5-7-Ehsan -->
               
                      <a class="btn btn-primary" href="{{URL::to('/carnival')}}">CSE CARNIVAL</a>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-5"> <!-- 5-7-Ehsan -->
              <nav class="navbar navbar-default custom-nav " role="navigation"><!--Navbar-->
                    <!-- E -->
                    <!-- <div class="navbar-header ">                                                   
                     <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                    </div> -->  
                    <!-- !E -->

                    <!-- <div class="collapse navbar-collapse" id="collapse"> -->
                      <ul class="nav navbar-nav nav-override-mc"><!-- 26-May-Ehsan -->
                          <!--  -->
                          <li>
                          
                            <div class="btn-group btn-group-02">
                                     @if($data['notifications']['length'] > 0)
                                     
                               	     <button type="button" class="btn btn-primary dropdown-toggle btn-notification notification-alert" id="notif-icon" data-toggle="dropdown" aria-expanded="false">
                                      <span class="">{{$data['notifications']['length']}}</span>
                                      </button><!--06-03-15-->
                                   @else
                                    	
                                	<button type="button" class="btn btn-primary dropdown-toggle btn-notification" data-toggle="dropdown" aria-expanded="false">
                                      <span class="glyphicon glyphicon-flag"></span>
                                      
                                </button> 
                                   @endif                        
                                <ul class="dropdown-menu notification-menu option-class dropdown-menu-02" role="menu">
                                  <li><h6 class="notifications">Notifications</h6></li>
                                  <?php $notifications = $data['notifications']['notifications']; ?>
                                  @if($notifications)
                                    @foreach($notifications as $notification)
                                  	@if($notification['seen'] == 0)  
                                    	<li class="notification-new"><!--06-03-15-->
                                    	@else
                                    	<li>
                                    	@endif
                                      <a target="_blank" href="{{URL::to('/viewnotification/'.$notification['id'])}}">
                                        @if($notification['type'] == 1)
                                          <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true" ></span>
                                        @elseif($notification['type'] == 2)
                                          <span class="glyphicon glyphicon-thumbs-down pull-right" aria-hidden="true" ></span>
                                        @elseif($notification['type'] == 3)
                                        
                                          <span class="glyphicon glyphicon-comment pull-right" aria-hidden="true" ></span>
                                        
                                        @endif
                                        <!-- 17-11-Ehsan -->
                                        {{$notification['msg']}}<br>
                                        <small class="notification-time">{{$notification['ago']}}</small>
                                      </a>

                                    </li>  
                                    @endforeach

                                  @else
                                      <li>
                                        <a href="#">
                                          You have no notifications currently<br>
                                        </a>
                                      </li>
                                  @endif
                                                         
                                </ul>
                            </div>           
                          </li>
                          <!--  -->
                          <!--11-21-15-turash-->
                          <li><a href="{{URL::to('/home')}}" title="Friends Room"><span class="ion-ios-people header-ion" aria-hidden="true"></span>
                          </a></li>
                          <li><a href="{{URL::to('/campus')}}" title="Campus"><span class="glyphicon glyphicon-education" aria-hidden="true"></span>
                          </a></li>  
                          <li><a href="{{URL::to('/commonroom')}}" title="Common Room"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span>
                          </a></li> 
                                   
                          <li><a href="{{URL::to('/profile')}}" title="Profile"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                          </a></li>
                          <li class="hidden-xs"><a href="{{URL::to('/logout')}}" title="Logout"><span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                          </a></li><!-- 26-May-Ehsan -->
                      </ul>                     
                    <!-- </div> --><!-- 26-May-Ehsan -->

              </nav> <!--Navbar ends --> 
            </div>

            <!-- 26-May-E -->
            <span class="glyphicon glyphicon-chevron-right like-dislike-white visible-xs" id="cm-left-sidebar-button"></span>

            <span class="glyphicon glyphicon-chevron-left like-dislike-white visible-xs" id="cm-right-sidebar-button"></span>
            <!-- !26-May-E -->

        </div>
      </div>
               
    </header>