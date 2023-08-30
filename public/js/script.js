$(document).ready(function(){
	/* This code is executed after the DOM has been completely loaded */

	/* Changing thedefault easing effect - will affect the slideUp/slideDown methods: */
	$.easing.def = "easeOutBounce";

	/* Binding a click event handler to the links: */
	$('li.button a').click(function(e){
	
		/* Finding the drop down list that corresponds to the current section: */
		var dropDown = $(this).parent().next();
		
		/* Closing all other drop down sections, except the current one */
		$('.dropdown').not(dropDown).slideUp('slow');
		dropDown.slideToggle('slow');
		
		/* Preventing the default event (which would be to navigate the browser to the link's address) */
		e.preventDefault();
	})
	
});
(function($) {
		$.fn.menumaker = function(options) {  
		 var cssmenu = $(this), settings = $.extend({
		   format: "dropdown",
		   sticky: false
		 }, options);
		 return this.each(function() {
		   $(this).find(".button").on('click', function(){
			 $(this).toggleClass('menu-opened');
			 var mainmenu = $(this).next('ul');
			 if (mainmenu.hasClass('open')) { 
			   mainmenu.slideToggle().removeClass('open');
			 }
			 else {
			   mainmenu.slideToggle().addClass('open');
			   if (settings.format === "dropdown") {
				 mainmenu.find('ul').show();
			   }
			 }
		   });
		   cssmenu.find('li ul').parent().addClass('has-sub');
		multiTg = function() {
			 cssmenu.find(".has-sub").prepend('<span class="submenu-button"></span>');
			 cssmenu.find('.submenu-button').on('click', function() {
			   $(this).toggleClass('submenu-opened');
			   if ($(this).siblings('ul').hasClass('open')) {
				 $(this).siblings('ul').removeClass('open').slideToggle();
			   }
			   else {
				 $(this).siblings('ul').addClass('open').slideToggle();
			   }
			 });
		   };
		   if (settings.format === 'multitoggle') multiTg();
		   else cssmenu.addClass('dropdown');
		   if (settings.sticky === true) cssmenu.css('position', 'fixed');
		resizeFix = function() {
		  var mediasize = 1000;
			 if ($( window ).width() > mediasize) {
			   cssmenu.find('ul').show();
			 }
			 if ($(window).width() <= mediasize) {
			   cssmenu.find('ul').hide().removeClass('open');
			 }
		   };
		   resizeFix();
		   return $(window).on('resize', resizeFix);
		 });
		  };
		})(jQuery);
		
		(function($){
		$(document).ready(function(){
		$("#cssmenu").menumaker({
		   format: "multitoggle"
		});
		});
		})(jQuery);