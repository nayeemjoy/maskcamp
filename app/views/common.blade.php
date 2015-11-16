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
        <!-- LestSideBar -->
        @include('sections.leftsidebar')
        <!-- end of leftside bar -->

        <div class="col-lg-6 col-md-6 col-sm-6 section-02">
          
          <div class="wrapper">

            <div class="mobile-display-header mobile-display-header-cr well navbar-fixed-top">Common Room</div><!--01-07-15-->
            <div class="row">
               <div class="col-lg-12">
                    <!-- Create Post Section  -->
                     @include('sections.createPost')
                    <!-- Create Post Section End -->
               </div>
            </div>
            <div class="row poll-section"><!--05-10-15-->
              <div class="col-lg-12">
                <div class="trends-header"><span class="glyphicon glyphicon-certificate page-icon" aria-hidden="true"></span>Trends</div> 
              </div>       
            </div>

            <div class="row trends"><!--05-10-15-->
                @foreach($data['tags'] as $tag)
              	<div class="col-lg-4 col-md-4 col-sm-4">
                	<div class="trend-class">
                 		<a href="#" class="trends-link tags">{{$tag->tag}}</a><!-- Eve-26-May-Ehsan -->
                	</div>
             	</div>
                @endforeach          
            </div>

            <div class="row hash-search"><!--05-10-15-->          
                 <input type="text" class="form-control" placeholder="Search Hashtags"> <!-- 5-7-Ehsan -->                   
                 <span class="glyphicon glyphicon-search pull-right" aria-hidden="true"></span>
                 <div class="row hashresulttable hiddenpostpart"><!-- 5-7-Ehsan -->
                      <ul>
                      </ul>
                 </div>       
            </div>
            
            <div class="btn-view-more-posts"> <!-- 5-7-Ehsan -->
                <div class="view-more-posts" data-viewmoretype="2" data-lastpost="0"><img src="{{asset('img/379.GIF')}}"></div> <!-- 5-7-Ehsan -->
            </div>

          </div> <!-- .wrapper -->
            <!-- START!!!!!!19-May-Ehsan -->
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
            <!--11/9/15-turash-->
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
                                                                 
                            <textarea  id="text-input-report" rows="3" cols="20" class="form-control" placeholder="Message(Optional)"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default button btn-modified" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-default save-button sub-report btn-modified">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--end-11/9/15-turash-->
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
            <!--11/9/15-turash-->
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
                            <!--11/8/15-turash-->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default button btn-modified" data-dismiss="modal">No</button>
                                <button type="button" class="btn btn-default save-button btn-modified">Yes</button>
                            </div>
                      </div>
                </div>
            </div>
            <!--end-11/9/15-turash-->
            <!-- END!!!!!!19-May-Ehsan -->
           
        </div> <!-- .section-02 -->

        <div class="col-lg-3 col-md-3 col-sm-3 hidden-xs"></div>
        <!-- starting of rightside bar -->
        @include('sections.rightsidebarforcommon')
        <!-- end of right side bar -->

      </div>

    </div>
    
@stop

@section('script')

    <!-- javascript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/cm-xs-sidebars.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
        
          /*01-07-15*/
          var navItem = $('.navbar-nav>li:nth-child(4)>a');
          navItem.addClass('mc-nav-items'); 
          $('.post-area>textarea').attr('placeholder','Share With All MaskCamp Users');

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
          /*end of 01-07-15*/

          /*start-11/8/15-turash*/
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
          /*end-11/8/15-turash*/

          /*Turning the posttypes to 1 for common room posts*/
          $('div.post-area').attr('data-posttype', '1'); <!-- ///////////////////06-May-2015-Ehsan -->
          
          $('.glyphicon-search').css({  /*05-10-15*/
            'color':'rgb(117, 114, 114)',
            'margin-bottom':'15px'
          });

          $('div.section-02 .mc-post-area-style').addClass('mc-post-area-not-profile'); /*5-7-Ehsan*/

          $('div.post-area div.checkbox').removeClass('hiddenpostpart'); //16-11-Ehsan
        
        });
    </script>   

@stop

  