/* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	scripts.js
	
	The scripts used on the site
	URL: http://crille.org/uppgift3
	Course: Reponsiv Webdesign (WD450F)
	
	Christian Ohlsson (KROL0019)
	crille@crille.org || kristian.olsson0019@stud.hkr.se
--------------------------------------------------------------------*/


/* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	Waits for a click on the Welcome screen	
--------------------------------------------------------------------*/
$(document).ready(function() {
	$('#welcomebox').click(function() {
		$('#welcomebox p').hide('slow', function() { });
		$('#welcomeimage').animate({ 
			opacity:'0' 
			}, 
			4000, 
			function() {
				window.location='index.php?p=News';
			});
	});	
});

/* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	Changes the UL navigation list into a SELECT-box
--------------------------------------------------------------------*/
// All righty then... The DOM is ready
$(function() {
	// Skapa select-lådan
	$("<select />").appendTo("nav#links");
	
	// Create default option "Go to..."
	$("<option />", {
	"selected": "selected",
	"value"   : "",
	"text"    : "Quick jump to..."
	}).appendTo("nav#links select");
	
	// Populate dropdown with menu items
	$("nav#links a").each(function() {
		var el = $(this);
		$("<option />", {
			"value"   : el.attr("href"),
			"text"    : " >" + el.text()
			}).appendTo("nav#links select");
	});
	
	// To make dropdown actually work
	$("nav#links select").change(function() {
		window.location = $(this).find("option:selected").val();
	});
});

/* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	Draws the logo in the footer, using canvas	
--------------------------------------------------------------------*/
$(function() {
	var canvas = document.getElementById('theLogo');
	var ctx = canvas.getContext('2d');
	var centerX = canvas.width / 2;
	var centerY = canvas.height / 2;
	var radius = 89;
	
	// Draw the red circle
	ctx.beginPath();
	ctx.arc(centerX, centerY, radius, 0, 2 * Math.PI, false);
	ctx.fillStyle = '#fff';
	ctx.fill();
	ctx.lineWidth = 22;
	ctx.strokeStyle = '#cc0b0b';
	ctx.stroke();		

	// Draw the black cross, first vertical line
	ctx.beginPath();
	ctx.moveTo(centerX, 22);
	ctx.lineTo(centerX, 178);	
	ctx.lineWidth = 28;
	ctx.strokeStyle = '#000';
	ctx.stroke();
	
	// Next, the horizontal line
	ctx.beginPath();
	ctx.moveTo(50, 78);
	ctx.lineTo(150, 78);	
	ctx.stroke();
	
	// Finally, draw the red NO-line
	ctx.beginPath();
	ctx.moveTo(45, 40);
	ctx.lineTo(170, 170);	
	ctx.lineWidth = 22;
	ctx.strokeStyle = '#cc0b0b';
	ctx.stroke();	
});	

/* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	Finds videos from Youtube on the page and resizes them
--------------------------------------------------------------------*/
$(document).ready(function() {
	// Find the video from Youtube
	var $allVideos = $("iframe[src^='http://www.youtube.com']"),
	    // Find the element containing the video 
	    $fluidEl = $("#videobox");
	$(window).resize(function() {
		var newWidth = $fluidEl.width();
		
		// Resize all videos according to their own aspect ratio
		$allVideos.each(function() {
			var $el = $(this);
			$el
				.width(newWidth)
				.height(newWidth*0.56); /*newWidth * $el.data('aspectRatio')*/
		});
	// Kick off one resize to fix all videos on page load
	}).resize();

});

/* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	Loads the different parts of the page using AJAX
	INPUT:	The information needed
	CALLS:	functions.php
	RETURNS:	HTML-text into correct DIV	
--------------------------------------------------------------------*/
function getContent(what) {
	$.ajax({ url: "functions.php",
				data: "action=" + what,
				type: "post",
				success: function(output) {
								$('#' + what).html(output); 
							}
	});
}

