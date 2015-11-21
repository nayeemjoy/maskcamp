@extends('layouts.default')

@section('body')

  <!-- Facebook SDK init 24-May -->
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=374453862708387";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <!-- !!!!!Facebook SDK init -->

  @include('sections.header')
  <div class="container-fluid scroll-section">
      
      <div class="row">

        <!-- E -->
        <div class="col-lg-3 col-md-3 col-sm-3 hidden-xs"></div>
        <!-- !E -->
        <!-- Left side bar -->
        @include('sections.leftsidebar')
        <!-- Left side bar ends -->
        <!-- Post Start Section -->
        <div class="col-lg-6 col-md-6 col-sm-6 section-02">
          
          <div class="wrapper">
            <div class="mobile-display-header mobile-display-header-fr well navbar-fixed-top">Friends Room</div><!--01-07-15-->
                <div class="visible-xs" style="min-height:1px;"></div> <!-- 5-7-Ehsan -->
            <!-- Create Post Section  -->
              @include('sections.createPost')
            <!-- Create Post Section End -->

                <!--Admin-banner-slider-->
                <div id="carousel-example" class="carousel slide" data-ride="carousel">
                  <!-- Wrapper for slides -->
                    <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                         <div class="carousel-inner">
                              <div class="item active">
                                  <div class="carousel-content">
                                      <div class=" carousel-content-02">
                                          <h2></h2>
                                          <p>In <b>Friends Room</b>, everybody is your Facebook friend.</p>
                                      </div>
                                  </div>
                              </div>
                              <div class="item">
                                  <div class="carousel-content">
                                      <div class=" carousel-content-02">
                                          <h2></h2>
                                          <p>In <b>Common Room</b>, everybody is a MaskCamp user.</p>
                                      </div>
                                  </div>
                              </div>
                              <div class="item">
                                  <div class="carousel-content">
                                      <div class=" carousel-content-02">
                                          <h2></h2>
                                          <p>You can change your mask from <a href="https://www.maskcamp.com/profile">Profile</a>.</p>
                                      </div>
                                  </div>
                              </div>
                              <div class="item">
                                  <div class="carousel-content">
                                      <div class=" carousel-content-02">
                                          <h2></h2>
                                          <p>Do not violate the <a href="https://www.maskcamp.com/terms"
                                          target="_blank">Terms Of Uses</a>.</p>
                                      </div>
                                  </div>
                              </div>
                              <div class="item">
                                  <div class="carousel-content">
                                      <div class=" carousel-content-02">
                                          <h2></h2>
                                          <p>Put on a mask, speak your mind.</p>
                                      </div>
                                  </div>
                              </div>                            
                            </div>
                        </div>
                    </div>
                  <!-- Controls --> <a class="left left-02 carousel-control" href="#carousel-example" data-slide="prev">
                  <span class="glyphicon glyphicon-chevron-left"></span></a>
                  <a class="right right-02 carousel-control" href="#carousel-example" data-slide="next">
                  <span class="glyphicon glyphicon-chevron-right"></span></a>

            </div>
          
            <div class="btn-view-more-posts"> <!-- 5-7-Ehsan -->
                <div class="view-more-posts" data-viewmoretype="1" data-lastpost="0"><img src="{{asset('img/379.GIF')}}"></div> <!-- 5-7-Ehsan -->
            </div>
          
            <!-- Start///19-May-Ehsan -->
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
                            <button type="button" class="btn btn-default button btn-modified" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-default save-button btn-modified">Delete</button>
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
                            <button type="button" class="btn btn-default button btn-modified" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-default save-button sub-report btn-modified">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--/////Commented out the commentDeleteModal//////////13-May-2015-Ehsan-->
            <!-- <div class="modal fade" id="commentDeleteModal"  role="dialog" data-cmt_id="none">
                <div class="modal-dialog">
                      <div class="modal-content">
                            <div class="modal-header">
                                  <button type="button" class="close modal-close" data-dismiss="modal">X</button>
                                  <h4 class="modal-title">Delete Comment</h4>
                            </div>
                            <div class="modal-body">                                            
                                  <h5>Are you sure to delete this?</h5>
                            </div>
                            <div class="modal-footer">
                                  <button type="button" class="btn btn-default button" data-dismiss="modal">Close</button>
                                  <button type="button" class="btn btn-default save-button">Yes</button>
                            </div>
                      </div>
                </div>
            </div>  -->
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
                                <button type="button" class="btn btn-default button btn-modified" data-dismiss="modal">No</button>
                                <button type="button" class="btn btn-default save-button btn-modified">Yes</button>
                            </div>
                      </div>
                </div>
            </div>

            <!-- ***START***23-6-Ehsan -->
            <!--06-15-15-Turash-->
            <?php $pictures = $data['pictures']; ?>
            
            <div class="modal fade  " id="welcomeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <!--<h3>Introduction</h3>-->
                          <button type="button" class="close close-02" data-dismiss="modal" aria-hidden="true">&times;</button>
                      </div>
                      <div class="modal-body welcome-modal-body">
                          <!-- Indicators -->
                          <div class="carousel slide" id="MyCarousel" data-interval="false">
                             
                              <!-- Wrapper for slides -->
                              <div class="carousel-inner">
                                  <div class="item active">
                                      <div class="carousel-content">
                                          <div class="mc-help-slide carousel-content-02">
                                              <h4>Welcome To Maskcamp</h4>
                                              <p>MaskCamp is an anonymous social networking site based on Facebook login. This application lets users share posts and comments anonymously with their Facebook friends (Friends Room), Campus(Campus Room) and with others who are using MaskCamp(Common Room). So, put on a mask, speak your mind.</p><!-- 9-7-Ehsan -->
                                              <p>Read the <a href="https://www.maskcamp.com/terms" target="_blank">Terms Of Uses</a>.</p><!-- 9-7-Ehsan -->
                                          </div>
                                      </div>
                                  </div>
                                  <div class="item">
                                      <div class="carousel-content">
                                          <div class="mc-help-slide carousel-content-02">
                                              <h4>Select Your Mask</h4>
                                               <div class="row mask-selection"><!--user img choice-->
                                                  <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <div class="img-choice">
                                                      <!-- ***********START*********5-7-Ehsan -->
                                                      @foreach($pictures as $picture)
                                                        <label class="radio-inline mask-choices">
                                                          
                                                          <div class="row full-percent-width">
                                                            <div class="col-xs-6">
                                                              <input type="radio" name="inlineRadioOptions" id="inlineRadio{{$picture->id}}" value="{{$picture->id}}">
                                                            </div>
                                                            <div class="col-xs-6"> 
                                                              <img src="{{asset($picture->url)}}" class="img-responsive img-rounded radio-img">
                                                            </div>
                                                          </div>

                                                        </label>
                                                      @endforeach
                                                      <!-- ***********END*********5-7-Ehsan -->
                                                    </div>
                                                  </div>
                                                </div>
                                                <p>Here are three masks. One is common for all users and the rest of the twos are based on your gender. You can change your mask later from <a href="https://www.maskcamp.com/profile">Profile</a>.</p>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="item">
                                      <div class="carousel-content">
                                          <div class="mc-help-slide carousel-content-02">
                                              <h4>Navigations</h4>                                            
                                              <div class="row welcome-poll">
                                                <div class="col-lg-12 col-md-12 col-sm-12">                                                                     <li><span class="glyphicon glyphicon-home"  
                                                    aria-hidden="true"></span>
                                                    <span class="welcome-header-text">In Friends Room, Everybody Is Your Facebook Friends.</span></li>
                                                    <li><span class="glyphicon glyphicon-globe" aria-hidden="true"></span>
                                                    <span class="welcome-header-text">In Common Room, Everybody Is A MaskCamp User.</span></li>
                                                    <li><span class="glyphicon glyphicon-education" aria-hidden="true"></span>
                                                    <span class="welcome-header-text">In Campus, Everybody Is From Your Campus.</span></li>            
                                                    <li><span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                                    <span class="welcome-header-text">You Can Change Your Mask, Update Confession, See Your social Judgement Ratio From Profile Page.</span></li>                       
                                                </div>
                                              </div>                                                                                
                                          </div>
                                      </div>
                                  </div>    
                                  <div class="item">
                                      <div class="carousel-content">
                                          <div class="mc-help-slide mhs-soc-judge carousel-content-02">
                                              <h4>Your Social Judgement</h4>                                            
                                              <div class="media">
                                                <div class="media-left">
                                                   <canvas id="result-chart-welcome" width="95" height="100"></canvas>
                                                </div>
                                                <div class="media-body media-middle"> 
                                                  <p>Statistics of the ratio of total likes and dislikes of all your posts. Hover over the doughnut chart to see the values.</p>
                                                </div>
                                              </div>                                   
                                          </div>
                                      </div>
                                  </div>
                                  <div class="item">
                                      <div class="carousel-content">
                                        <div id="main-inst-selec-div" data-curpage="home">
                                         <div class="mc-help-slide carousel-content-02">
                                              <h4>Select Your Institution</h4>                                            
                                              <div class="media">
                                                <div class="mc-inst-select">
                                                    @if($data['isValid'] == "0")
                                                    <select class="form-control wc-inst-list">
                                                    <?php $campuses = $data['campuses']; ?>
                                                      @foreach($campuses as $campus)
                                                        <option data-campusid="{{$campus->id}}">{{$campus->name}}</option> <!-- data-campusid is for col `id` in table `campuses` -->
                                                      @endforeach
                                                    </select>
                                                    @else
                                                    <select disabled="disabled" class="form-control wc-inst-list">
                                                      <option data-campusid="">{{$data['campus']}}</option> <!-- data-campusid is for col `id` in table `campuses` -->
                                                    </select>
                                                    @endif

                                                </div>
                                                <div class="media-body media-middle"> 
                                                  @if($data['isValid'] == "0")
                                                  <p>You can select your Institute from here. After selection you won't be able to change it for the next 30 days.</p>
                                                  @else
                                                  <p>You have already selected your Institute. You must wait for a period of 30 days from the day you selected it, in order to be able to change it again.</p>
                                                  @endif
                                                </div>
                                                <button class="btn btn-rsb btn-modified" disabled="disabled">Select An Institute</button><!-- 9-7-Ehsan -->
                                              </div>                                   
                                          </div>
                                        </div><!-- #main-inst-selec-div -->
                                      </div>
                                  </div>
                                  <div class="item">
                                      <div class="carousel-content">
                                          <div class="mc-help-slide carousel-content-02">
                                              <h4><span class="page-icon glyphicon glyphicon-stats" aria-hidden="true"><span class="welcome-header-text">Poll</span></h4>                                            
                                              <div class="row welcome-poll">
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                   <p>Do You think you need anonimity?</p>   
                                                      <div class="welcome-radio">                                         
                                                        <label class="radio-inline">
                                                          <input type="radio" disabled="disabled" name="inlineRadioOptions" id="inlineRadio1" value="option1"> Yes
                                                        </label>
                                                        <label class="radio-inline">
                                                          <input type="radio" disabled="disabled" name="inlineRadioOptions" id="inlineRadio2" value="option2"> No
                                                        </label>
                                                        <label class="radio-inline">
                                                          <input type="radio" disabled="disabled" name="inlineRadioOptions" id="inlineRadio3" value="option3"> Maybe
                                                        </label><br>

                                                      </div>
                                                      <button disabled="disabled btn-modified" class="btn btn-rsb poll-submit">Submit</button>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6"> 
                                                  <p class="top-margined-paragraph">You can take part in the daily poll in MaskCamp.</p>
                                                </div>
                                              </div>                                                                                
                                          </div>
                                      </div>
                                  </div>  
                                  <div id="editModal" class="item">
                                      <div class="carousel-content">
                                          <div class="mc-help-slide carousel-content-02">
                                              <h4>Confession</h4>                                            
                                              <div class="row welcome-poll">
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                     
                                                      <div class="welcome-confession">
                                                        @if($data['enable'])
                                                        <textarea class="form-control wc-confession-textarea" rows="2" placeholder="Update Confession(Optional)"></textarea>
                                                        @else
                                                        <blockquote class="confession-text">{{htmlentities($data['confess'])}}</blockquote>
                                                        @endif
                                                        
                                                      </div>
                                                      @if($data['enable'])
                                                      <button id="editMyCfsn" data-curpage="home" class="btn btn-rsb poll-submit btn-modified">Update</button>
                                                      @endif
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6"> 
                                                  <p class="top-margined-paragraph">Confession will be deleted automatically after 24 hours.In the meantime you won't be able to edit this. You can update this from Profile page
                                                  </p>
                                                </div>
                                              </div>                                                                                
                                          </div>
                                      </div>
                                  </div>                          
                              </div>
                              <!-- Controls -->
                              <!--<a href="#MyCarousel" class="left left-02 carousel-control" data-slide="prev"><span class="icon-prev"></span></a>
                              <a href="#MyCarousel" class="right right-02 carousel-control" data-slide="next"><span class="icon-next"></span></a>-->
                          </div>
                      </div>
                      <div class="modal-footer">
                          <button href="#MyCarousel" data-slide="prev" class="btn slideButton btn-modified"><span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span></button>
                          <button href="#MyCarousel" data-slide="next" class="btn slideButton btn-modified"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></button>
                          <button type="button" class="btn btn-default btn-modified" data-dismiss="modal">
                              Close
                          </button>
                          <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                      </div>
                  </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div>
            <!--end-of-06-15-15-Turash-->
            <!-- ****END****23-6-Ehsan -->

            <!-- End!!!!19-May-Ehsan -->
          </div> <!-- .wrapper -->
           
        </div>


        <!-- Post End Section -->

        <div class="col-lg-3 col-md-3 col-sm-3 hidden-xs"></div>

        <!-- Right Side Bar Start -->
          @include('sections.rightsidebar')
        <!-- Right Side Bar End -->
      </div> <!-- first .row -->

    </div> <!-- .container-fluid scroll-section -->
  
  
@stop

@section('script')

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/cm-xs-sidebars.js"></script>
    <script src="js/smoothscroll.js"></script>
    <script type="text/javascript">
         $(document).ready(function(){
         
            
            var navItem = $('.navbar-nav>li:nth-child(2)>a');
            navItem.addClass('mc-nav-items'); /*01-07-15*/
            $('.post-area>textarea').attr('placeholder','Share With Your Facebook Friends');

            /*01-07-15*/
            var w = window.innerWidth;

            if(w>767){
             
              navItem.css({'border-radius':'50%'}); 
            }

            else if(w<768){

              $('.post-area>textarea').attr('rows','3');
              navItem.css({ 'border-bottom': '12px solid #247A9C'
                                                    }); 
            }
            
            @if($data['prev_question'])
            var data = [
                {
                    value: {{$data['answers'][1]['total_answer']}},
                    color:"#B2DBF3",
                    highlight: "#B2DBF3",
                    label:  "{{$data['answers'][1]['option_details']}}"
                },
                {
                    value: {{$data['answers'][2]['total_answer']}},
                    color: "#94CBEC",
                    highlight: "#94CBEC",
                    label: "{{$data['answers'][2]['option_details']}}"
                },
                {
                    value: {{$data['answers'][3]['total_answer']}},
                    color: "#70D7FF",
                    highlight: "#70D7FF",
                    label: "{{$data['answers'][3]['option_details']}}"
                }
            ];
            var ctx = document.getElementById("result-chart").getContext("2d");
            var myNewChart = new Chart(ctx).Doughnut(data, {
                animateScale: true,
                segmentStrokeWidth : 4,
                segmentStrokeColor : "#2c3a49"
            });
            @endif

            /*From 06-15-14 Turash, 23-6-Ehsan*/
            $(window).load(function(){
                @if(Input::get('n'))
                $('#welcomeModal').modal('show');
                @endif
            });

            var dataWelcome = [
                {   
                    value: 80,
                    color: "#6bc36b",                    
                    highlight: "#6bc36b",
                    label: "Like"
                },
                {
                    value: 20,
                    color:"#e25e5a",                    
                    highlight: "#e25e5a",
                    label: "Dislike"
                },
            ];
            var ctxWelcome = document.getElementById("result-chart-welcome").getContext("2d");
            var myNewChart = new Chart(ctxWelcome).Doughnut(dataWelcome, {
                animateScale: true,
            });
            /*!!!!!From 06-15-14 Turash, 23-6-Ehsan*/

            ///23-6-Ehsan
            //Set the current profile picture radio button as checked
            var currentPicture = $('div.section-01').find('img.user-img'),
                currentPictureVal = currentPicture.attr('data-userpicture');

            $('div.img-choice').find('input[type=radio]').each(function(){
                var $this = $(this);
                if ($this.val() == currentPictureVal) {
                    $this.prop('checked', true);
                    currentPicture.attr('src', $this.closest('label').find('img').attr('src')); //5-7-Ehsan
                }
            });
            //!!!!!23-6-Ehsan

            $('div.section-02 .mc-post-area-style').addClass('mc-post-area-not-profile'); /*5-7-Ehsan*/

          });
    </script>
@stop