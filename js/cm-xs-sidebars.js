(function($){

	var theWindow = $(window),
		leftButton = $('header.navbar-fixed-top #cm-left-sidebar-button'),
		rightButton = $('header.navbar-fixed-top #cm-right-sidebar-button'),
		leftSection = $('div.section-01'),
		rightSection = $('div.section-03'),
		closeLeftSidebar = $('div.section-01 span#cm-left-sidebar-x'),
		closeRightSidebar = $('div.section-03 span#cm-right-sidebar-x');

	theWindow.resize(function(){

		var win_h = theWindow.height(),
			win_w = theWindow.width(), 		
			xsFlag = $('header.navbar-fixed-top div#xs-flag').css('top'),
			cmXsLeftSidebar = $('div#cm-xs-left-sidebar').length,
			cmXsRightSidebar = $('div#cm-xs-right-sidebar').length,
			topFlop = $("div.top-flop-fixed"); 
		
		//console.log(resultChartParentWidth);	
		
		if (win_w > 757) { //750 chhilo agey 5-7-Ehsan

			if(cmXsLeftSidebar) {
				closeLeftSidebar.trigger("click");
			} else if (cmXsRightSidebar) {
				closeRightSidebar.trigger("click");
			}
		}

		if (xsFlag==="0px") {

			leftSection.css({
				'min-height': win_h,
				'max-height': win_h
			});

			rightSection.css({
				'min-height': win_h,
				'max-height': win_h
			});

			/*****START******5-7-Ehsan*/
			if(topFlop.attr('data-answered') == "1") {
				topFlop.css({
					'min-height': win_h,
					'max-height': win_h
				});
			} else {
				topFlop.css({
					'min-height': win_h - 300,
					'max-height': win_h - 300
				});
			}
			/*****END******5-7-Ehsan*/

		} else {

			leftSection.css({
				'min-height': win_h - 67,
				'max-height': win_h - 67
			});

			rightSection.css({
				'min-height': win_h - 67,
				'max-height': win_h - 67
			});

			/*****START******5-7-Ehsan*/
			if(topFlop.attr('data-answered') == "1") {
				topFlop.css({
					'min-height': win_h - 67,
					'max-height': win_h - 67
				});
			} else {
				topFlop.css({
					'min-height': win_h - 367,
					'max-height': win_h - 367
				});
			}
			/*****END******5-7-Ehsan*/
		
		}

	}).resize();

	leftButton.on('click', function(){
		leftSection.attr('id', 'cm-xs-left-sidebar');
		theWindow.resize();
		//console.log('okay');
		leftSection.animate({
			'width': '100%'
		});
	});

	rightButton.on('click', function(){
		rightSection.attr('id', 'cm-xs-right-sidebar');
		theWindow.resize();
		//console.log('okay');
		rightSection.animate({
			'width': '100%'
		});
	});	

	closeLeftSidebar.on('click', function(){
		leftSection.animate({
			'width': '0%'
		}, {
			complete: function(){
				leftSection.removeAttr('id');
				leftSection.css({
					'width': '25%'
				});
			}
		});
	});

	closeRightSidebar.on('click', function(){
		rightSection.animate({
			'width': '0%'
		}, {
			complete: function(){
				rightSection.removeAttr('id');
				rightSection.css({
					'width': '25%'
				});
			}
		});
	});

})(jQuery);