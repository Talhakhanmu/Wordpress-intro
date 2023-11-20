(function ($) {
    'use strict';
	
	var trapFocusInsiders = function(elem) {
			
				
			var tabbable = elem.find('select, input, textarea, button, a').filter(':visible');
			
			var firstTabbable = tabbable.first();
			var lastTabbable = tabbable.last();
			/*set focus on first input*/
			firstTabbable.focus();
			
			/*redirect last tab to first input*/
			lastTabbable.on('keydown', function (e) {
			   if ((e.which === 9 && !e.shiftKey)) {
				   e.preventDefault();
				   
				   firstTabbable.focus();
				  
			   }
			});
			
			/*redirect first shift+tab to last input*/
			firstTabbable.on('keydown', function (e) {
				if ((e.which === 9 && e.shiftKey)) {
					e.preventDefault();
					lastTabbable.focus();
				}
			});
			
			/* allow escape key to close insiders div */
			elem.on('keyup', function(e){
			  if (e.keyCode === 27 ) {
				elem.hide();
			  };
			});
			
		};
		
    //==========fixed header & scroll to top button===========
    $(document).ready(function(){

        // ===========nav sidebar show===========
        $(".side-bar-show").on('click', function(){
            $(".sidebar-bg, .main-sidebar").addClass("active");
            $("body").addClass("clear");

            trapFocusInsiders( $('.main-sidebar') );
        });
       
        $(".sidebar-bg, .close-btn").on('click', function(){
            $(".sidebar-bg, .main-sidebar").removeClass("active")
            $("body").removeClass("clear");
            if( $('.breadcrumbs li').length ){
                $('.breadcrumbs li').eq(0).find('a').focus();
            }else{
               $('.side-bar-btn button').focus();
            }
        });

       
      
		/*=============================================
		=            Main Menu         =
		=============================================*/
		
		$('.ow-navigation .nav.navbar-nav li > a').keyup(function (e) {
			if ( matchMedia( 'only screen and (min-width: 992px)' ).matches ) {
				$(".ow-navigation .nav.navbar-nav > li").removeClass('focus');
				
				$(this).parents('li.menu-item-has-children').addClass('focus').find('.dropdown-menu').addClass('keypress');
			}
		});	
		
		$(".ow-navigation .nav.navbar-nav li > a").hover(function(){
			if ( matchMedia( 'only screen and (min-width: 992px)' ).matches ) {
				$('li.menu-item-has-children').removeClass('focus');
				$('ul.dropdown-menu').removeClass('keypress');
			}
		});
		
		$('.navbar-toggle, .navbar-toggle a').keyup(function (e) {
			e.preventDefault();
			var code = e.keyCode || e.which;
			if(code == 13) {
				trapFocusInsiders( $('nav.navbar') );
			}
		});		

		$('.nav-close').on('click', function(e) {
         	$('#navbar').removeClass('show'); 
			$('.navbar-toggle').focus(); 
        });


		if( $(".ddl-switch").length ){
			$('.ddl-switch').keyup(function (e) {
    			var code = e.keyCode || e.which;
    			if(code == 13) {
    				var li = $(this).parent();
    				if ( li.hasClass("ddl-active") || li.find(".ddl-active").length !== 0 || li.find(".dropdown-menu").is(":visible") ) {
    					li.removeClass("ddl-active");
    					li.children().find(".ddl-active").removeClass("ddl-active");
    					li.children(".dropdown-menu").slideUp();
    				}
    				else {
    					li.addClass("ddl-active");
    					li.children(".dropdown-menu").slideDown();
    				}
    			}
			});


            $('.ddl-switch').on('click', function() {
                
                var li = $(this).parent();
                if ( li.hasClass("ddl-active") || li.find(".ddl-active").length !== 0 || li.find(".dropdown-menu").is(":visible") ) {
                    li.removeClass("ddl-active");
                    li.children().find(".ddl-active").removeClass("ddl-active");
                    li.children(".dropdown-menu").slideUp();
                }
                else {
                    li.addClass("ddl-active");
                    li.children(".dropdown-menu").slideDown();
                }

            });
		}

        if( $(".masonry_grid").length){
            $('.masonry_grid').masonry({
              // set itemSelector so .grid-sizer is not used in layout
              itemSelector: '.grid-item',
              // use element for option
              columnWidth: '.grid-sizer',
              percentPosition: true
            });
        }

        if( $( ".consted-sidebar .widget_block h2" ).length ){
	        $( ".consted-sidebar .widget_block h2" ).each(function( index ) {
	            $(this).html('<span>'+ $( this ).text() +'</span>');
	        });
        }

        if( $('#backToTop').length ){

                $('#backToTop').on('click', function() {
                    $("html, body").animate({ scrollTop: 0 }, 500);
                    return false;
                });
                
                $(window).scroll(function() {
                    if ( $(this).scrollTop() > 100 ) {
                        
                        $('#backToTop').addClass('active');
                    } else {
                      
                        $('#backToTop').removeClass('active');
                    }
                    
                }); 
        }


    });
}(jQuery));