@extends('layouts.default')

@section('body')
	<?php use Emojione\Emojione; ?>
  	@if(!Auth::check())
  <header class="navbar-fixed-top">
      <div class="container-fluid">
        <div class="row">
            <div class="visible-xs hidden-sm hidden-md hidden-lg" id="xs-flag"></div>     
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">       
               <h1 class="title">MaskCamp<small class="beta">Beta</small></h1>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 pull-right login-section" id="login">
               <a class="btn btn-primary btn-login" href="{{URL::to('/login')}}"><span class="page-icon glyphicon glyphicon-log-in" aria-hidden="true"></span>Login</a><!--05-                          27-15-turash-->  
            </div>
        </div>
      </div>
    </header>
  @else
  @include('sections.header')

  @endif
  	<div class="container-fluid scroll-section">
      
      <div class="row">

        <!-- E -->
        <div class="col-lg-3 col-md-3 col-sm-3 hidden-xs"></div>
        <!-- !E -->
        
        <div class="section-01 col-xs-12 hidden-xs">

          <!-- E -->    
          <span class="visible-xs sidebar-x-button glyphicon glyphicon-home pull-right" id="cm-left-sidebar-x"aria-hidden="true"></span>
          
          <!-- START17-6-Ehsan -->
          <div style="margin-top:2em;"></div><!-- 17-6-Ehsan -->
          
          <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
          <!-- MaskCamp_add -->
          <ins class="adsbygoogle"
          style="display:block"
          data-ad-client="ca-pub-9655967198342604"
          data-ad-slot="1757680375"
          data-ad-format="auto"></ins>
          <script>
          (adsbygoogle = window.adsbygoogle || []).push({});
          </script>
          <!-- END17-6-Ehsan -->
          
          <ul class="visible-xs" id="cm-ul-full">                                       
            <li class="btn btn-success btn-lg btn-block"><a href="{{URL::to('/home')}}">Home</a></li>
            <li class="btn btn-success btn-lg btn-block"><a href="{{URL::to('/commonroom')}}">Common Room</a></li>           
            <li class="btn btn-success btn-lg btn-block"><a href="{{URL::to('/profile')}}">Profile</a></li>
            <li class="btn btn-success btn-lg btn-block"><a href="{{URL::to('/logout')}}">Logout</a></li>                              
          </ul>

          <!-- !E -->
          
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 section-02" data-singlepage="1">
          
          <div class="wrapper">


            <!-- <div class="row"> --><!-- 27-May-Ehsan -->
              <?php $post =  $data['post'];?>
              @if($post)
                <div class="row post-display-section">
                  
                  <div class="post-display" data-user = "{{$post['user_id']}}" id="{{$post['id']}}">

                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"><!--05-10-15-->
                      <img src="{{$post['img']}}" class="img-responsive img-rounded cm-img-pop" 
                           data-user="{{$post['user_id']}}" data-img_canvas_id="cvs-{{$post['id']}}" 
                           data-toggle="tooltip" data-placement="bottom" data-html="true" 
                           title="<canvas id='cvs-{{$post['id']}}' width='100' height='100'></canvas>"><!-- 19-May-Ehsan -->
                        @if(Auth::check())
                        @if($post['type'] == "1")
                          @if($post['user_id'] != Auth::user()->id) <!-- ///////////////////06-May-2015-Ehsan -->
                            <!-- 27-May-Ehsan -->
                            @if($post['following'])
                              <!--Already Follwing -->
                              <button class="btn btn-success btn-follow followed">Followed</button>
                            @else
                              <!--Not Follwing Yet-->
                              <button class="btn btn-success btn-follow">Follow</button>
                            @endif
                            <!-- !!!27-May-Ehsan -->
                          @endif
                        @endif
                        @endif
                        
                        @if($post['type'] != "1") <!-- 17-11-Ehsan -->
                          @if($post['confess'])
                          <button class="btn btn-primary btn-confession" aria-hidden="true" data-toggle="modal" data-target="#confessionModal-{{$post['id']}}" title="Click this button to see the confession.">Confession</button>
                          @endif
                        @endif

                    </div>
                             
                    @if($post['type'] != "1") <!-- 17-11-Ehsan -->
                    @if($post['confess'])
                    <div class="modal fade" id="confessionModal-{{$post['id']}}" role="dialog"><!--10-04-15-->
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close modal-close" data-dismiss="modal">X</button>
                                  <h4 class="modal-title">Confession</h4>
                                </div>
                                <div class="modal-body">                                                                 
                                   <blockquote class="confession-text">{{$post['confess']}}</blockquote>
                                </div>
                                <div class="modal-footer">
                                   <button type="button" class="btn btn-default button" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endif

                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7 post-text"><!--05-10-15-->
                      <!-- Start///////////////////06-May-2015-Ehsan -->
                      <div class="row"> 
                           @if($post['feeling'] == "None")
                           <div class="col-xs-12">
                             <p class="post-info"><small>{{$post['ago']}}</small></p>
                           </div>
                           @else
                           <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                             <p class="post-info"><small>{{$post['ago']}}</small></p>
                           </div>
                           <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                             <p class="post-info"><small>Feeling {{$post['feeling']}}</small></p>
                           </div>
                           @endif
                      </div>
                      <!-- End///////////////////06-May-2015-Ehsan -->
                      <p>
                        <!-- Eve-27-May-Ehsan -->
			<?php 

                        	
                          $text = preg_replace('#((https?|ftp)://(\S*?\.\S*?))([\s)\[\]{},;"\':<]|\.\s|$)#i','<a target="_blank" href="$1">$1</a>', $post['post']);
	          	 if($post['type'] != 0){
                            $text = preg_replace('/#([a-zA-Z0-9\x{0980}-\x{09FF}_])+/u','<a href="#" class="">$0</a>',$text);
                          }
                            $text = nl2br($text);
                            $text = Emojione::shortnameToImage($text);
                            	
                      	?>
                        {{$text}}

                        <!-- !!!Eve-27-May-Ehsan -->
                      </p>
                      <!-- 9-2 -->
                      @if($post['vidsrc'])
                      <div class="row mc-no-margin-padding embed-responsive embed-responsive-16by9">
                      
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$post['vidsrc']}}" allowfullscreen></iframe>

                      </div>
                      @endif
                      <!-- 9-2 End -->
                      <!-- Start///////////19-May-2015-Ehsan -->
                      <div class="row like-dislike-comment">
                          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                             <!-- <span class="pull-right count">{{$post['like']}}</span> -->
                             <!-- Already Liked Checking Start-->
                             @if($post['liked'])
                             <!-- Already Liked -->
                             <span class="glyphicon glyphicon-thumbs-up like-img liked" data-liked="1" data-liketype="post"></span>
                             @else
                             <!-- Not Liked Yet -->
                             <span class="glyphicon glyphicon-thumbs-up like-img" data-liked="0" data-liketype="post"></span>
                             @endif
                             <!-- Already Liked Checking End-->
                            
                          </div>
                          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <!-- <span class="pull-right count">{{$post['dislike']}}</span> -->
                            <!-- Already Disliked Checking Start-->
                            @if($post['disliked'])
                                <!-- Already disLiked -->
                            <span class="glyphicon glyphicon-thumbs-down dislike-img disliked" data-liked="3" data-liketype="post"></span>
                            @else
                                <!-- Not disLiked Yet -->
                            <span class="glyphicon glyphicon-thumbs-down dislike-img" data-liked="2" data-liketype="post"></span>
                            @endif
                            <!-- Already Disliked Checking End --> 
                            
                          </div>
                          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                             <!-- <span class="pull-right count comment-count">{{$post['comment']}}</span> -->
                             <span class="glyphicon glyphicon-comment comment-img cm-commenter" data-reqsource="commenter"></span> <!-- ///////////////////06-May-2015-Ehsan -->
                          </div>
                      </div>
                      <!-- End/////////19-May-2015-Ehsan -->

                      <!-- START-17-11-Ehsan -->
                      <ul class="list-inline ul-like-dislike-comment-count">
                          <li><small>Likes: <span class="pull-right count">{{$post['like']}}</span></small></li>
                          <li><small>Dislikes: <span class="pull-right count">{{$post['dislike']}}</span></small></li>
                          <li><small>Comments: <span class="pull-right count comment-count">{{$post['comment']}}</span></small></li>
                      </ul>
                      <!-- END-17-11-Ehsan -->

                      <!-- E -->
                      <div class="row cm-comments" data-state="unavailable">
                          
                          <!-- Comments -->

                         
                      </div>

                      
                      <!-- !E -->

                    </div>
                    <!-- 27-May-Ehsan -->
                    @if(Auth::check())
                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-2"><!--10-04-15-->
                      <div class="row">
                      <div class="btn-group pull-right">
                          <button type="button" class="btn btn-primary dropdown-toggle post-options" data-toggle="dropdown" aria-expanded="false">
                             <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu option-class" role="menu">
                            <!-- //////19-May-2015-Ehsan -->
                            
                            @if($post['user_id'] == Auth::user()->id) 
                            <li class="delete-li" data-deltype="0"><a href="" aria-hidden="true" data-toggle="modal" data-target="#deleteModal">Delete</a></li>
                            @else
                              
                              <li class="req-delete-li" data-deltype="0"><a href="" aria-hidden="true" data-toggle="modal" data-target="#reqDeleteModal">Request to delete</a></li>
                              @if(Auth::user()->id) <!-- 27-May-Ehsan -->
                                <li class="report-post-li"><a href="" aria-hidden="true" data-toggle="modal" data-target="#reportModal">Report</a></li>
                              @endif <!-- 27-May-Ehsan -->
                            @endif
                            
                            <!-- /!!!!!!19-May-2015-Ehsan -->
                          </ul>
                      </div>
                      </div>
                      @endif
                      
                      @if($post['type'] != "0")
                      <div class="row pull-right div-fb-share">
                        
                        <img src="{{asset('img/facebook_sh2.png')}}" data-href="{{URL::to('singlepost/'.$post['id'])}}" class="fbBtnShare">
                        <!-- <div class="fb-share-button" data-href="{{URL::to('singlepost/'.$post['id'])}}" data-layout="icon"></div>  --> 
                        <span class="custom-fb-share-count">0</span>
                      </div>
                      @endif

                    </div> <!-- div.col-lg-1 -->
                    
                  </div> <!-- div.post-display -->

                </div> <!-- div.post-display-section -->
                <!-- 27-May-Ehsan -->
                <!-- Single Post End -->
              @endif
            <!-- </div> --><!-- 27-May-Ehsan -->
            <!-- <hr> --><!-- 27-May-Ehsan -->
            <!-- Joy -->
            <div class="modal fade" id="deleteModal"  role="dialog" data-deltype="none" data-cmt_or_post_id="none"><!--13-May-2015-Ehsan-->
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close modal-close" data-dismiss="modal">X</button>
                            <h4 class="modal-title">Delete</h4><!--13-May-2015-Ehsan-->
                        </div>
                        <div class="modal-body">                                            
                            <h5>Are you sure you want to delete this?</h5><!--13-May-2015-Ehsan-->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default button" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-default save-button">Delete</button>
                        </div>
                    </div>
                </div>
            </div> 
            
            <div class="modal fade" id="reportModal"  role="dialog" data-post_id="none"><!--10-04-15-->
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close modal-close" data-dismiss="modal">X</button>
                            <h4 class="modal-title">Report Post</h4>
                        </div>
                        <div class="modal-body"> 
                            <h5>Why do you want to report this post?</h5>
                            @foreach($data['reports'] as $report)
                            <div class="radio">
                              <label>
                                <input type="radio" name="optionsRadios" id="optionsRadios1" value="{{$report->id}}">
                                {{$report->details}}
                              </label>
                            </div>
                            @endforeach
                                                                 
                            <textarea  id="text-input-report" rows="8" cols="20" class="form-control" placeholder="Message(Optional)"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default button" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-default save-button sub-report">Submit</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="reqDeleteModal"  role="dialog" data-deltype="none" data-cmt_or_post_id="none"><!--13-May-2015-Ehsan-->
                <div class="modal-dialog">
                      <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close modal-close" data-dismiss="modal">X</button>
                                <h4 class="modal-title">Request To Delete</h4><!--13-May-2015-Ehsan-->
                            </div>
                            <div class="modal-body"> 
                                <h5>Are you sure about the request to delete this?</h5><!--13-May-2015-Ehsan-->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default button" data-dismiss="modal">No</button>
                                <button type="button" class="btn btn-default save-button">Yes</button>
                            </div>
                      </div>
                </div>
            </div>
            <!-- Joy -->

          </div> <!-- .wrapper -->
           
        </div>

        <div class="col-lg-3 col-md-3 col-sm-3 hidden-xs"></div>

        <div class="section-03 section-03-full-scroll col-xs-12 hidden-xs"> <!-- 17-6-Ehsan -->
            <!-- E -->
            <div class="row visible-xs">
              <div class="col-xs-12">
                <span class="visible-xs sidebar-x-button glyphicon glyphicon-home pull-left" id="cm-right-sidebar-x"aria-hidden="true"></span>
              </div>
            </div>
            
            <!-- START17-6-Ehsan -->
            <!-- <div style="margin-top:2em;"></div> --><!-- 17-6-Ehsan -->
            <div style="padding:1em;">

              
              
              <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
              <!-- MaskCamp_add -->
              <ins class="adsbygoogle"
              style="display:block"
              data-ad-client="ca-pub-9655967198342604"
              data-ad-slot="1757680375"
              data-ad-format="auto"></ins>
              <script>
              (adsbygoogle = window.adsbygoogle || []).push({});
              </script>
              

            </div>
            <!-- END17-6-Ehsan -->
            
            <!-- !E -->      

        </div>

      </div>

    </div>
    
 
@stop

@section('script')
  <!-- Javascripts -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="{{asset('js/Chart.min.js')}}"></script>
    <script src="{{asset('js/script.js')}}"></script>
    <script src="{{asset('js/cm-xs-sidebars.js')}}"></script>
    <script src="js/smoothscroll.js"></script>
    <script type="text/javascript">
         $(document).ready(function(){

           


        });
    </script>
@stop