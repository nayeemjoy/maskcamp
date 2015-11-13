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
        <!-- left side start -->
        @include('sections.leftsidebarforprofile')
        <!-- left side end -->

        <div class="col-lg-6 col-md-6 col-sm-6 section-02 section-02-profile">
          
          <div class="wrapper">
          
              <div class="row">
                <div class="mobile-display-header mobile-display-header-p well navbar-fixed-top">Profile</div><!--01-07-15-->    
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <ul id="myTab" class="nav nav-justified nav-tabs tab-system profile-mobile">
                     <li class="active" data-viewmoretype="4" data-scrollfinished="no"> <!-- 5-7-Ehsan -->
                        <a href="#posts" data-toggle="tab" class="posts-polls-tab">
                           Friends Room Posts
                        </a>
                     </li>
                     <li data-viewmoretype="5" data-scrollfinished="no"><a href="#polls" data-toggle="tab" class="posts-polls-tab">Common Room Posts</a></li><!-- 5-7-Ehsan -->
                     <li data-viewmoretype="6" data-scrollfinished="no"><a href="#campus" data-toggle="tab" class="posts-polls-tab">Campus Posts</a></li><!-- 5-7-Ehsan -->
                  </ul>
                  <div id="myTabContent" class="tab-content">
                    <!--**********START***************************** 5-7-Ehsan -->
                    <div class="tab-pane fade in active" id="posts">                                             
                        @include('sections.createPost')
                        <div class="btn-view-more-posts">             
                          <div class="view-more-posts" data-viewmoretype="4" data-lastpost="0"><img src="{{asset('img/379.GIF')}}"></div> <!-- 5-7-Ehsan -->
                        </div>
                        
                    </div>
                        
                    <div class="tab-pane fade" id="polls">
                        @include('sections.createPost')
                        <div class="btn-view-more-posts">             
                          <div class="view-more-posts" data-viewmoretype="5" data-lastpost="0"><img src="{{asset('img/379.GIF')}}"></div> <!-- 5-7-Ehsan -->
                        </div>

                     </div>
                     
                     <div class="tab-pane fade" id="campus">                     
                        @include('sections.createPost')
                        <div class="btn-view-more-posts"> 
                          <div class="view-more-posts" data-viewmoretype="6" data-lastpost="0"><img src="{{asset('img/379.GIF')}}"></div> <!-- 5-7-Ehsan -->
                        </div>
                        
                    </div>
                    <!--**********END***************************** 5-7-Ehsan -->
                  </div>
                </div> <!-- .col-lg-12 col-md-12 col-sm-12 col-xs-12 -->
              </div>  <!-- .row -->
             <!-- !E -->       
          </div> <!-- .wrapper -->

            <!--START/////////19-May-2015-Ehsan-->
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
            <!--END/////////19-May-2015-Ehsan-->

        </div> <!-- .section-02-profile -->

        <div class="col-lg-3 col-md-3 col-sm-3 hidden-xs"></div>
        <!-- eight side bar begin -->
        @include('sections.rightsidebarforprofile')
        <!-- right side bar end -->
        
        <!-- Commented this out-19-May-2015-Ehsan -->
        <!-- <div class="modal fade" id="addModal"  role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close modal-close" data-dismiss="modal">X</button>
                      <h4 class="modal-title">Add another confession</h4>
                    </div>
                    <div class="modal-body">                                            
                      <textarea  id="text-input-add-con" rows="8" cols="20" class="form-control"></textarea>
                    </div>
                    <div class="modal-footer">
                       <button type="button" class="btn btn-default button" data-dismiss="modal">Close</button>
                       <button type="button" class="btn btn-default save-button">Save</button>
                    </div>
                </div>
            </div>
        </div>  -->
        <div class="modal fade" id="editModal"  role="dialog"><!--This appears when the question button is clicked -->
            <div class="modal-dialog modal-dialog-02">
                <div class="modal-header">
                    <button type="button" class="close modal-close" data-dismiss="modal">X</button>
                    <div class="modal-content modal-content-02">
                      <h4 class="modal-title modal-title-02">Add confession</h4><!-- 19-May-2015-Ehsan -->
                    </div>
                    <div class="modal-body">                                            
                      <textarea id="text-input-edit-con" rows="8" cols="20" class="form-control"></textarea>
                    </div>
                    <div class="modal-footer">
                       <button type="button" class="btn btn-default button" data-dismiss="modal">Close</button>
                       <button type="button" data-curpage="profile" class="btn btn-default save-button" id="editMyCfsn">Save</button><!-- 23-6-Ehsan -->
                    </div>
                </div>
            </div>
        </div>     

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
    <script>
    
      var navItem = $('.navbar-nav>li:nth-child(5)>a'); 
      navItem.addClass('mc-nav-items'); /*01-07-15*/
      /*01-07-15*/
      var w = window.innerWidth;

      if(w>767){
       
        navItem.css({'border-radius':'50%'});         
      }

      else if(w<768){

        $('.post-area>textarea').attr('rows','3'); /*5-7-Ehsan*/
        navItem.css({ 'border-bottom': '12px solid #247A9C'
                                                    }); 
      }
      /*end of 01-07-15*/
      /******START****5-7-Ehsan*/
      $('.post-area').each(function(){
          var $this = $(this),
              viewMoreType = parseInt($this.closest('.tab-pane').find('div.btn-view-more-posts > div.view-more-posts').attr('data-viewmoretype'));
          if (viewMoreType == 4) {
            $this.children('textarea').attr('placeholder','Share With Your Facebook Friends');
          } else if (viewMoreType == 5) {

            $this.attr('data-posttype', "1");
            $this.children('textarea').attr('placeholder','Share With All MaskCamp Users');

          } else if (viewMoreType == 6) {

            $this.attr('data-posttype', "2");
            $this.children('textarea').attr('placeholder','Share With All Users Of Your Campus');

          }
          
      });
      /******END****5-7-Ehsan*/

      //confession text field code
      var confession = document.getElementById("confession");
      var confessionText = confession.innerHTML;

      var textEdit = document.getElementById("text-input-edit-con");
      textEdit.innerHTML = confessionText;
      //end of confession text field code
      var data = [
                {
                    value: {{$my_posts['like']}},
                   color:"#5cb85c",
                   highlight: "#6bc36b",
                    label: "Like"
                },
                {
                    value: {{$my_posts['dislike']}},
                    color: "#d9534f",
                  highlight: "#e25e5a",
                  label: "Dislike"
                }
            ]
      var ctx = document.getElementById("result-chart").getContext("2d");
      var myNewChart = new Chart(ctx).Doughnut(data, {
          animateScale: true,
      });
      var data_02 = [
                {
                    value: {{$followings['like']}},
                   color:"#5cb85c",
                   highlight: "#6bc36b",
                    label: "Like"
                },
                
                {
                    value: {{$followings['dislike']}},
                    color: "#d9534f",
                  highlight: "#e25e5a",
                  label: "Dislike"
                }
            ]

      var ctx_02 = document.getElementById("result-chart-02").getContext("2d");
      var myNewChart = new Chart(ctx_02).Doughnut(data_02, {
          animateScale: true,
      });

      var data_03 = [
                {
                    value: {{$followers['like']}},
                    color:"#5cb85c",
                   highlight: "#6bc36b",
                    label: "Like"                },
                
                {
                    value: {{$followers['dislike']}},
                    color: "#d9534f",
                  highlight: "#e25e5a",
                  label: "Dislike"
                }
            ]

      var ctx_03 = document.getElementById("result-chart-03").getContext("2d");
      var myNewChart_02 = new Chart(ctx_03).Doughnut(data_03, {
          animateScale: true,
      });

      var data_04 = [
                {
                    value: {{$friends['like']}},
                    color:"#5cb85c",
                   highlight: "#6bc36b",
                    label: "Like"
                },
                
                {
                    value: {{$friends['dislike']}},
                    color: "#d9534f",
                  highlight: "#e25e5a",
                  label: "Dislike"
                }
            ]

      var ctx_04 = document.getElementById("result-chart-04").getContext("2d");
      var myNewChart_03 = new Chart(ctx_04).Doughnut(data_04, {
          animateScale: true,
      });

      ///19-May-2015-Ehsan
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
      //!!!!!19-May-2015-Ehsan
     
     /*Modifying the post-area so that new posts don't have functionality on tags*/
      $('div.post-area').attr('data-tagflag', '1'); /*Eve-26-May-Ehsan*/
     
    </script>

@stop