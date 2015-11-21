(function($, document, window){ 

  /* E */ 
  //Last Modified: 18 June 2015
  //******************************************************************Like/Dislike it.
  //**********************************************************************************
  //**********************************************************************************

  function setLikeDislike() {

    var $this = $(this);
    $this.off('click');
    var theLikeType = $this.attr("data-liketype"),
        dataLiked = $this.attr('data-liked'),
        dataLiked = parseInt(dataLiked), /*Afternoon-28*/
        likeTypeVal = 0,
        theOtherClass = "",
        ajUrl = "",
        thePostOrCmtID = null,
        ldCountSpan = null, /*17-11-Ehsan*/
        ldCountVal = null, /*17-11-Ehsan*/
        baseUrl = $this.closest('body').attr('data-baseurl'); /*27-May-Ehsan*/
    
    //console.log(baseUrl);        
    /*27-May-Ehsan*/
    if (dataLiked > 1) { 
        theOtherClass = "span.like-img";
        ldCountSpan = $this.closest('.like-dislike-comment').siblings('ul.list-inline').find('li:eq(1) span.count'); /*17-11-Ehsan*/
    } else {
        theOtherClass = "span.dislike-img";
        ldCountSpan = $this.closest('.like-dislike-comment').siblings('ul.list-inline').find('li:eq(0) span.count'); /*17-11-Ehsan*/
    }
    var theOther = $this.parent().parent().find(theOtherClass);
    ldCountVal = parseInt(ldCountSpan.html()); /*17-11-Ehsan*/

    if ((dataLiked == 0) || (dataLiked == 2)) {
      ldCountSpan.html(++ldCountVal);
      theOther.off('click'); 
      theOther.addClass("like-dislike-opacity");
      if (dataLiked == 0) { 
        $this.addClass('liked');
      } else {
        $this.addClass('disliked');  
      }
    } else if ((dataLiked == 1) || (dataLiked == 3)) {
      $this.removeClass('liked disliked'); 
      ldCountSpan.html(--ldCountVal); 
      theOther.removeClass("like-dislike-opacity");
      theOther.on('click', function(){ 
        setLikeDislike.call(theOther);
      });
    }
    /*!!!27-May-Ehsan*/
    
    if (theLikeType === "post") {
        thePostOrCmtID = $this.closest('div.post-display').attr("id");
        likeTypeVal = 1;
    } else if (theLikeType === "t-f-post") {
        thePostOrCmtID = $this.closest('div.like-dislike-comment').attr("data-post_id");
        likeTypeVal = 1;
    } else {
        var theCmtID = $this.closest('div.cm-comment').attr("id");
        var cmtIDRes = theCmtID.split("-");
        thePostOrCmtID = cmtIDRes[1];
        likeTypeVal = 2;
    }
    
    if (dataLiked > 1) { 
        ajUrl = "dislike/"+thePostOrCmtID;
    } else {
        ajUrl = "like/"+thePostOrCmtID; 
    }

    if ((dataLiked == 0) || (dataLiked == 2)) { 
      
      var ajRes = $.ajax({
        url: baseUrl+"/"+ajUrl, /*27-May-Ehsan*/
        data: { type: likeTypeVal}
      }).promise();

      ajRes.done(function( theReturned ){
        if (theReturned === "true") {          
          
          var newDataLiked = dataLiked + 1;
          newDataLiked = newDataLiked.toString();
          $this.attr('data-liked', newDataLiked);

        } else {
          console.log("Action failure : dataLiked = "+dataLiked);
          console.log("Action failure : theReturned = ");
          console.log(theReturned);
          ldCountSpan.html(--ldCountVal);
          theOther.on('click', function(){setLikeDislike.call(this);});
          theOther.removeClass("like-dislike-opacity");
          $this.removeClass('liked disliked');
        }

        $this.on('click', function(){
          setLikeDislike.call(this);
        });
      });

      ajRes.fail(function( theReturned ){
        console.log("Action failure from ajRes.fail: theReturned = ");
        console.log(theReturned);
        /*Eve-28-May*/
        /*ldCountSpan.html(--ldCountVal);
        theOther.on('click', function(){setLikeDislike.call(this);});
        theOther.removeClass("like-dislike-opacity");
        $this.removeClass('liked disliked');*/

        $this.on('click', function(){
          setLikeDislike.call(this);
        });
      });

      
    } else if ((dataLiked == 1) || (dataLiked == 3)) {

      ajUrl = baseUrl+"/un"+ajUrl; /*27-May-Ehsan*/
      var ajRes = $.ajax({
        url: ajUrl,
        data: { type: likeTypeVal}
      }).promise();

      ajRes.done(function( theReturned ){
        if (theReturned === "true") {
          
          var newDataLiked = dataLiked - 1;
          newDataLiked = newDataLiked.toString();
          $this.attr('data-liked', newDataLiked);
          
        } else {
          console.log("Action failure : dataLiked = "+dataLiked);
          console.log("Action failure : theReturned = ");
          console.log(theReturned);
          if (dataLiked == 1) {
            $this.addClass('liked');
          } else if (dataLiked == 3) {
            $this.addClass('disliked');
          }
          ldCountSpan.html(++ldCountVal);
          theOther.addClass("like-dislike-opacity");
          theOther.off('click');
        }

        $this.on('click', function(){
          setLikeDislike.call(this);
        });
      });

      ajRes.fail(function( theReturned ){
        console.log("Action failure from ajRes.fail: theReturned = ");
        console.log(theReturned);
        /*Eve-28-May*/
        /*if (dataLiked == 1) {
          $this.addClass('liked');
        } else if (dataLiked == 3) {
          $this.addClass('disliked');
        }
        ldCountSpan.html(++ldCountVal);
        theOther.addClass("like-dislike-opacity");
        theOther.off('click');*/

        $this.on('click', function(){
          setLikeDislike.call(this);
        });
      });

    }
  } //setLikeDislike

  function setLikeDislikeEvents() {

    var $this = $(this),
        likeSpan = $this.find("span.like-img"),
        dislikeSpan = $this.find("span.dislike-img"),
        dataLiked = likeSpan.attr("data-liked"),
        dataDisliked = dislikeSpan.attr("data-liked");

    if (dataLiked == "1") {

        likeSpan.on('click', function(){
          setLikeDislike.call(this);
        });    

        dislikeSpan.addClass("like-dislike-opacity");

    } else if (dataDisliked == "3") {
        
        dislikeSpan.on('click', function(){
          setLikeDislike.call(this);
        });  

        likeSpan.addClass("like-dislike-opacity");

    } else if ( (dataLiked=="0") && (dataDisliked=="2") ) {

        likeSpan.on('click', function(){
          setLikeDislike.call(this);
        }); 
        
        dislikeSpan.on('click', function(){
          setLikeDislike.call(this);
        });

    }

  } //setLikeDislikeEvents

  $("div.like-dislike-comment").each( function() {
    
    setLikeDislikeEvents.call(this);

  } );

  //!Like/Dislike it.
  
  //*****************************************************Loading a newly created post.
  //**********************************************************************************
  //**********************************************************************************

  function loadTheNewPost( theReturned ) {
      var $this = this,
	  thisParent = null, /*Eve-28-May*/
          baseUrl = $this.closest('body').attr('data-baseurl'); /*28-May-Ehsan*/
      
      /*5-7-Ehsan*/
      var profileUlMyTab = $('div.section-02 > div.wrapper ul#myTab');

      if (profileUlMyTab.length) {
        thisParent = $this.closest("div.row");
      } else {
        if(theReturned.type >= 1) { /*23-6-Ehsan: Apatoto div.hash-search er porei campus posts boshbe.*/
        
          thisParent = $this.closest('.wrapper').find('div.hash-search');
        } else {
          thisParent = $this.closest("div.row").siblings('div#carousel-example');
        }      
      }

      /*!5-7-Ehsan*/
      
      var theRowOfPost = $("<div></div>", {
          class: "row post-display-section"
      }).insertAfter(thisParent);

      var thePostDisplay = $("<div></div>", {
          class: "post-display",
          "data-user": theReturned.user_id,
          id: theReturned.id
      }).appendTo(theRowOfPost);

      var theLg2Div = $("<div></div>", {
          class: "col-lg-3 col-md-3 col-sm-3 col-xs-3"
      }).appendTo(thePostDisplay);

      var lg2Img = $("<img>", {
          src: theReturned.img,
          class: "img-responsive img-rounded cm-img-pop user-img-post",
          "data-img_canvas_id": "cvs-"+theReturned.id,
          "data-toggle": "tooltip",
          "data-user": theReturned.user_id,
          "data-placement": "right",
          "data-html": "true",
          title: "<canvas id='cvs-"+theReturned.id+"' width='100' height='100'></canvas>"
      }).appendTo(theLg2Div);

      lg2Img.tooltip();
      //var theUserId = theReturned.user_id;
      lg2Img.on('shown.bs.tooltip', function(){
          getLkDlkRatio.call(this, $(this).attr("data-user")); //23-6-Ehsan
      });

      var theLg9Div = $('<div></div>', {
          class: "col-lg-8 col-md-8 col-sm-7 col-xs-7 post-text" //5-7-Ehsan 
      }).appendTo(thePostDisplay);

      /* Feeling and Time*/

      var postDetailsRow = $('<div></div>', {
          class: "row"
      }).appendTo(theLg9Div);

      if (theReturned.feeling === "None") {
          
          var pDtlsRowColXs12 = $('<div></div>', {
              class: "col-xs-12"
          }).appendTo(postDetailsRow);

          var pDtlsRowPostTimeP = $('<p></p>', {
              class: "post-info"
          }).appendTo(pDtlsRowColXs12);

          var pDtlsRowPostTimeA = $('<a></a>', {
              class: "post-info-link",
              href: baseUrl+"/singlepost/"+theReturned.id,
              target: "_blank"
          }).appendTo(pDtlsRowPostTimeP); //9-2-link

          $('<small></small>', {
              text: "Now"
          }).appendTo(pDtlsRowPostTimeA);

      } else if (theReturned.feeling !== "None") {


          var pDtlsRowColLg6_1 = $('<div></div>', {
              class: "col-lg-6 col-md-6 col-sm-6 col-xs-6"
          }).appendTo(postDetailsRow);

          var pDtlsRowPostTimeP = $('<p></p>', {
              class: "post-info"
          }).appendTo(pDtlsRowColLg6_1);

          var pDtlsRowPostTimeA = $('<a></a>', {
              class: "post-info-link",
              href: baseUrl+"/singlepost/"+theReturned.id,
              target: "_blank"
          }).appendTo(pDtlsRowPostTimeP); //9-2-link

          $('<small></small>', {
              text: "Now"
          }).appendTo(pDtlsRowPostTimeA);

          var pDtlsRowColLg6_2 = $('<div></div>', {
              class: "col-lg-6 col-md-6 col-sm-6 col-xs-6"
          }).appendTo(postDetailsRow);

          var pDtlsRowFeelP = $('<p></p>', {
              class: "post-info"
          }).appendTo(pDtlsRowColLg6_2);

          $('<small></small>', {
              text: "Feeing "+theReturned.feeling
          }).appendTo(pDtlsRowFeelP);

      }
      /* !!Feeling and Time*/
      //25-May
      var thePostInside = $('<p></p>', {
          text: ""
      }).appendTo(theLg9Div);

      thePostInside.html(theReturned.post);
      //!!25-May

      if (theReturned.vidsrc) {
            
        var videlem = $('<div></div>', { //9-2-Ehsan
          class: "row mc-no-margin-padding embed-responsive embed-responsive-16by9"
        }).appendTo(theLg9Div);

        videlem.html('<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'+theReturned.vidsrc+'" allowfullscreen></iframe>');
          
      }

      var lkDlkCmtDiv = $('<div></div>', {
          class: "row like-dislike-comment"
      }).appendTo(theLg9Div);

      var ldcLg4Div1 = $('<div></div>',{
          class: "col-lg-4 col-md-4 col-sm-4 col-xs-4"
      }).appendTo(lkDlkCmtDiv);

      /*$('<span></span>', {
          class: "pull-right count",
          text: "0"
      }).appendTo(ldcLg4Div1);*/ /*17-11-Ehsan*/

      var lkSpan = $('<span></span>', {
              class: "glyphicon glyphicon-thumbs-up like-img",
              "data-liked": "0",
              "data-liketype": "post"
      }).appendTo(ldcLg4Div1);

      var ldcLg4Div2 = $('<div></div>',{
          class: "col-lg-4 col-md-4 col-sm-4 col-xs-4"
      }).appendTo(lkDlkCmtDiv);

      /*$('<span></span>', {
          class: "pull-right count",
          text: "0"
      }).appendTo(ldcLg4Div2);*/ /*17-11-Ehsan*/

      var dlkSpan = $('<span></span>', {
              class: "glyphicon glyphicon-thumbs-down dislike-img",
              "data-liked": "2",
              "data-liketype": "post"
      }).appendTo(ldcLg4Div2);

      var ldcLg4Div3 = $('<div></div>',{
          class: "col-lg-4 col-md-4 col-sm-4 col-xs-4"
      }).appendTo(lkDlkCmtDiv);

      /*$('<span></span>', {
          class: "pull-right count comment-count",
          text: "0"
      }).appendTo(ldcLg4Div3);*/ /*17-11-Ehsan*/

      var commenterSpan = $('<span></span>', {
          class: "glyphicon glyphicon-comment comment-img cm-commenter",
          "data-reqsource": "commenter"
      }).appendTo(ldcLg4Div3);

      /*START--17-11-Ehsan*/

      var ulLkDlkCmtCount = $('<ul></ul>', {
          class: "list-inline ul-like-dislike-comment-count"
      }).appendTo(theLg9Div);

      var likeCountLi = $('<li></li>').appendTo(ulLkDlkCmtCount);
      
      var likeCountLiSmall = $('<small></small>', {
          text: "Likes: "
      }).appendTo(likeCountLi);

      $('<span></span>', {
          class: "pull-right count",
          text: "0"
      }).appendTo(likeCountLiSmall);

      var dislikeCountLi = $('<li></li>').appendTo(ulLkDlkCmtCount);
      
      var dislikeCountLiSmall = $('<small></small>', {
          text: "Dislikes: "
      }).appendTo(dislikeCountLi);

      $('<span></span>', {
          class: "pull-right count",
          text: "0"
      }).appendTo(dislikeCountLiSmall);

      var commentCountLi = $('<li></li>').appendTo(ulLkDlkCmtCount);
      
      var commentCountLiSmall = $('<small></small>', {
          text: "Comments: "
      }).appendTo(commentCountLi);

      $('<span></span>', {
          class: "pull-right count comment-count",
          text: "0"
      }).appendTo(commentCountLiSmall); 

      /*END--17-11-Ehsan*/

      $('<div></div>', {
          class: "row cm-comments",
          "data-state": "unavailable"
      }).appendTo(theLg9Div);

      var theLg1Div = $('<div></div>', {
          class: "col-lg-1 col-md-1 col-sm-2 col-xs-2" //5-7-Ehsan
      }).appendTo(thePostDisplay);

      //24-May
      var rowOfBtnGrp = $('<div></div>', {
          class: "row"
      }).appendTo(theLg1Div);

      var btnGrpDiv = $('<div></div>', {
          class: "btn-group pull-right"
      }).appendTo(rowOfBtnGrp);
      //!!!!24-May

      var btn1OfBtnGrp = $('<button></button>', {
          type: "button",
          class: "btn btn-primary dropdown-toggle post-options",
          "data-toggle": "dropdown",
          "aria-expanded": "false"
      }).appendTo(btnGrpDiv);

      $('<span></span>', {
          class: "caret"
      }).appendTo(btn1OfBtnGrp);

      var caretUl = $('<ul></ul>', {
          class: "dropdown-menu option-class",
          role: "menu"
      }).appendTo(btnGrpDiv);

      var li1CaretUl = $('<li></li>', {
          class: "delete-li",
          "data-deltype": "0"
      }).appendTo(caretUl);

      $('<a></a>', {
        href: "#",
        text: "Delete",
        "aria-hidden": "true",
        "data-toggle": "modal",
        "data-target": "#deleteModal"
      }).appendTo(li1CaretUl);

      li1CaretUl.on('click', function(){
          deleteLiClickAssign.call(this);
      });    

      //28-May
      if(theReturned.type >= 1) { /*5-7-Ehsan*/
          var rowFbShare = $('<div></div>', {
              class: "row pull-right div-fb-share"
          }).appendTo(theLg1Div);

          var theFbShareButton = $('<img>', {
              class: "fbBtnShare",
              "data-href": baseUrl+"/singlepost/"+theReturned.id, 
              src: baseUrl+"/img/facebook_sh2.png"
          }).appendTo(rowFbShare);

          $('<div></div>', { /*5-7-Ehsan*/
              class: "custom-fb-share-count",
              text: "0"
          }).appendTo(rowFbShare);
    
          theFbShareButton.on('click', function(){
              callFBShareDialog.call(this);
          });
          
          theRowOfPost.ready( function(){      
                autoScrapeOGobject.call(this);
          });
      }
      //!!!!28-May

      setLikeDislikeEvents.call(lkDlkCmtDiv);

      commenterSpan.on('click', function(){
          setUpTheCommenterEvent.call(this);
      });

      commenterSpan.trigger('click'); /*28-May*/
      /*Eve-26-May-Ehsan*/
      if (!($this.closest('.post-area').attr('data-tagflag') == "1")) {


          if (parseInt($this.closest('.post-area').attr('data-posttype')) >= 1) { //23-6-Ehsan
              theRowOfPost.find('.tags').on('click', function(e){ //25-May
              	  e.preventDefault(); /*Eve-28-May*/
                  getTagResultsByClick.call(this);
              });
          }

      }
      /*!!!Eve-26-May-Ehsan*/
      $this.trigger('newPostLoaded');

  }

  //!Loading a newly created post.

  //************************************************Animating a newly created post.
  //**********************************************************************************
  //**********************************************************************************
  function animateNewPost() {
      var $this = this,
          theEntireRow = $this.closest("div.row").next();//The new row for the new post.
      
      theEntireRow.css({
        "opacity": "0.3"
      });
      
      theEntireRow.animate({
        "opacity": "1"
      }, 1000);

      $this.off('newPostLoaded');

  }
  //!Animating a newly created post.

  //*************************************************************Creating a new post.
  //**********************************************************************************
  //**********************************************************************************
  $("div.post-area").find("button.post-it").on('click', function(){ /*5-7-Ehsan*/
      createNewPost.call(this);
  });

  function createNewPost() {
      var $this = $(this);
      $this.off('click');/*27-May-Ehsan*/
      
      var theTextarea = $this.parent().siblings("textarea"),
          theFeel = $this.prev().find("button").attr('data-feelid'),
          thePosttype = $this.closest('.post-area').attr('data-posttype'),
          ajUrl = "createpost",
          ajRes = null,
          hideName = null, /*16-11-Ehsan*/
          selfUserID = $this.closest('body').attr('data-user'), /*27-May-Ehsan*/
          baseUrl = $this.closest('body').attr('data-baseurl'); /*27-May-Ehsan*/

      /*START--16-11-Ehsan*/
      if ($this.siblings('div.checkbox').find('input').is(':checked')) hideName = 1;
      console.log('createNewPost:: hideName = '+hideName);
      /*END--16-11-Ehsan*/

      if (!theFeel) {
          theFeel = 1;
      }

      if (theTextarea[0].value) { 
          $this.html('Posting...'); /*Eve-28-May*/    
          var ajRes = $.ajax({
              url: baseUrl+"/"+ajUrl, /*27-May-Ehsan*/
              type: "POST",
              dataType: "json",
              data: {
                post: theTextarea[0].value,
                feel: theFeel,
                type: thePosttype,
                hideName: hideName /*16-11-Ehsan*/
              }
          }).promise();

          ajRes.done(function( theReturned ){
              if (theReturned) {  /*27-May-Ehsan*/
                $this.on('newPostLoaded', function(){
                    animateNewPost.call($this);
                    $this.on('click', function(){
                        createNewPost.call(this);
                    });/*27-May-Ehsan*/
                    $this.html('Post');/*Eve-28-May*/
                });
                loadTheNewPost.call($this, theReturned);
                theTextarea[0].value = "";
              } /*27-May-Ehsan*/
          });

          ajRes.fail(function(theReturned){
            console.log("ajRes.fail for createNewPost: ");
            console.log(theReturned);
            $this.on('click', function(){
                      createNewPost.call(this);
                  });/*27-May-Ehsan*/
            $this.html('Post');/*Eve-28-May*/
          });        

      } else {
        $this.on('click', function(){
                      createNewPost.call(this);
                  });/*27-May-Ehsan*/
        
      }
      /*console.log(theTextarea[0].value);
      console.log(typeof(theFeelText));*/
  }

  //!Creating a new post.

  //**************************************************Loading a newly created comment.
  //**********************************************************************************
  //**********************************************************************************
  function loadTheNewComment( theReturned ) {
      var $this = this;

      var cmCommentDiv = $('<div></div>', {
              class: "col-lg-12 col-md-12 col-sm-12 col-xs-12 cm-comment",
              id: theReturned.post_id+"-"+theReturned.id
          }).insertBefore($this.parent());
      
      var theUserImg = $('<img>', {
              src: theReturned.img,
              class: "cm-thumbnail img-responsive img-rounded cm-img-pop user-img-comment", //5-7-Ehsan
              "data-img_canvas_id": "cvs-"+theReturned.post_id+"-"+theReturned.id,
              "data-toggle": "tooltip",
              "data-user": theReturned.user, /*27-May-Ehsan*/
              "data-placement": "right",
              "data-html": "true",
              title: "<canvas id='cvs-"+theReturned.post_id+"-"+theReturned.id+"' width='100' height='100'></canvas>"
      }).prependTo(cmCommentDiv);

      theUserImg.tooltip();
      //var theUserId = theReturned.user; 
      theUserImg.on('shown.bs.tooltip', function(){
          getLkDlkRatio.call(this, $(this).attr("data-user")); /*23-6-Ehsan*/
      });

      var caretDropDiv = $('<div></div>', {
          class: "btn-group pull-right comment-option"
      }).appendTo(cmCommentDiv);

      var caretBtn = $('<button></button>', {
          type: "button",
          class: "btn btn-primary dropdown-toggle post-options",
          "data-toggle": "dropdown",
          "aria-expanded": "false"
      }).appendTo(caretDropDiv);

      $('<span></span>', {
          class: "caret"
      }).appendTo(caretBtn);

      //Create the <ul>
      var caretUl = $('<ul></ul>', {
          class: "dropdown-menu active option-class",
          role: "menu"
      }).appendTo(caretDropDiv);

      var li1CaretUl = $('<li></li>', {
          class: "delete-li",
          "data-deltype": "1"
      }).appendTo(caretUl);

      $('<a></a>', {
        href: "#",
        text: "Delete",
        "aria-hidden": "true",
        "data-toggle": "modal",
        "data-target": "#deleteModal"
      }).appendTo(li1CaretUl);

      //Created the <ul>

      //25-May
      var thePostInside = $('<p></p>', {
          text: ""
      }).appendTo(cmCommentDiv);

      thePostInside.html(theReturned.comment);
      //!!25-May

      var timeP = $('<p></p>', {
          class: "post-info pull-left comment-time"
      }).appendTo(cmCommentDiv);

      $('<small></small>', {
          text: "Now"
      }).appendTo(timeP);

      var lkDlkCmtDiv = $('<div></div>', {
              class: "row like-dislike-comment like-dislike-for-comment" //5-7-Ehsan
          }).appendTo(cmCommentDiv);

      var lkImgDiv = $('<div></div>', {
              class: "col-lg-6 col-md-6 col-sm-6 col-xs-6",
          }).appendTo(lkDlkCmtDiv);

      /*$('<span></span>', {
              class: "pull-right count",
              text: "0"
      }).appendTo(lkImgDiv);*/ /*17-11-Ehsan*/

      var lkSpan = $('<span></span>', {
              class: "glyphicon glyphicon-thumbs-up like-img",
              "data-liked": "0",
              "data-liketype": "comment"
      }).appendTo(lkImgDiv);

      var dlkImgDiv = $('<div></div>', {
              class: "col-lg-6 col-md-6 col-sm-6 col-xs-6",
      }).appendTo(lkDlkCmtDiv);

      /*$('<span></span>', {
              class: "pull-right count",
              text: "0"
      }).appendTo(dlkImgDiv);*/ /*17-11-Ehsan*/

      var dlkSpan = $('<span></span>', {
              class: "glyphicon glyphicon-thumbs-down dislike-img",
              "data-liked": "2",
              "data-liketype": "comment"
      }).appendTo(dlkImgDiv);

      /*START--17-11-Ehsan*/

      var ulLkDlkCmtCount = $('<ul></ul>', {
          class: "list-inline ul-like-dislike-comment-count"
      }).appendTo(cmCommentDiv);

      var likeCountLi = $('<li></li>').appendTo(ulLkDlkCmtCount);
      
      var likeCountLiSmall = $('<small></small>', {
          text: "Likes: "
      }).appendTo(likeCountLi);

      $('<span></span>', {
          class: "pull-right count",
          text: "0"
      }).appendTo(likeCountLiSmall);

      var dislikeCountLi = $('<li></li>').appendTo(ulLkDlkCmtCount);
      
      var dislikeCountLiSmall = $('<small></small>', {
          text: "Dislikes: "
      }).appendTo(dislikeCountLi);

      $('<span></span>', {
          class: "pull-right count",
          text: "0"
      }).appendTo(dislikeCountLiSmall);

      /*END--17-11-Ehsan*/

      setLikeDislikeEvents.call(lkDlkCmtDiv);

      li1CaretUl.on('click', function(){
          deleteLiClickAssign.call(this);
      });

      $this.trigger('newCommentLoaded');
  }
  //!Loading a newly created comment.

  //************************************************Animating a newly created comment.
  //**********************************************************************************
  //**********************************************************************************
  function animateNewComment() {
      $this = this; //The new cm-comment.
      $this.css({
        "opacity": "0.3"
      });
      $this.animate({
        "opacity": "1"
      }, 1000);
  }
  //!Animating a newly created comment.

  //*************************************************************Creating a new comment.
  //**********************************************************************************
  //**********************************************************************************

  function createNewComment() {
      var $this = $(this);
      $this.off('click');/*27-May-Ehsan*/
      
      var theTextarea = $this.siblings("textarea"),
          thePostID = $this.closest(".post-display").attr("id"),
          ajUrl = "createcomment/"+thePostID,
          baseUrl = $this.closest('body').attr('data-baseurl'); /*27-May-Ehsan*/

      if (theTextarea[0].value) {
          //console.log(theTextarea[0].value);
          $this.html('Posting...');/*Eve-28-May*/
          var ajRes = $.ajax({
              url: baseUrl+"/"+ajUrl, /*27-May-Ehsan*/
              type: "POST",
              dataType: "json",
              data: {comment: theTextarea[0].value}
          }).promise();

          ajRes.done(function( theReturned ){
              if (theReturned != "false") { /*27-May-Ehsan*/
                $this.on('newCommentLoaded', function(){
                    animateNewComment.call($this.parent().prev()); //Sending the new cm-comment.
                    
                    var comCountSpan = $(this).closest(".cm-comments").prev(".ul-like-dislike-comment-count").find("span.comment-count"), /*17-11-Ehsan*/
                        comCountVal = parseInt(comCountSpan.html());
                    
                    comCountSpan.html(++comCountVal);
                    //console.log(comCountVal);
                    $this.off('newCommentLoaded');
                    $this.on('click', function(){
                      createNewComment.call(this);
                    });/*27-May-Ehsan*/
                    $this.html('Post');/*Eve-28-May*/
                });
                loadTheNewComment.call($this, theReturned);
                theTextarea[0].value = "";
              } /*27-May-Ehsan*/
          });

          ajRes.fail(function(theReturned){
            console.log("ajRes.fail for createNewComment: ");
            console.log(theReturned);
            $this.on('click', function(){
              createNewComment.call(this);
            });/*27-May-Ehsan*/
            $this.html('Post');/*Eve-28-May*/
          });

      } else {
        $this.on('click', function(){
          createNewComment.call(this);
        });/*27-May-Ehsan*/
        
      }

  }

  //!Creating a new comment.

  //*************************************************************Loading the comments.
  //**********************************************************************************
  //**********************************************************************************
  
  var commenters = $('div.like-dislike-comment .cm-commenter');
      /*theHtmlBody = $('html, body');*/

  function loadThemComments( theReturned ) {
      var $this = this,
          divToThrowBefore = null,  //17-6-Ehsan
          divToThrowAfter = "", //17-6-Ehsan
          cmCommentsDiv = "",
          comCount = 0,
          comCountLimit = 0,
          selfUserID = $('body').attr('data-user'), //27-May-Ehsan
          ownerPostID = $this.closest('.post-display').attr('id'),
          reqSource = $this.attr('data-reqsource');

          //console.log(theReturned);
          //console.log(ownerPostID);
          //console.log(reqSource);
      if (reqSource === "viewmore") {
          divToThrowAfter = $this.parent().parent();
      } else if (reqSource === "commenter") {
          cmCommentsDiv = $this.parent().parent().siblings(".cm-comments");//16-11-EhsanTBC

          /*START17-6-Ehsan*/
          if (theReturned['length'] > 3) {
              var cmCommentViewMore = $('<div></div>', {
                  class: "col-lg-12 col-md-12 col-sm-12 col-xs-12 cm-comment"
              }).appendTo(cmCommentsDiv);

              var divBtnViewMore = $('<div></div>', {
                  class: "btn-view-more"
              }).appendTo(cmCommentViewMore);

              var btnViewMore = $('<div></div>', {
                  class: "view-more-comments",
                  "data-lastcomment": "3", /*5-7-Ehsan*/
                  "data-reqsource": "viewmore",
                  text: "View more"
              }).appendTo(divBtnViewMore);

              btnViewMore.on('click', function(){
                  viewMoreComments.call(this);
              });
          }
          /*END17-6-Ehsan*/
      }

      comCountLimit = (theReturned['length'] > 3)?3:theReturned['length'];
      
          //console.log(comCountLimit);
          //console.log(theReturned['comments'][comCount].comment);

      for(comCount = 0; comCount < comCountLimit; comCount++ ) {

          var cmCommentDiv = null;

          if (reqSource === "viewmore") {
              
              cmCommentDiv = $('<div></div>', {
                  class: "col-lg-12 col-md-12 col-sm-12 col-xs-12 cm-comment",
                  id: ownerPostID+"-"+theReturned['comments'][comCount].id
              }).insertAfter(divToThrowAfter); //17-6-Ehsan

              //******START****5-7-Ehsan
              if (theReturned['length'] <= 3) {
                if (comCount+1 == comCountLimit) { //5-7-Ehsan
                  cmCommentDiv.addClass("cm-com-view-last");
                }
              } 
              //******END****5-7-Ehsan

          } else if (reqSource === "commenter") {

            /*START17-6-Ehsan*/
            if (comCount == 0) {
              cmCommentDiv = $('<div></div>', {
                  class: "col-lg-12 col-md-12 col-sm-12 col-xs-12 cm-comment",
                  id: ownerPostID+"-"+theReturned['comments'][comCount].id
              }).appendTo(cmCommentsDiv);

              divToThrowBefore = cmCommentDiv;

            } else {
              cmCommentDiv = $('<div></div>', {
                  class: "col-lg-12 col-md-12 col-sm-12 col-xs-12 cm-comment",
                  id: ownerPostID+"-"+theReturned['comments'][comCount].id
              }).insertBefore(divToThrowBefore);

              divToThrowBefore = cmCommentDiv;

            }
            /*END17-6-Ehsan*/ 
          }

          var theUserImg = $('<img>', {
              src: theReturned['comments'][comCount].img,
              class: "cm-thumbnail img-responsive img-rounded cm-img-pop user-img-comment", //5-7-Ehsan
              "data-img_canvas_id": "cvs-"+ownerPostID+"-"+theReturned['comments'][comCount].id,
              "data-toggle": "tooltip",
              "data-user": theReturned['comments'][comCount].user,
              "data-placement": "right",
              "data-html": "true",
              title: "<canvas id='cvs-"+ownerPostID+"-"+theReturned['comments'][comCount].id+"' width='100' height='100'></canvas>"
          }).prependTo(cmCommentDiv);
          
          theUserImg.tooltip();
          //var theUserId = theReturned['comments'][comCount].user; 
          theUserImg.on('shown.bs.tooltip', function(){
              getLkDlkRatio.call(this, $(this).attr("data-user")); //23-6-Ehsan
          });

          var caretDropDiv = $('<div></div>', {
              class: "btn-group pull-right comment-option"
          }).appendTo(cmCommentDiv);

          var caretBtn = $('<button></button>', {
              type: "button",
              class: "btn btn-primary dropdown-toggle post-options",
              "data-toggle": "dropdown",
              "aria-expanded": "false"
          }).appendTo(caretDropDiv);

          $('<span></span>', {
              class: "caret"
          }).appendTo(caretBtn);

          //Create the <ul>
          var caretUl = $('<ul></ul>', {
              class: "dropdown-menu active option-class",
              role: "menu"
          }).appendTo(caretDropDiv);

          var li1CaretUl = "",
              li2CaretUl = "";

          if (theReturned['comments'][comCount].user == selfUserID) {
              li1CaretUl = $('<li></li>', {
                  class: "delete-li",
                  "data-deltype": "1"
              }).appendTo(caretUl);

              $('<a></a>', {
                href: "#",
                text: "Delete",
                "aria-hidden": "true",
                "data-toggle": "modal",
                "data-target": "#deleteModal"
              }).appendTo(li1CaretUl);

          } else {
              li2CaretUl = $('<li></li>', {
                  class: "req-delelte-li",
                  "data-deltype": "1"
              }).appendTo(caretUl);

              $('<a></a>', {
                href: "#",
                text: "Request to delete",
                "aria-hidden": "true",
                "data-toggle": "modal",
                "data-target": "#reqDeleteModal"
              }).appendTo(li2CaretUl);
          }
          //Created the <ul>

          //START17-6-Ehsan
          var thePostInside = $('<p></p>', {
              text: ""
          }).appendTo(cmCommentDiv);

          //thePostInside.html(theReturned['comments'][comCount].comment);
          if (theReturned['comments'][comCount].comment.length > 300) {

            var strBrkOff = (theReturned['comments'][comCount].comment.substr(299)).indexOf(" ");
            var strBrkOffNl = (theReturned['comments'][comCount].comment.substr(299)).indexOf("\n");
            if ((strBrkOff != -1)&&(strBrkOffNl != -1)) {
              if ((theReturned['comments'][comCount].comment.substr(299+strBrkOff+1, 1)).match(/\//)) {
                strBrkOff = strBrkOffNl;
              }
            
              strBrkOff = (strBrkOffNl < strBrkOff)?strBrkOffNl:strBrkOff;
            }
            if (strBrkOff == -1) {
              thePostInside.html(theReturned['comments'][comCount].comment);  
            } else {
            
              thePostInside.html(theReturned['comments'][comCount].comment.substr(0, 300+strBrkOff)+"<a href='#' class='btnSeemore'>...See more</a><span class='hiddenpostpart'>"+theReturned['comments'][comCount].comment.substr(300+strBrkOff)+"</span>");  
               
              thePostInside.find('.btnSeemore').on('click', function(e){
                  e.preventDefault();
                  showRestOfPost.call(this);
              });

            }
          } else {
            thePostInside.html(theReturned['comments'][comCount].comment);
          }
          //END17-6-Ehsan

          var timeP = $('<p></p>', {
              class: "post-info pull-left comment-time"
          }).appendTo(cmCommentDiv);

          $('<small></small>', {
              text: theReturned['comments'][comCount].ago
          }).appendTo(timeP);
          
          //like-dislike-comment
          var lkDlkCmtDiv = $('<div></div>', {
              class: "row like-dislike-comment like-dislike-for-comment" //5-7-Ehsan
          }).appendTo(cmCommentDiv);

          var lkImgDiv = $('<div></div>', {
              class: "col-lg-6 col-md-6 col-sm-6 col-xs-6"
          }).appendTo(lkDlkCmtDiv);

          /*$('<span></span>', {
              class: "pull-right count",
              text: theReturned['comments'][comCount].like
          }).appendTo(lkImgDiv);*/ /*17-11-Ehsan*/

          var lkSpan = $('<span></span>', {
                  class: "glyphicon glyphicon-thumbs-up like-img",
                  "data-liked": "0",
                  "data-liketype": "comment"
          }).appendTo(lkImgDiv);

          if(theReturned['comments'][comCount].liked) {
              lkSpan.addClass('liked');
              lkSpan.attr("data-liked", "1");
          }

          var dlkImgDiv = $('<div></div>', {
              class: "col-lg-6 col-md-6 col-sm-6 col-xs-6"
          }).appendTo(lkDlkCmtDiv);

          /*$('<span></span>', {
              class: "pull-right count",
              text: theReturned['comments'][comCount].dislike
          }).appendTo(dlkImgDiv);*/ /*17-11-Ehsan*/

          var dlkSpan = $('<span></span>', {
                  class: "glyphicon glyphicon-thumbs-down dislike-img",
                  "data-liked": "2",
                  "data-liketype": "comment"
          }).appendTo(dlkImgDiv);

          if(theReturned['comments'][comCount].disliked) {
              dlkSpan.addClass('disliked');
              dlkSpan.attr("data-liked", "3");
          }
          //!!!like-dislike-comment

          /*START--17-11-Ehsan*/

          var ulLkDlkCmtCount = $('<ul></ul>', {
              class: "list-inline ul-like-dislike-comment-count"
          }).appendTo(cmCommentDiv);

          var likeCountLi = $('<li></li>').appendTo(ulLkDlkCmtCount);
          
          var likeCountLiSmall = $('<small></small>', {
              text: "Likes: "
          }).appendTo(likeCountLi);

          $('<span></span>', {
              class: "pull-right count",
              text: theReturned['comments'][comCount].like
          }).appendTo(likeCountLiSmall);

          var dislikeCountLi = $('<li></li>').appendTo(ulLkDlkCmtCount);
          
          var dislikeCountLiSmall = $('<small></small>', {
              text: "Dislikes: "
          }).appendTo(dislikeCountLi);

          $('<span></span>', {
              class: "pull-right count",
              text: theReturned['comments'][comCount].dislike
          }).appendTo(dislikeCountLiSmall);

          /*END--17-11-Ehsan*/

          setLikeDislikeEvents.call(lkDlkCmtDiv);

          if (theReturned['comments'][comCount].user == selfUserID) {
              li1CaretUl.on('click', function(){
                  deleteLiClickAssign.call(this);
              });
          } else {
              li2CaretUl.on('click', function(){
                  reqDeleteLiClickAssign.call(this);
              });
          }

          cmCommentDiv.css({
            "opacity": "0.3"
          });
          cmCommentDiv.animate({
            "opacity": "1"
          }, 1000);

      } //End of the for loop.

      if (reqSource === "viewmore") {
          if (theReturned['length'] <= 3) { //5-7-Ehsan
              //$this.attr('data-lastcomment', parseInt($this.attr('data-lastcomment'))+3); /*5-7-Ehsan*/
              divToThrowAfter.hide();
          }
          $this.trigger('moreCommentsLoaded');//27-May-Ehsan
      } else if (reqSource === "commenter") {
          /*START17-6-Ehsan*/
          /*if (theReturned['length'] > 3) {
              var cmCommentViewMore = $('<div></div>', {
                  class: "col-lg-12 col-md-12 col-sm-12 col-xs-12 cm-comment"
              }).appendTo(cmCommentsDiv);

              var divBtnViewMore = $('<div></div>', {
                  class: "btn-view-more"
              }).appendTo(cmCommentViewMore);

              var btnViewMore = $('<div></div>', {
                  class: "view-more-comments",
                  "data-lastcomment": theReturned['comments'][2].id,
                  "data-reqsource": "viewmore",
                  text: "View more"
              }).appendTo(divBtnViewMore);

              btnViewMore.on('click', function(){
                  viewMoreComments.call(this);
              });
          }*/
          /*END17-6-Ehsan*/
          if (selfUserID) {
            var cmCommentDiv = $('<div></div>', {
                class: "col-lg-12 col-md-12 col-sm-12 col-xs-12 cm-comment comment-field"
            }).appendTo(cmCommentsDiv);
  
            $('<textarea></textarea>', {
                rows: "2", /*16-11-Ehsan*/
                cols: "40",
                placeholder: "Leave A Comment", /*5-7-Ehsan*/
                maxlength: "1000", /*27-May-Ehsan*/
                class: "form-control"
            }).appendTo(cmCommentDiv);
  
            var postBtn = $('<button></button>', {
                type: "button",
                class: "col-sm-2 col-xs-4 btn btn-primary btn-modified button-class pull-right", /*16-11-Ehsan*/
                text: "Post"
            }).appendTo(cmCommentDiv);
  
            /*var comScrollButton = $('<button></button>', {
                type: "button",
                class: "col-sm-2 col-xs-4 btn btn-primary btn-scroll-up pull-right cm-scroll-top"
            }).appendTo(cmCommentDiv);
  
            $('<span></span>', {
                class: "glyphicon glyphicon-circle-arrow-up"
            }).appendTo(comScrollButton);
  
            comScrollButton.on('click', function(){
              theHtmlBody.animate({
                    scrollTop: $(this).parent().parent().parent().parent().children(':first-child')[0].offsetTop
              });
            });*/ //27-May-Ehsan
  
            postBtn.on('click', function(){
              createNewComment.call(this); //****************************************Call to createNewComment        
            });
          }
          

          $(cmCommentsDiv).trigger('commentsLoadedAsHidden');

      } //if reqSource === commenter
      //console.log("we are here!");

  } //!loadThemComments

  function showThemComments() {
      var $this = this,
          cm_comments = $this.parent().parent().siblings('div.cm-comments'); /*17-11-Ehsan*/
          /*comment_in = cm_comments.children().last();*/
          /*availability = cm_comments.attr("data-state");*/
      //console.log(scrollToTop);      
      //console.log(comment_in.offset().top);
      //console.log(comment_in[0].offsetTop);
      cm_comments.slideToggle();
      //console.log(availability);
      /*if (availability === "unavailable") {
        cm_comments.attr("data-state", "available");
        theHtmlBody.animate({
            scrollTop: comment_in.offset().top
        }, 1000);
      } else {
        cm_comments.attr("data-state", "unavailable");
      }*/

  } //!showThemComments

  function setUpTheCommenterEvent() {
      var $this = $(this),
          theBaseTime = $('body').attr('data-basetime'); //5-7-Ehsan;
      $this.off('click');/*27-May-Ehsan*/
      var theCmComments = $this.parent().parent().siblings('div.cm-comments'), //16-11-EhsanTBC
          commentsContent = theCmComments.children(),
          thePostID = $this.closest(".post-display").attr("id"),
          ajUrl = "getcomments/"+thePostID,
          baseUrl = $this.closest('body').attr('data-baseurl'); /*27-May-Ehsan*/

      //console.log("Entered");
      if(!commentsContent.length) {
          var ajRes = $.ajax({
              url: baseUrl+"/"+ajUrl, /*27-May-Ehsan*/
              dataType: "json",
              data: { /*5-7-Ehsan*/
                off: "0",
                time: theBaseTime //5-7-basetime
              }
          }).promise();
          
          ajRes.done(function( theReturned ){
              
              theCmComments.on('commentsLoadedAsHidden', function(){
                  
                  theCmComments.off('commentsLoadedAsHidden');
                  $this.on('click', function(){
                    setUpTheCommenterEvent.call(this);
                  });/*27-May-Ehsan*/

                  if ($this.closest('div.section-02').attr('data-singlepage')) {
                    showThemComments.call($this);
                  } /*28-May-Ehsan*/
      
                  console.log("Comments preloaded for: "+thePostID); /*28-May*/
              });
              loadThemComments.call($this, theReturned);
              //console.log(theReturned);        
              
          });

          ajRes.fail(function( theReturned ){
              console.log("ajRes.fail for setUpTheCommenterEvent: ");
              console.log(theReturned);
              $this.on('click', function(){
                setUpTheCommenterEvent.call(this);
              });/*27-May-Ehsan*/
          });
          
      } else {
          showThemComments.call($this);
          $this.on('click', function(){
            setUpTheCommenterEvent.call(this);
          });/*27-May-Ehsan*/
      }
  }

  commenters.on('click', function(){

      setUpTheCommenterEvent.call(this);

  });

  commenters.trigger('click'); /*28-May*/
  
  
  //!Loading the comments.
  
  //************************************************************Initializing tooltips.
  //**********************************************************************************
  //**********************************************************************************

  function getLkDlkRatio(theUserId) {
      var $this = $(this),
          baseUrl = $this.closest('body').attr('data-baseurl'), /*27-May-Ehsan*/
          ajUrl = "getuserldratio/"+theUserId; 
      //console.log(ajUrl);
      var ajRes = $.ajax({
          url: baseUrl+"/"+ajUrl, /*27-May-Ehsan*/
          dataType: "json"
      }).promise();

      ajRes.done( function( theReturned ) {
        //console.log(theReturned.like);
        var data = [
                {
                  value: parseFloat(theReturned.like),
                  color:"#5cb85c",
                  highlight: "#6bc36b",
                  label: "Like"
                },
                {
                  value: parseFloat(theReturned.dislike),
                  color: "#d9534f",
                  highlight: "#e25e5a",
                  label: "Dislike"
                }
              ];
    
        var canvas_id = $this.attr('data-img_canvas_id'),
            ctx_ = document.getElementById(canvas_id).getContext("2d"),
            myNewChart_ = new Chart(ctx_).Pie(data);
          
      });

      ajRes.fail(function( theReturned ){
         console.log("ajRes.fail for getLkDlkRatio: ");
         console.log(theReturned);
      });
  } //getLkDlkRatio

  $('img.cm-img-pop').on('shown.bs.tooltip', function(){
    
    getLkDlkRatio.call(this, $(this).attr("data-user"));
    
  
  });

  $('[data-toggle="tooltip"]').tooltip();

  /* !E */

  //*************************************************************Follow button script.
  //**********************************************************************************
  //**********************************************************************************

  $.fn.followFunc = function() {

      var $this = this,
          baseUrl = $this.closest('body').attr('data-baseurl'); /*27-May-Ehsan*/

      var ajRes = $.ajax({
          url: baseUrl+"/"+"follow",  /*27-May-Ehsan*/
          data: {
            following_id: $this.closest('div.post-display').attr('data-user')
          }
      }).promise();

      ajRes.done( function( theReturned ) {
        //console.log(theReturned.match(/true/));
        if (theReturned.match(/true/)) {
            
            $this.trigger('donefollow');
            //console.log('neverfo');
            return $this;
        }
        
      });

      ajRes.fail(function( theReturned ){
         console.log(theReturned);
      });

      return null;

  }

  $.fn.unfollowFunc = function() {

      var $this = this,
          baseUrl = $this.closest('body').attr('data-baseurl'); /*27-May-Ehsan*/
      var ajRes = $.ajax({
          url: baseUrl+"/"+"unfollow",  /*27-May-Ehsan*/
          data: {
            following_id: $this.closest('div.post-display').attr('data-user')
          }
      }).promise();

      ajRes.done( function( theReturned ) {
        
        if (theReturned.match(/true/)) {
            
            $this.trigger('doneunfollow');
            
            return $this;
        }
        //console.log("not true!");
      });

      ajRes.fail(function( theReturned ){
         console.log(theReturned);
      });

      return null;
    
  }
  /*27-May-Ehsan*/
  function btnFollowFunctionality() {
      var $this = $(this);
      $this.off('click');
      if ($this.html()==="Follow"){

         
         $this.on('donefollow', function(){
            $this.text("Followed");
            $this.addClass("followed");
            $this.off('donefollow');
            $this.on('click', function(){
              btnFollowFunctionality.call(this);              
            });
            followTheRest($this.closest('div.post-display').attr('data-user')); //17-6-Ehsan
         });
         $this.followFunc();

      } else {

        $this.on('doneunfollow', function(){
            $this.text("Follow");
            $this.removeClass("followed");
            $this.off('doneunfollow');
            $this.on('click', function(){
              btnFollowFunctionality.call(this);              
            });
            unfollowTheRest($this.closest('div.post-display').attr('data-user')); //17-6-Ehsan
        });
        $this.unfollowFunc();

      }
  }
  
  /*Eve-26-May-Ehsan*/
  function btnUnfollowFunctionality() {
      var $this = $(this);

      if($this.html()==="Unfollow"){
        
        $this.unfollowFunc();
        $this.on('doneunfollow', function(){
          $this.text("Follow");
          $this.addClass("btn-success");
          $this.removeClass("btn-danger");
          $this.off('doneunfollow');
        });

      } else {

        $this.followFunc();
        $this.on('donefollow', function(){
          $this.text("Unfollow");
          $this.addClass("btn-danger");
          $this.removeClass("btn-success");
          $this.off('donefollow');
        });

      }
  }

  function followTheRest(idToFollow) { //17-6-Ehsan
      var followBtns = $('div.section-02 div.post-display[data-user='+idToFollow+'] button.btn-follow');
      followBtns.each(function(){
          var $this = $(this);
          if ($this.html()==="Follow"){
            $this.text("Followed");
            $this.addClass("followed");
          }
      });
  }

  function unfollowTheRest(idToFollow) { //17-6-Ehsan
      var followBtns = $('div.section-02 div.post-display[data-user='+idToFollow+'] button.btn-follow');
      followBtns.each(function(){
          var $this = $(this);
          if ($this.html()==="Followed"){
            $this.text("Follow");
            $this.removeClass("followed");
          }
      });
  }

  $(".btn-follow").on("click",function(){

      btnFollowFunctionality.call(this);
      
  });

  $(".btn-unfollow").on("click",function(){

      btnUnfollowFunctionality.call(this);
      
  });


  //*******************************************************************Update Feeling.
  //**********************************************************************************
  //**********************************************************************************
  /*********START**********5-7-Ehsan*/
  $('div.feeling-div').each(function(){

    var $this = $(this),
        feelingButton = $this.children('button'),
        feelingOpsL = $this.children('ul').children('li');

    feelingOpsL.on('click', function(e){
      e.preventDefault();
      var $this = $(this),
          optionID = $this.attr('data-feelid'),
          optionText = $this.children('a').html();

      if (optionID == "1") {
        feelingButton.html('Feeling  <span class="caret"></span>');
      } else {
        feelingButton.html('Feeling '+optionText+'  <span class="caret"></span>');
      }

      feelingButton.attr('data-feelid', optionID);
      feelingButton.attr('data-feeltext', optionText);
    });

  });
  /*********END**********5-7-Ehsan*/
  /*console.log(feelingOpsL);
  console.log(feelingButton);*/

  //******************************************************************User Self Ratio.
  //**********************************************************************************
  //**********************************************************************************
  var selfUserImg = $('img.user-img'),
      imgDataUser = selfUserImg.attr('data-user');
  
  selfUserImg.on('mouseover', function() {
    getLkDlkRatio.call(selfUserImg, imgDataUser);
    //console.log(imgDataUser);
  });

  //*****************************************req-delete-li, delete-li, report-post-li.
  //**********************************************************************************
  //**********************************************************************************

  /*var theCmtID = $(this).closest('.cm-comment').attr('id'),
                      cmtIDRes = theCmtID.split("-");
                  
  theCmtID = cmtIDRes[1];*/

  
  function deleteLiClickAssign() {
      var $this = $(this),
          thePostOrCmtID = "",
          delType = $this.attr('data-deltype'),
          delModal = $('div#deleteModal');
      //console.log("delete");
      
      if (delType == "0") {                          
        delModal.find('h4.modal-title').html("Delete Post");
        thePostOrCmtID = $this.closest('.post-display').attr('id');
      } else if (delType == "1") {
        delModal.find('h4.modal-title').html("Delete Comment");
        thePostOrCmtID = $this.closest('.cm-comment').attr('id');
            /*cmtIDRes = theCmtID.split("-");
        thePostOrCmtID = cmtIDRes[1]; */
      }
      delModal.attr("data-cmt_or_post_id", thePostOrCmtID)
                          .attr("data-deltype", delType);
  }

  function reqDeleteLiClickAssign() {
      var $this = $(this),
          thePostOrCmtID = "",
          delType = $this.attr('data-deltype'),
          reqDelModal = $('div#reqDeleteModal');
      //console.log("delete");
      if (delType == "0") {                          
        reqDelModal.find('h4.modal-title').html("Request To Delete Post");
        thePostOrCmtID = $this.closest('.post-display').attr('id');
      } else if (delType == "1") {
        reqDelModal.find('h4.modal-title').html("Request To Delete Comment");
        var theCmtID = $this.closest('.cm-comment').attr('id'),
            cmtIDRes = theCmtID.split("-");
        thePostOrCmtID = cmtIDRes[1]; 
      }
      reqDelModal.attr("data-cmt_or_post_id", thePostOrCmtID)
                             .attr("data-deltype", delType);
  }

  $('li.delete-li').on('click', function(){
      
      deleteLiClickAssign.call(this);
      
  });

  $('li.req-delete-li').on('click', function(){

      reqDeleteLiClickAssign.call(this);

  });

  $('li.report-post-li').on('click', function(){
      var thePostID = $(this).closest('.post-display').attr('id');
      
      $('div#reportModal').attr("data-post_id", thePostID);
  });

  //***************************************************************#editMyCfsn button.
  //**********************************************************************************
  //**********************************************************************************

  $('div#editModal button#editMyCfsn').on('click', function(){
      editMyConfession.call(this);
  });

  /*START23-6-Ehsan*/
  function editMyConfession() {
      var $this = $(this),
          baseUrl = $this.closest('body').attr('data-baseurl'), /*27-May-Ehsan*/
          confessString = "",
          confessionTxtA = null,
          confessionBq = null;

      if ($this.attr('data-curpage') == "profile") {
        confessionTxtA = $this.closest('.modal-header').find('textarea#text-input-edit-con');
        confessionBq = $('div.confession > blockquote');
        $this.html("Saving..."); /*17-6-Ehsan*/
      } else if ($this.attr('data-curpage') == "home") {
        $this.html("Updating...");
        confessionTxtA = $this.closest('.item').find('textarea');
        //console.log(confessionTxtA);
      }

      //console.log(typeof(confessionTxtA.val()));

      var ajRes = $.ajax({
          url: baseUrl+"/"+"confession", /*27-May-Ehsan*/
          data: {
            confess: confessionTxtA.val()
          }
      }).promise();

      ajRes.done( function( theReturned ) {
        
        if (theReturned === "true") {
          if ($this.attr('data-curpage') == "profile") {
              $this.html("Save"); /*17-6-Ehsan*/
              $this.prev().trigger('click');
              confessionBq.html(confessionTxtA.val());
              confessionBq.next().hide();
          } else if ($this.attr('data-curpage') == "home") {
              confessionTxtA.replaceWith('<blockquote class="confession-text">'+confessionTxtA.val()+'</blockquote>');
              $this.hide();
          }
        } else {
          if ($this.attr('data-curpage') == "profile") {
              $this.html("Save"); /*17-6-Ehsan*/
              console.log("Confession not saved.");
          } else if ($this.attr('data-curpage') == "home") {
            $this.html("Update");
          }
        }
      });

      ajRes.fail(function( theReturned ){
        if ($this.attr('data-curpage') == "profile") {
           $this.html("Save"); /*17-6-Ehsan*/
           console.log(theReturned);
        } else if ($this.attr('data-curpage') == "home") {
            $this.html("Update");
            console.log(theReturned);
        }
      });
  }
  /*END23-6-Ehsan*/

  //*******************************************************************#Report a post.
  //**********************************************************************************
  //**********************************************************************************

  $('div#reportModal button.sub-report').on('click', function(){
      submitReport.call(this);
  });

  function submitReport() {
      var $this = $(this),
          baseUrl = $this.closest('body').attr('data-baseurl'), /*27-May-Ehsan*/
          thePID = $this.closest('div#reportModal').attr('data-post_id'),
          theRID = $this.closest('div#reportModal').find('input[type=radio]:checked').val();
      $this.html("Reporting..."); /*17-6-Ehsan*/
          
      //console.log(thePID);
      //console.log(theRID);

      var ajRes = $.ajax({
          url: baseUrl+"/createreport", /*27-May-Ehsan*/
          data: {
            pid: thePID,
            rid: theRID
          }
      }).promise();

      ajRes.done( function( theReturned ) {
        
        if (theReturned === "true") {
          $this.html("Submit"); /*17-6-Ehsan*/
          $this.prev().trigger('click');          
          console.log("Post "+thePID+" reported.");
        } else {
          $this.html("Submit"); /*17-6-Ehsan*/
        }
        //console.log("not true!");
      });

      ajRes.fail(function( theReturned ){
         $this.html("Submit"); /*17-6-Ehsan*/
         console.log(theReturned);
      });

  }

  //***********************************************************#Delete a post/comment.
  //**********************************************************************************
  //**********************************************************************************

  $('div#deleteModal button.save-button').on('click', function(){
      deleteAPost.call(this);
  });

  function deleteAPost() {
      var $this = $(this),
          baseUrl = $this.closest('body').attr('data-baseurl'), /*27-May-Ehsan*/
          delModal = $this.closest('div.modal'),
          delType = delModal.attr('data-deltype'),
          cmtOrPostId = delModal.attr('data-cmt_or_post_id'),
          cmtOwnerPost = "",
          ajUrl = "";
      $this.html("Deleting..."); /*17-6-Ehsan*/
      
      if (delType == "1") {
          var cmtIDRes = cmtOrPostId.split("-");
          cmtOrPostId = cmtIDRes[1];
          cmtOwnerPost = cmtIDRes[0];
      }

      ajUrl = "deletepost/"+cmtOrPostId;
      var ajRes = $.ajax({
          url: baseUrl+"/"+ajUrl, /*27-May-Ehsan*/
          data: {
            type: delType
          }
      }).promise();

      ajRes.done( function( theReturned ) {
        
        if (theReturned === "true") {          
          $this.html("Delete"); /*17-6-Ehsan*/
          $this.prev().trigger('click');        
          if (delType == "0") {
            //console.log($('div.post-display[id='+cmtOrPostId+']').parent());
            $('div.post-display[id='+cmtOrPostId+']').parent().hide();
            console.log('Deleted posts:'+cmtOrPostId); /*28-May-Ehsan*/
          } else if (delType == "1") {
            //console.log($('div.post-display[id='+cmtOwnerPost+'] div.cm-comments > div.cm-comment[id='+cmtOwnerPost+'-'+cmtOrPostId+']'));
            console.log('Deleted comments:'); /*28-May-Ehsan*/
            var thePostDisplay = $('div.post-display[id='+cmtOwnerPost+']');
            thePostDisplay.find('div.cm-comments > div.cm-comment[id='+cmtOwnerPost+'-'+cmtOrPostId+']').hide();
            var countSpan = thePostDisplay.find('div.post-text > ul.ul-like-dislike-comment-count span.comment-count'), /*17-11-Ehsan*/
                currentCount = countSpan.html(),
                currentCount = parseInt(currentCount);
            countSpan.html(--currentCount);
          }
          console.log(cmtOrPostId+" deleted of "+cmtOwnerPost);
        } else {
          $this.html("Delete"); /*17-6-Ehsan*/
        }
        //console.log("not true!");
      });

      ajRes.fail(function( theReturned ){
         $this.html("Delete"); /*17-6-Ehsan*/
         console.log(theReturned);
      });
  }

  //*************************************************#Request To Delete a post/comment.
  //**********************************************************************************
  //**********************************************************************************

  $('div#reqDeleteModal button.save-button').on('click', function(){
      reqDeleteAPost.call(this);
  });

  function reqDeleteAPost() {
      var $this = $(this),
          baseUrl = $this.closest('body').attr('data-baseurl'), /*27-May-Ehsan*/
          delModal = $this.closest('div.modal'),
          delType = delModal.attr('data-deltype'),
          cmtOrPostId = delModal.attr('data-cmt_or_post_id'),
          ajUrl = "requesttodelete/"+cmtOrPostId;
      $this.html("Requesting..."); /*17-6-Ehsan*/

      var ajRes = $.ajax({
          url: baseUrl+"/"+ajUrl, /*27-May-Ehsan*/
          data: {
            type: delType
          }
      }).promise();

      ajRes.done( function( theReturned ) {
        
        if (theReturned === "true") {
          $this.html("Yes"); /*17-6-Ehsan*/
          $this.prev().trigger('click');          
          console.log(cmtOrPostId+" requested to be deleted.");
        } else {
          $this.html("Yes"); /*17-6-Ehsan*/
        }
        //console.log("not true!");
      });

      ajRes.fail(function( theReturned ){
         $this.html("Yes"); /*17-6-Ehsan*/
         console.log(theReturned);
      }); 
  }

  //******************************************************************View more posts.
  //**********************************************************************************
  //**********************************************************************************

  function loadMorePosts(theReturned, caller) {

      var $this = this,
          divToThrowAfter = null,
          divToThrowBefore = null, /*21-11-Ehsan*/
          viewMoreType = "",
          selfUserID = $('body').attr('data-user'), /*27-May-Ehsan*/
          loopLimit = 0,
          loopCount = 0,
          allowFUnfCon = 0,
          baseUrl = $this.closest('body').attr('data-baseurl'); /*27-May-Ehsan*/

      if (caller == "hash") {
          //console.log("Eve-26-May");
          //console.log(theReturned['posts'].length);
          //console.log(theReturned);
          
          loopLimit = theReturned['posts'].length;
          
          var divHashSearch = $('div.section-02 div.hash-search');
          if (divHashSearch.length) {
              divToThrowAfter = $('div.section-02 div.hash-search');
          } else {
              /*START17-6-Ehsan*/
              var adminCarouselDiv = $('div.section-02 div#carousel-example');
              if (adminCarouselDiv.length) {
                divToThrowAfter = adminCarouselDiv;  
              }/* else {
                divToThrowAfter = $('div.section-02 div.post-area').closest('div.row');
              }*/ //5-7-Ehsan
              /*END17-6-Ehsan*/
          }
          
          //$('div.section-02 > div.wrapper > div.post-display-section').remove(); //5-7-Ehsan
      } else if (caller == "viewmore") {
          /*START-21-11-Ehsan*/
          viewMoreType = parseInt($this.attr('data-viewmoretype'));

          if (viewMoreType == 7) {
            divToThrowBefore = $this.parent();
          } else {
            divToThrowAfter = $this.parent().prev();
          }

          /*END-21-11-Ehsan*/
          loopLimit = theReturned["length"]; //5-7-Ehsan (theReturned["length"] > 5)?5:
      }

      

      for(loopCount = 0; loopCount < loopLimit; loopCount++) {
          //console.log(loopCount);
          /*START-21-11-Ehsan*/
          if (viewMoreType == 7) {
            var theRowOfPost = $("<div></div>", {
                class: "row post-display-section"
            }).insertBefore(divToThrowBefore);
          } else {
            var theRowOfPost = $("<div></div>", {
                class: "row post-display-section"
            }).insertAfter(divToThrowAfter);
          }
          /*END-21-11-Ehsan*/

          var thePostDisplay = $("<div></div>", {
              class: "post-display",
              "data-user": theReturned['posts'][loopCount].user_id,
              id: theReturned['posts'][loopCount].id
          }).appendTo(theRowOfPost);

          var theLg2Div = $("<div></div>", {
              class: "col-lg-3 col-md-3 col-sm-3 col-xs-3"
          }).appendTo(thePostDisplay);

          var lg2Img = $("<img>", {
              src: theReturned['posts'][loopCount].img,
              class: "img-responsive img-rounded cm-img-pop user-img-post",
              "data-user": theReturned['posts'][loopCount].user_id,
              "data-img_canvas_id": "cvs-"+theReturned['posts'][loopCount].id,
              "data-toggle": "tooltip",              
              "data-placement": "right",
              "data-html": "true",
              title: "<canvas id='cvs-"+theReturned['posts'][loopCount].id+"' width='100' height='100'></canvas>"
          }).appendTo(theLg2Div);

          lg2Img.tooltip();
          //var theUserIdImg = theReturned['posts'][loopCount].user_id;
          lg2Img.on('shown.bs.tooltip', function(){
              //console.log("User Ratio loading: "+$(this).attr("data-user"));
              getLkDlkRatio.call(this, $(this).attr("data-user")); /*23-6-Ehsan*/
          });

          //!From here
          if (caller == "viewmore") {
            if (viewMoreType < 4) { //23-6-Ehsan
                allowFUnfCon = 1;
            }

          } else if (caller == "hash") {
            allowFUnfCon = 1;
          }

          if (allowFUnfCon) {
              
              if (theReturned['posts'][loopCount].type == 1) {
                  if(theReturned['posts'][loopCount].user_id != selfUserID) {

                      /*commented out Eve-26-May*/
                      /*if (viewMoreType == 1) {
                          var unfollowBtn = $('<button></button>', {
                              text: "Unfollow",
                              class: "btn btn-danger btn-unfollow"
                          }).appendTo(theLg2Div);

                          unfollowBtn.on("click",function(){

                              btnUnfollowFunctionality.call(this);

                          });
                      } else if (caller == "hash") {*/ //Old: (viewMoreType == 2) || (caller == "hash")
                          var followBtn = null;
                          if (theReturned['posts'][loopCount].following) {
                              followBtn = $('<button></button>', {
                                  text: "Followed",
                                  class: "btn btn-success btn-follow followed"
                              }).appendTo(theLg2Div);
                          } else {
                              followBtn = $('<button></button>', {
                                  text: "Follow",
                                  class: "btn btn-success btn-follow"
                              }).appendTo(theLg2Div);
                          }

                          followBtn.on("click",function(){

                              btnFollowFunctionality.call(this);

                          });
                      //} /*commented out Eve-26-May*/
                  }
              }
              console.log('Will bring confessions next...');
              console.log(theReturned['posts'][loopCount].confess);
              if (theReturned['posts'][loopCount].type != 1) { /*17-11-Ehsan*/
                if (theReturned['posts'][loopCount].confess) {
                  console.log('About to bring confessions...');
                  //7-11-Ehsan-Start******************
                  var btnShowConfession = $('<button></button>', { 
                    class: "btn btn-primary btn-confession",
                    "aria-hidden": "true",
                    "data-toggle": "modal",
                    "data-target": "#confessionModal-"+theReturned['posts'][loopCount].id,
                    "title": "Click this button to see the confession.",
                    text: "Confession",
                    "data-confessId": theReturned['posts'][loopCount].confess.id
                  }).appendTo(theLg2Div);
                  
                  $('<span></span>', {
                    class: "confession-view-count-span",
                    text: theReturned['posts'][loopCount].confess.view
                  }).appendTo(theLg2Div);

                  btnShowConfession.on("click", function(){
                    causeConfessionView.call(this);
                  });

                  //7-11-Ehsan-End******************
                
                  var divModal = $('<div></div>', {
                      class: "modal fade",
                      id: "confessionModal-"+theReturned['posts'][loopCount].id,
                      role: "dialog"
                  }).appendTo(thePostDisplay);

                      var divModalDialog = $('<div></div>', {
                          class: "modal-dialog"
                      }).appendTo(divModal);

                          var divModalContent = $('<div></div>', {
                              class: "modal-content"
                          }).appendTo(divModalDialog);

                              var divModalHeader = $('<div></div>', {
                                  class: "modal-header"
                              }).appendTo(divModalContent);

                                  $('<button></button>', {
                                      class: "close modal-close",
                                      "data-dismiss": "modal",
                                      type: "button",
                                      text: "X"
                                  }).appendTo(divModalHeader);

                                  $('<h4></h4>', {
                                      class: "modal-title",
                                      text: "Confession"
                                  }).appendTo(divModalHeader);
                              
                              var divModalBody = $('<div></div>', {
                                  class: "modal-body"
                              }).appendTo(divModalContent);                                                

                                  $('<blockquote></blockquote>', {
                                      class: "confession-text",
                                      text: theReturned['posts'][loopCount].confess.confess //7-11-Ehsan
                                  }).appendTo(divModalBody);

                              var divModalFooter = $('<div></div>', {
                                  class: "modal-footer"
                              }).appendTo(divModalContent);                                                

                                  $('<button></button>', {
                                      class: "btn btn-default button",
                                      "data-dismiss": "modal",
                                      type: "button",
                                      text: "Close"
                                  }).appendTo(divModalFooter);

                } //if (theReturned['posts'][loopCount].confess)
              } /*17-11-Ehsan*/
          } //if (allowFUnCon)
          
          var theLg9Div = $('<div></div>', {
              class: "col-lg-8 col-md-8 col-sm-7 col-xs-7 post-text" //5-7-Ehsan
          }).appendTo(thePostDisplay);
          
          /*START--21-11-Ehsan*/
          if (theReturned['posts'][loopCount].name) {
            
            var theNameA = $('<a></a>', {
                href: baseUrl+"/profile/"+theReturned['posts'][loopCount].user_id
            }).appendTo(theLg9Div);

            var theNameP = $('<p></p>', {
                class: "usernameP",
                text: theReturned['posts'][loopCount].name
            }).appendTo(theNameA);

          }
          /*END--21-11-Ehsan*/
          
          // Feeling and Time

          var postDetailsRow = $('<div></div>', {
              class: "row"
          }).appendTo(theLg9Div);

          if (theReturned['posts'][loopCount].feeling === "None") {
              
              var pDtlsRowColXs12 = $('<div></div>', {
                  class: "col-xs-12"
              }).appendTo(postDetailsRow);

              var pDtlsRowPostTimeP = $('<p></p>', {
                  class: "post-info"
              }).appendTo(pDtlsRowColXs12);

              var pDtlsRowPostTimeA = $('<a></a>', {
                  class: "post-info-link",
                  href: baseUrl+"/singlepost/"+theReturned['posts'][loopCount].id,
                  target: "_blank"
              }).appendTo(pDtlsRowPostTimeP); //9-2-link

              $('<small></small>', {
                  text: theReturned['posts'][loopCount].ago
              }).appendTo(pDtlsRowPostTimeA);

          } else if (theReturned['posts'][loopCount].feeling !== "None") {

              var pDtlsRowColLg6_1 = $('<div></div>', {
                  class: "col-lg-6 col-md-6 col-sm-6 col-xs-6"
              }).appendTo(postDetailsRow);

              var pDtlsRowPostTimeP = $('<p></p>', {
                  class: "post-info"
              }).appendTo(pDtlsRowColLg6_1);

              var pDtlsRowPostTimeA = $('<a></a>', {
                  class: "post-info-link",
                  href: baseUrl+"/singlepost/"+theReturned['posts'][loopCount].id,
                  target: "_blank"
              }).appendTo(pDtlsRowPostTimeP); //9-2-Ehsan

              $('<small></small>', {
                  text: theReturned['posts'][loopCount].ago
              }).appendTo(pDtlsRowPostTimeA);

              var pDtlsRowColLg6_2 = $('<div></div>', {
                  class: "col-lg-6 col-md-6 col-sm-6 col-xs-6"
              }).appendTo(postDetailsRow);

              var pDtlsRowFeelP = $('<p></p>', {
                  class: "post-info"
              }).appendTo(pDtlsRowColLg6_2);

              $('<small></small>', {
                  text: "Feeling "+theReturned['posts'][loopCount].feeling
              }).appendTo(pDtlsRowFeelP);              

          }
          // !!Feeling and Time
          
          //START17-6-Ehsan
          var thePostInside = $('<p></p>', {
              text: ""
          }).appendTo(theLg9Div);
          //console.log(theReturned['posts'][loopCount].post.length); /*28-May-Ehsan*/
          
          if (theReturned['posts'][loopCount].post.length > 300) {

            var strBrkOff = (theReturned['posts'][loopCount].post.substr(299)).indexOf(" ");
            var strBrkOffNl = (theReturned['posts'][loopCount].post.substr(299)).indexOf("\n");
            if ((strBrkOff != -1)&&(strBrkOffNl != -1)) {
              if ((theReturned['posts'][loopCount].post.substr(299+strBrkOff+1, 1)).match(/\//)) {
                strBrkOff = strBrkOffNl;
              }
              strBrkOff = (strBrkOffNl < strBrkOff)?strBrkOffNl:strBrkOff;
            }
            if (strBrkOff == -1) {
              thePostInside.html(theReturned['posts'][loopCount].post);  
            } else {

              if (theReturned['posts'][loopCount].post.length < 1000) {
                thePostInside.html(theReturned['posts'][loopCount].post.substr(0, 300+strBrkOff)+"<a href='#' class='btnSeemore'>...See more</a><span class='hiddenpostpart'>"+theReturned['posts'][loopCount].post.substr(300+strBrkOff)+"</span>");  
              } else {
                thePostInside.html(theReturned['posts'][loopCount].post.substr(0, 300+strBrkOff)+"<a href='"+baseUrl+"/singlepost/"+theReturned['posts'][loopCount].id+"' target='_blank'>...Continue reading</a>");
              }
              thePostInside.find('.btnSeemore').on('click', function(e){
                  e.preventDefault();
                  showRestOfPost.call(this);
              });
            
            }

          } else {
            thePostInside.html(theReturned['posts'][loopCount].post);
          }
                    
          //END17-6-Ehsan

          if (theReturned['posts'][loopCount].vidsrc) {
            
            var videlem = $('<div></div>', { //9-2-Ehsan
              class: "row mc-no-margin-padding embed-responsive embed-responsive-16by9"
            }).appendTo(theLg9Div);

            videlem.html('<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'+theReturned['posts'][loopCount].vidsrc+'" allowfullscreen></iframe>');
              
          }
          //  like-dislike-comment  
          var lkDlkCmtDiv = $('<div></div>', {
              class: "row like-dislike-comment"
          }).appendTo(theLg9Div);

          var ldcLg4Div1 = $('<div></div>',{
              class: "col-lg-4 col-md-4 col-sm-4 col-xs-4"
          }).appendTo(lkDlkCmtDiv);

          /*$('<span></span>', {
              class: "pull-right count",
              text: theReturned['posts'][loopCount].like
          }).appendTo(ldcLg4Div1);*/ /*17-11-Ehsan*/

          var lkSpan = $('<span></span>', {
                  class: "glyphicon glyphicon-thumbs-up like-img",
                  "data-liked": "0",
                  "data-liketype": "post"
          }).appendTo(ldcLg4Div1);

          if(theReturned['posts'][loopCount].liked) {
              lkSpan.addClass('liked');
              lkSpan.attr('data-liked', "1");
          }

          var ldcLg4Div2 = $('<div></div>',{
              class: "col-lg-4 col-md-4 col-sm-4 col-xs-4"
          }).appendTo(lkDlkCmtDiv);

          /*$('<span></span>', {
              class: "pull-right count",
              text: theReturned['posts'][loopCount].dislike
          }).appendTo(ldcLg4Div2);*/ /*17-11-Ehsan*/

          var dlkSpan = $('<span></span>', {
                  class: "glyphicon glyphicon-thumbs-down dislike-img",
                  "data-liked": "2",
                  "data-liketype": "post"
          }).appendTo(ldcLg4Div2);

          if(theReturned['posts'][loopCount].disliked) {
              dlkSpan.addClass('disliked');
              dlkSpan.attr('data-liked', "3");
          }


          var ldcLg4Div3 = $('<div></div>',{
              class: "col-lg-4 col-md-4 col-sm-4 col-xs-4"
          }).appendTo(lkDlkCmtDiv);

          /*$('<span></span>', {
              class: "pull-right count comment-count",
              text: theReturned['posts'][loopCount].comment
          }).appendTo(ldcLg4Div3);*/ /*17-11-Ehsan*/

          var commenterSpan = $('<span></span>', {
              class: "glyphicon glyphicon-comment comment-img cm-commenter",
              "data-reqsource": "commenter"
          }).appendTo(ldcLg4Div3);
          
          //  ! ! like-dislike-comment  

          /*START--17-11-Ehsan*/

          var ulLkDlkCmtCount = $('<ul></ul>', {
              class: "list-inline ul-like-dislike-comment-count"
          }).appendTo(theLg9Div);

          var likeCountLi = $('<li></li>').appendTo(ulLkDlkCmtCount);
          
          var likeCountLiSmall = $('<small></small>', {
              text: "Likes: "
          }).appendTo(likeCountLi);

          $('<span></span>', {
              class: "pull-right count",
              text: theReturned['posts'][loopCount].like
          }).appendTo(likeCountLiSmall);

          var dislikeCountLi = $('<li></li>').appendTo(ulLkDlkCmtCount);
          
          var dislikeCountLiSmall = $('<small></small>', {
              text: "Dislikes: "
          }).appendTo(dislikeCountLi);

          $('<span></span>', {
              class: "pull-right count",
              text: theReturned['posts'][loopCount].dislike
          }).appendTo(dislikeCountLiSmall);

          var commentCountLi = $('<li></li>').appendTo(ulLkDlkCmtCount);
          
          var commentCountLiSmall = $('<small></small>', {
              text: "Comments: "
          }).appendTo(commentCountLi);

          $('<span></span>', {
              class: "pull-right count comment-count",
              text: theReturned['posts'][loopCount].comment
          }).appendTo(commentCountLiSmall); 

          /*END--17-11-Ehsan*/
          
          $('<div></div>', {
              class: "row cm-comments"
          }).appendTo(theLg9Div);

          var theLg1Div = $('<div></div>', {
              class: "col-lg-1 col-md-1 col-sm-2 col-xs-2" //5-7-Ehsan
          }).appendTo(thePostDisplay);

          //24-May
          var rowOfBtnGrp = $('<div></div>', {
              class: "row"
          }).appendTo(theLg1Div);

          var btnGrpDiv = $('<div></div>', {
              class: "btn-group pull-right"
          }).appendTo(rowOfBtnGrp);
          //!!!!24-May

          var btn1OfBtnGrp = $('<button></button>', {
              type: "button",
              class: "btn btn-primary dropdown-toggle post-options",
              "data-toggle": "dropdown",
              "aria-expanded": "false"
          }).appendTo(btnGrpDiv);

          $('<span></span>', {
              class: "caret"
          }).appendTo(btn1OfBtnGrp);

          var caretUl = $('<ul></ul>', {
              class: "dropdown-menu option-class",
              role: "menu"
          }).appendTo(btnGrpDiv);

          if(theReturned['posts'][loopCount].user_id == selfUserID) {
              
              var li1CaretUl = $('<li></li>', {
                  class: "delete-li",
                  "data-deltype": "0"
              }).appendTo(caretUl);

              $('<a></a>', {
                href: "#",
                text: "Delete",
                "aria-hidden": "true",
                "data-toggle": "modal",
                "data-target": "#deleteModal"
              }).appendTo(li1CaretUl);

              li1CaretUl.on('click', function(){
                  /*var thePostID = $(this).closest('.post-display').attr('id');
              
                  $('div#postDeleteModal').attr("data-post_id", thePostID);*/
                  deleteLiClickAssign.call(this);
              });

          } else if(theReturned['posts'][loopCount].user_id != selfUserID) {
              
              var li1CaretUl = $('<li></li>', {
                  class: "req-delete-li",
                  "data-deltype": "0"
              }).appendTo(caretUl);

              $('<a></a>', {
                href: "#",
                text: "Request to delete",
                "aria-hidden": "true",
                "data-toggle": "modal",
                "data-target": "#reqDeleteModal"
              }).appendTo(li1CaretUl);

              li1CaretUl.on('click', function(){
                  /*var thePostID = $(this).closest('.post-display').attr('id');
              
                  $('div#postDeleteModal').attr("data-post_id", thePostID);*/
                  reqDeleteLiClickAssign.call(this);
              });

              var li2CaretUl = $('<li></li>', {
                  class: "report-post-li"
              }).appendTo(caretUl);

              $('<a></a>', {
                href: "#",
                text: "Report",
                "aria-hidden": "true",
                "data-toggle": "modal",
                "data-target": "#reportModal"
              }).appendTo(li2CaretUl);

              li2CaretUl.on('click', function(){
                  var thePostID = $(this).closest('.post-display').attr('id');
              
                  $('div#reportModal').attr("data-post_id", thePostID);
              });                
          }
   
          //24-May
          if(theReturned['posts'][loopCount].type >= 1) { //23-6-Ehsan
              var rowFbShare = $('<div></div>', {
                  class: "row pull-right div-fb-share"
              }).appendTo(theLg1Div);

              var theFbShareButton = $('<img>', {
                  class: "fbBtnShare",
                  "data-href": baseUrl+"/"+"singlepost/"+theReturned['posts'][loopCount].id, /*27-May-Ehsan*/
                  src: baseUrl+"/"+"img/facebook_sh2.png" /*27-May-Ehsan*/
              }).appendTo(rowFbShare);

              $('<div></div>', { /*5-7-Ehsan*/
                  class: "custom-fb-share-count",
                  text: "0"
              }).appendTo(rowFbShare);

              loadFbShareCounts.call(theFbShareButton);
              console.log("loadFbShareCounts called: "+theReturned['posts'][loopCount].id); /*28-May-Ehsan*/
        
              theFbShareButton.on('click', function(){
                  callFBShareDialog.call(this);
              });
              
              theRowOfPost.ready( function(){      
                    autoScrapeOGobject.call(this);      /*28-May-Ehsan*/
              });
          }
          //!!!!24-May
   
          setLikeDislikeEvents.call(lkDlkCmtDiv);

          commenterSpan.on('click', function(){
              setUpTheCommenterEvent.call(this);
          });

          

          if (caller == "viewmore") {
            if (viewMoreType < 4) { //23-6-Ehsan
                theRowOfPost.find('.tags').on('click', function(e){ //25-May
                    e.preventDefault(); /*Eve-28-May*/
                    getTagResultsByClick.call(this);
                });  
            }
            //5-7-Ehsan

          } else if (caller == "hash") {
            theRowOfPost.find('.tags').on('click', function(e){ //25-May
                e.preventDefault(); /*Eve-28-May*/
                getTagResultsByClick.call(this);
            });
            /*theRowOfPost.css({
              "opacity": "0.3"
            });
            theRowOfPost.animate({
              "opacity": "1"
            }, 1000);*/
            //console.log('animating posts directly');
          }

          theRowOfPost.addClass('hiddenpostpart'); //5-7-Ehsan
          console.log('adding class: hiddenpostpart');
          
          if (viewMoreType != 7) divToThrowAfter = theRowOfPost; /*21-11-Ehsan*/

          commenterSpan.trigger('click'); /*28-May*/

      } //End of for-loop

      if (caller == "viewmore") {
          /*Morn-28-May*/
          var theLastOff = parseInt($this.attr('data-lastpost'));/*5-7-Ehsan*/
          $this.attr('data-lastpost', theLastOff+10);/*5-7-Ehsan*/
          
          /*if (theReturned['length'] > 5) {  
              $this.attr('data-lastpost', theReturned['posts'][4].id);
          } else {
              $this.parent().hide();
          }*/ /*Morn-28-May*/
          
      }/* else if (caller == "hash") {
          
          //$('div.section-02 div.view-more-posts').hide();
        
      }*/ //5-7-Ehsan

      $this.trigger('morePostsLoaded'); /*5-7-Ehsan*/
      
  } //!loadMorePosts /*Eve-26-May-Ehsan*/ 

  /***********START****************************************5-7-Ehsan*/
  function showTheHiddenPosts() {
    var $this = this,
        viewMoreType = parseInt($this.attr('data-viewmoretype')),
        listOfHiddenPosts = null;

    if ((viewMoreType >= 4) && (viewMoreType <= 6)) { //21-11-Ehsan
        listOfHiddenPosts = $this.closest('.tab-pane').find('div.post-display-section.hiddenpostpart');
    } else if ((viewMoreType < 4) || (viewMoreType == 7)) { //21-11-Ehsan
        listOfHiddenPosts = $('div.post-display-section.hiddenpostpart');      
    }

    if (listOfHiddenPosts.length) {
      
      listOfHiddenPosts.each(function(){
          var elem = $(this);
          elem.removeClass('hiddenpostpart');
          elem.css({
            "opacity": "0.3"
          });
          elem.animate({
            "opacity": "1"
          }, 1000);
          
      });
      console.log("showTheHiddenPosts triggered once.");
    }
  
  }

  function viewMorePosts() {
      var $this = $(this),
          theWindow = $(window),
          theBaseTime = $('body').attr('data-basetime'), //5-7-Ehsan
          baseUrl = $this.closest('body').attr('data-baseurl'); /*27-May-Ehsan*/
      console.log("************************************BASETIME**********************************************:"+theBaseTime);
      //$this.off('click');/*27-May-Ehsan*/
      //$this.html("Loading...");/*Eve-28-May*/
      
      var lastPost = $this.attr('data-lastpost'),
          viewMoreType = $this.attr('data-viewmoretype');

      var ajRes = $.ajax({
          url: baseUrl+"/viewmoreposts", /*27-May-Ehsan*/
          dataType: "json",
          data: {
            off: lastPost,
            type: viewMoreType,
            time: theBaseTime //5-7-basetime
          }
      }).promise();

      ajRes.done( function( theReturned ) {
        console.log("viewMorePosts::result-length: "+theReturned['length']);
        
        var profileUlMyTab = $('div.section-02 > div.wrapper ul#myTab');

        if ((theReturned['length'] != undefined) && (theReturned['length'] != null)) {

            if (theReturned['length'] != 0) {
                
                $this.on('morePostsLoaded', function(){
                    $this.off('morePostsLoaded');
                    showTheHiddenPosts.call($this);
                    if (profileUlMyTab.length) {
                      if (profileUlMyTab.children('li[data-viewmoretype='+$this.attr('data-viewmoretype')+']').hasClass('active')){
                          theWindow.scroll(function(){
                            loadPostsOnScrollToBottom.call(this);  
                          });
                      }
                    } else {
                      theWindow.scroll(function(){
                        loadPostsOnScrollToBottom.call(this);  
                      });
                    }
                    

                    console.log('viewMorePosts::morePostsLoaded');
                });/*27-May-Ehsan*/
                loadMorePosts.call($this, theReturned, "viewmore"); /*Eve-26-May-Ehsan*/        
                //console.log(theReturned);
            } else if (theReturned['length'] == 0) {
              //$this.parent().hide();
              if (profileUlMyTab.length) {
                if (profileUlMyTab.children('li[data-viewmoretype='+$this.attr('data-viewmoretype')+']').hasClass('active')){
                  theWindow.scroll(function(){
                    loadPostsOnScrollToBottom.call(this);  
                  });
                }
               profileUlMyTab.children('li[data-viewmoretype='+$this.attr('data-viewmoretype')+']').attr('data-scrollfinished', 'yes');
               
              }
              $this.parent().hide();
              console.log("No more posts left to load. You have reached the bottom.");
            }

        } else {
          if (profileUlMyTab.length) {
            if (profileUlMyTab.children('li[data-viewmoretype='+$this.attr('data-viewmoretype')+']').hasClass('active')){
              theWindow.scroll(function(){
                loadPostsOnScrollToBottom.call(this);  
              });
            }
            profileUlMyTab.children('li[data-viewmoretype='+$this.attr('data-viewmoretype')+']').attr('data-scrollfinished', 'yes');
           
          }
          $this.parent().hide();
          console.log("AJAX FAILURE. No theReturned."); 
        }
      });

      ajRes.fail(function( theReturned ){
         console.log(theReturned);
         console.log("ViewMorePosts: AJAX FAILURE.");
         var profileUlMyTab = $('div.section-02 > div.wrapper ul#myTab');
         /*$this.on('click', function(){
              viewMorePosts.call(this);
            });*/
         //$this.html("View more");/*Eve-28-May*/
          if (profileUlMyTab.length) {
            if (profileUlMyTab.children('li[data-viewmoretype='+$this.attr('data-viewmoretype')+']').hasClass('active')){
                theWindow.scroll(function(){
                  loadPostsOnScrollToBottom.call(this);  
                });
            }
          } else {
            theWindow.scroll(function(){
              loadPostsOnScrollToBottom.call(this);  
            });
          }
      });

  }

  var viewMorePostsBtn = $('div.view-more-posts');
  viewMorePostsBtn.each(function(){
    viewMorePosts.call(this);
  });
  //lastPost = $('div.post-display').last().attr('id');
  //console.log(viewMorePostsBtn.length);
  function loadPostsOnScrollToBottom() {
    var theWindow = $(this);
    if (theWindow.scrollTop() + theWindow.height() > $(document).height() - 100) {
      theWindow.off('scroll');
      console.log("window scrollTop: "+theWindow.scrollTop());
      if (viewMorePostsBtn.length) {
        var profileUlMyTab = $('div.section-02 > div.wrapper ul#myTab');

        if (profileUlMyTab.length) {
            console.log("Ekhane ki ashtese?");
            if (profileUlMyTab.children('li.active').attr('data-scrollfinished') == "no") {
              var theViewMoreType = profileUlMyTab.children('li.active').attr('data-viewmoretype');
              //console.log('Infinite Scroll: '+theViewMoreType);
              viewMorePostsBtn.each(function(){
                  if ($(this).attr('data-viewmoretype') == theViewMoreType) {
                    viewMorePosts.call(this);  
                  }
              });
            } else if (profileUlMyTab.children('li.active').attr('data-scrollfinished') == "yes") {
              theWindow.scroll(function(){
                loadPostsOnScrollToBottom.call(this);
              });
            } 

        } else {
            viewMorePostsBtn.each(function(){
              viewMorePosts.call(this);
            });
        }
             
      } else {
        theWindow.scroll(function(){
          loadPostsOnScrollToBottom.call(this);
        });
      }

    }  
  }

  /***********END******************************************5-7-Ehsan*/

  //***************************************************************View more comments.
  //**********************************************************************************
  //**********************************************************************************

  function viewMoreComments() {
      /******START******5-7-Ehsan*/
      var $this = $(this),
          theBaseTime = $this.closest('body').attr('data-basetime'), //5-7-Ehsan
          baseUrl = $this.closest('body').attr('data-baseurl'), /*27-May-Ehsan*/
          thePostID = $this.closest(".post-display").attr("id"),
          ajUrl = "getcomments/"+thePostID;
      //console.log(baseUrl);
      $this.off('click');/*27-May-Ehsan*/
      $this.html("Loading...");/*Eve-28-May*/
      var lastComment = $this.attr('data-lastcomment');

      var ajRes = $.ajax({
          url: baseUrl+"/"+ajUrl, /*27-May-Ehsan*/
          dataType: "json",
          data: {
            off: lastComment,
            time: theBaseTime //5-7-basetime
          }
      }).promise();
      /******END******5-7-Ehsan*/
      ajRes.done( function( theReturned ) {
        $this.on('moreCommentsLoaded', function(){
            $this.off('moreCommentsLoaded');
            $this.on('click', function(){
              viewMoreComments.call(this);
            });
            $this.attr('data-lastcomment', parseInt($this.attr('data-lastcomment'))+3); /*5-7-Ehsan*/
            $this.html("View more");/*Eve-28-May*/
        });/*27-May-Ehsan*/
        loadThemComments.call($this, theReturned);
        //console.log(theReturned);
      });

      ajRes.fail(function( theReturned ){
         console.log(theReturned);
         $this.on('click', function(){
              viewMoreComments.call(this);
            });/*27-May-Ehsan*/
         $this.html("View more");/*Eve-28-May*/
      });
  }

  //*******************************************************Change the Profile Picture.
  //**********************************************************************************
  //**********************************************************************************

  function changeProfilePicture() {
      
      var $this = $(this),
          baseUrl = $this.closest('body').attr('data-baseurl'), /*27-May-Ehsan*/
          pictureVal = $this.val(),
          pictureUrl = $this.closest('label').find('img').attr('src'), //5-7-Ehsan
          mainPicture = $this.closest('body').find('div.section-01 img.user-img'), //23-6-Ehsan
          theUrl = 'setpicture/'+pictureVal;

      var ajRes = $.ajax({
          url: baseUrl+"/"+theUrl,
      }).promise();

      ajRes.done( function( theReturned ) {
        
        if (theReturned === 'true') {

            mainPicture.attr('src', pictureUrl);
            mainPicture.attr('data-userpicture', pictureVal);
            console.log('Profile picture change query fired.');
        }

      });

      ajRes.fail(function( theReturned ){
         console.log(theReturned);
      });      

  }

  $('div.img-choice').find('input[type=radio]').change(function(){
      changeProfilePicture.call(this);
  });

  //*******Update the Facebook Open Graph object tags for Share and other Share stuff.
  //**********************************************************************************
  //**********************************************************************************  
  //, image, title, desc 
  function callFBShareDialog(){
    
    var $this = $(this),
        objUrl = $this.attr('data-href'),
        objUrl = encodeURI(objUrl),
        mainUrl = "https://www.facebook.com/sharer/sharer.php?u="+objUrl;


    /*var obj = {
      method: 'share',
      href: objUrl
    };
    function callback(response){}
    FB.ui(obj, callback);*/

    window.open(mainUrl, "", "width=500, height=400");
  
  }

  $('.fbBtnShare').on( 'click', function(){
    
    callFBShareDialog.call(this);
    
  });
  //, elem.attr('data-image'), elem.attr('data-title'), elem.attr('data-desc')
  
  function loadFbShareCounts() {
      var $this = $(this),
          objectUrl = $this.attr('data-href');
      
      /*console.log($this);
      console.log(objectUrl);*/
      
      var ajRes = $.ajax({
          url: "https://graph.facebook.com/",
          dataType: "json",
          data: {
            id: objectUrl
          }
      }).promise();

      ajRes.done( function( theReturned ) {        
        
        if (theReturned){          
          console.log("From loadFbShareCounts: "+objectUrl); /*28-May-Ehsan*/
          if (theReturned.shares) {
            $this.siblings('.custom-fb-share-count').html(theReturned.shares);
            console.log("Count brought: "+theReturned.shares+" for "+objectUrl); /*28-May-Ehsan*/
            
          }
        }

      });

      ajRes.fail(function( theReturned ){
         console.log("Loading share count failed.");
      });

  }

  $('div.post-display-section .fbBtnShare').each(function(){
      loadFbShareCounts.call(this);
      
  });

  function autoScrapeOGobject() {

      var $this = $(this),
          fbShareButton = $this.find('.fbBtnShare'),
          objectUrl = fbShareButton.attr('data-href');

      if (fbShareButton.length) {
          var ajRes = $.ajax({
              url: "https://graph.facebook.com/",
              type: 'POST',
              dataType: "json",
              data: {
                id: objectUrl,
                scrape: "true"
              }
          }).promise();

          ajRes.done( function( theReturned ) {        
            
            if (theReturned){
              
              console.log("Rescraped: "+objectUrl); /*28-May-Ehsan*/
              
             }

          });

          ajRes.fail(function( theReturned ){
             console.log("Rescraping failed for: "+objectUrl);
          });
      }
  }

  $('div.post-display-section').ready( function(){      /*28-May-Ehsan*/
        autoScrapeOGobject.call(this);      
  });

  //**********************************************Get tag results by clicking on them.
  //**********************************************************************************
  //**********************************************************************************
  /* Eve-26-May-Ehsan */
  $('.tags').on('click', function(e){ //25-May
      e.preventDefault();	 /*Eve-28-May*/
      getTagResultsByClick.call(this);
  });

  function getTagResultsByClick() {
      $(window).off('scroll'); /*5-7-Ehsan*/
      var $this = $(this),
          btnViewMorePosts = $('div.section-02 div.btn-view-more-posts'),
          thePosttype = $('div.section-02 div.post-area').attr('data-posttype'), /*5-7-Ehsan*/
          baseUrl = $this.closest('body').attr('data-baseurl'); /*27-May-Ehsan*/
      $this.off('click'); /*27-May-Ehsan*/
     /*Eve-28-May*/
      var hashString = $this.html();
      if (thePosttype == "0") thePosttype = "1";
      /*$this.tooltip({ 
        container: "body", 
        title: "Loading "+hashString+" posts...",
        placement: "auto",
        trigger: "click"
      });
      $this.tooltip("show");*/
      /*5-7-Ehsan*/
      if ($('div.section-02 div.btn-view-more-posts:hidden')) {
        btnViewMorePosts.show();
      }
      $('div.wrapper div.post-display-section').remove(); //5-7-Ehsan


      var ajRes = $.ajax({
          url: baseUrl+"/searchresult", /*27-May-Ehsan*/
          dataType: "json",
          data: {
            tag: hashString,
            type: thePosttype /*5-7-Ehsan*/
          }
      }).promise();

      ajRes.done( function( theReturned ) {        
        //console.log(theReturned);
        if (theReturned['posts'].length){          

          console.log('Hashtag matched posts: '+theReturned['posts'].length);
          btnViewMorePosts.on('morePostsLoaded', function(){
              showTheHiddenPosts.call(btnViewMorePosts.children('.view-more-posts'));//5-7-Ehsan
              btnViewMorePosts.off('morePostsLoaded');
              $this.on('click', function(){
                getTagResultsByClick.call(this);
              });
              
              btnViewMorePosts.hide(); //5-7-Ehsan
		          console.log('*******************************************************************************************************getTagResultsByClick::morePostsLoaded');
          });/*27-May-Ehsan*/
          //$this.tooltip("destroy"); //Eve-28-May
          //btnViewMorePosts.hide(); //5-7-Ehsan
          loadMorePosts.call(btnViewMorePosts, theReturned, "hash"); /*27-May-Ehsan*/
        } else {
          //$this.tooltip("destroy"); //Eve-28-May
          btnViewMorePosts.hide(); //5-7-Ehsan
          $this.on('click', function(){
            getTagResultsByClick.call(this);
          });
        }

      });

      ajRes.fail(function( theReturned ){
        console.log("No hash for you baby.");
        //$this.tooltip("destroy"); //Eve-28-May
        btnViewMorePosts.hide(); //5-7-Ehsan
        $this.on('click', function(){
          getTagResultsByClick.call(this);
        });/*27-May-Ehsan*/
      });          
      
  }

  //****************************************************Look up tag results by typing.
  //**********************************************************************************
  //**********************************************************************************
  //$('div.hash-search > .hashresulttable').hide();
  $('div.hash-search > input').on('keyup', function(){
      if (this.value) {
        lookupTagByTyping.call(this, this.value);
      } else {
        $(this).siblings('.hashresulttable').hide();
      }
  });

  function lookupTagByTyping(str) {
      var $this = $(this),
          thePosttype = $('div.section-02 div.post-area').attr('data-posttype'), //5-7-Ehsan
          baseUrl = $this.closest('body').attr('data-baseurl'); /*27-May-Ehsan*/

      var ajRes = $.ajax({
          url: baseUrl+"/searchtag", /*27-May-Ehsan*/
          dataType: "json",
          data: {
            tag: str,
            type: thePosttype //5-7-Ehsan
          }
      }).promise();

      ajRes.done( function( theReturned ) {        
        console.log(theReturned);
        if (theReturned){          
          console.log('Hashtag matches found through typing: '+theReturned);
          loadResultofTagLookup.call($this, theReturned);
        } else {
          $this.siblings('.hashresulttable').hide();   //5-7-Ehsan
        }

      });

      ajRes.fail(function( theReturned ){
         console.log("No hashtags for you baby.");
         $this.siblings('.hashresulttable').hide();   //5-7-Ehsan
      });
  }

  function loadResultofTagLookup(theReturned) {
      var $this = this,
          hashUl = $this.siblings('.hashresulttable').children('ul');
      //console.log(hashUl);
      if (theReturned['tags'].length == 0) {
         hashUl.empty();
         $('<li></li>', {
            text: "No matches found."
         }).appendTo(hashUl);
      } else {
          hashUl.empty();
          var loopCount = 0;
          for(loopCount = 0; loopCount < theReturned['tags'].length; loopCount++) {
             
             var liHash = $('<li></li>', {
                text: theReturned['tags'][loopCount].tag
             }).appendTo(hashUl);
             
             liHash.on('click', function(){
                getTagResultsByClick.call(this);
                $this.val("");
                $this.siblings('.hashresulttable').hide();
             });
          }
      }

      $this.siblings('.hashresulttable').show();
  }

  //******************************************************btnSeemore, continueSeemore.
  //**********************************************************************************
  //**********************************************************************************
  /*27-May-Ehsan*/
  $('.btnSeemore').on('click', function(e){
      e.preventDefault();
      showRestOfPost.call(this);
  });

  function showRestOfPost() {
      var $this = $(this);
      $this.siblings('.hiddenpostpart').show();
      $this.remove();
  }

  //***************************************************************Notifications seen.
  //**********************************************************************************
  //**********************************************************************************

  $('header.navbar-fixed-top button#notif-icon').on('click', function(){
      var $this = $(this),
          baseUrl = $this.closest('body').attr('data-baseurl'); /*27-May-Ehsan*/

      var ajRes = $.ajax({
          url: baseUrl+"/notificationclick" /*27-May-Ehsan*/
      }).promise();

      ajRes.done( function( theReturned ) {        
        
        if (theReturned == "true"){          
          $this.removeClass('notification-alert');
          $this.children('span').empty().addClass('glyphicon glyphicon-flag');
        }

      });

      ajRes.fail(function( theReturned ){
         
      });

  });

  //************************************************************Select my institution.
  //**********************************************************************************
  //**********************************************************************************

 var mainInstSelecDiv = $('div.section-02 > div.wrapper div#main-inst-selec-div');

  mainInstSelecDiv.find('button').on('click', function(){
      changeInstitution.call(this);
  });

  if (mainInstSelecDiv.length) {
    mainInstSelecDiv.find('select').on('change', function(){
      //activateSelInstBtn.call(this);
      var $this = $(this);
      $this.closest('.media').find('button').removeAttr("disabled").html("Confirm Selection");
    });
  
  }

  function changeInstitution() {
    var $this = $(this),
        camId = $this.closest('.media').find('option:selected').attr('data-campusid'),
        baseUrl = $this.closest('body').attr('data-baseurl');

    if (camId == "1") { //This is temporary. Need to check if current camId==1, then if selected camId==1, then the following lines will run.
      $this.closest('.media').find('p').html("Please Select An Institute.");
      return;
    }

    var ajRes = $.ajax({
        url: baseUrl+"/setcampus/"+camId
    }).promise();

    ajRes.done( function( theReturned ) {        
      $this.closest('.media').find('p').html("Loading institution...");
      if (theReturned == "true"){
        $this.html("Select An Institute");
        if ($this.closest('div#main-inst-selec-div').attr('data-curpage') == "campus") {
          // A case like (camId = "1") is not possible in Campus page.
          $this.prop('disabled', 'disabled');
          window.location.reload();
        } else if ($this.closest('div#main-inst-selec-div').attr('data-curpage') == "home") {
          if (camId == "1") { 
            //Property 'disabled' wont be activated here, functionality will still be on... 
            
            //In setCampus@AjaxsController, if last update is camId==1, then dont count days.
          } else {
            $this.closest('.media').find('p').html("Your Institution has been selected. You must wait for a period of 30 days from the day you selected it, in order to be able to change it again.");
            $this.prop('disabled', 'disabled');
            $this.closest('.media').find('select').prop('disabled', 'disabled');
          }

        }
      } else if (theReturned == "false") {
        $this.closest('.media').find('p').html("Something went wrong it seems, please try again.");
      }

    });

    ajRes.fail(function( theReturned ){
      $this.closest('.media').find('p').html("Something went wrong it seems, please try again."); //9-7-Ehsan
       console.log("changeInstitution failed.");
       console.log(theReturned);
    });

  }

  //***********************************************Cause and increase Confession view.
  //**********************************************************************************
  //**********************************************************************************

  function causeConfessionView() {  //7-11-Ehsan
    var $this = $(this),
        confessionId = $this.attr("data-confessId"),
        baseUrl = $this.closest('body').attr('data-baseurl');
    if (confessionId == "done") return;

    var viewCount = $this.siblings('span').html();

    var ajRes = $.ajax({
        url: baseUrl+"/viewconfession",
        data: {
            cid: confessionId
        }
    }).promise();

    ajRes.done( function( theReturned ) { 
      if (theReturned == "true") { 
        console.log("causeConfessionView successful::");
        $this.siblings('span').html(parseInt(viewCount)+1);
        $this.attr("data-confessId", "done");
      } else {
        if (theReturned == "done") $this.attr("data-confessId", "done");
        console.log("causeConfessionView failed:: theReturned is false."); 
      }
    });

    ajRes.fail(function( theReturned ){
       console.log("causeConfessionView failed:: ajRes failed.");
       console.log(theReturned);
    });
  }

  //***************************************************************************Turash.
  //**********************************************************************************
  //**********************************************************************************

  /******start-11/08/15-Turash*****/
  $('ul.notification-menu').find('span.glyphicon').css({
    'margin-right':'10px'
  });

  $('div.name-check').find('input.toggle-name-check').css({
    'margin-top':'2px'
  });

  $('input').css('border-radius','1px');

  /******end-11/08/15-Turash*****/

  //******************************************************user-name add functionality.
  //**********************************************************************************
  //**********************************************************************************

  $("body").on("click", "#name-add", function(){
    var $this = $(this),
        baseUrl = $this.closest('body').attr('data-baseurl');

    var ajRes = $.ajax({
        url: baseUrl+"/setusername",
        type: "POST",
        dataType: "json",
        data: {
            name: $this.parent().siblings().children('input')[0].value
        }
    }).promise();

    ajRes.done( function( theReturned ) { 
      
      if (theReturned['status'] == false) { 

        $this.parent().parent().siblings('span').html(theReturned['message']['name'][0]);

        console.log(theReturned);
      } else if (theReturned['status'] == true) {
        $this.html("Edit!");
        var divUserNameArea = $('div.user-name-area');
        
        divUserNameArea.find('button[data-toggle=popover] span.glyphicon')
                .removeClass('glyphicon-plus').addClass('glyphicon-pencil');
        
        divUserNameArea.find('button[data-toggle=popover] span.user-name-pop-btn')
                .removeClass('glyphicon-plus').html("Edit Name");
        
        divUserNameArea.find('div#popover-content button#name-add').html('Edit');
        divUserNameArea.find('div#popover-content input[type=text]').attr("placeholder", $this.parent().siblings().children('input')[0].value);

        $('div.popover-content button#name-add').html("Edit");

        divUserNameArea.find('button[data-toggle=popover]').trigger('click');
      }

    });

    ajRes.fail(function( theReturned ){
    
    });

  });
  
})(jQuery, document, window, undefined);