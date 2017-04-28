var Footnotes = {
	footnotetimeout: false,
	setup: function() {
		var footnotelinks = jQuery('.footnoteRef')

		footnotelinks.unbind('mouseover', Footnotes.footnoteover);
		footnotelinks.unbind('mouseout', Footnotes.footnoteoout);

		footnotelinks.bind('mouseover', Footnotes.footnoteover);
		footnotelinks.bind('mouseout', Footnotes.footnoteoout);
	},
	footnoteover: function() {
		clearTimeout(Footnotes.footnotetimeout);
		jQuery('#footnotediv').stop();
		jQuery('#footnotediv').remove();

		var id = jQuery(this).attr('href').substr(1);
		var position = jQuery(this).offset();

		var div = jQuery(document.createElement('div'));
		div.attr('id', 'footnotediv');
		div.bind('mouseover', Footnotes.divover);
		div.bind('mouseout', Footnotes.footnoteoout);

		var el = document.getElementById(id);
		div.html('<div>' + jQuery(el).html() + '</div>');

		jQuery(document.body).append(div);

		var left = position.left;
		if (left + 420 > jQuery(window).width() + jQuery(window).scrollLeft())
			left = jQuery(window).width() - 420 + jQuery(window).scrollLeft();
		var top = position.top + 20;
		if (top + div.height() > jQuery(window).height() + jQuery(window).scrollTop())
			top = position.top - div.height() - 15;
		div.css({
			left: left,
			top: top,
			opacity: 1,
			position: "absolute"
		});
	},
	footnoteoout: function() {
		Footnotes.footnotetimeout = setTimeout(function() {
			jQuery('#footnotediv').animate({
				opacity: 0
			}, 300, function() {
				jQuery('#footnotediv').remove();
			});
		}, 100);
	},
	divover: function() {
		clearTimeout(Footnotes.footnotetimeout);
		jQuery('#footnotediv').stop();
		jQuery('#footnotediv').css({
			opacity: 1
		});
	}
}
Footnotes.setup();

jQuery(document).ready(function() {
	var ToC = "<h6>Table of Contents</h6>" +
		"<nav role='navigation'>" +
		"<ul>";

	var kx = $('article h4, article h5');
	var newLine = '';
	var o = 0;
	for (i = 0; i < kx.length; i++) {
		if (kx[i].nodeName == 'H4') {
			o++;
			newLine += '<li><a href="#' + kx[i].id + '"><span>'+o+'</span> '+kx[i].innerHTML+'</a></li>';
		}
		if (kx[i].nodeName == 'H5') {
			newLine += '<li class="intended"><a href="#' + kx[i].id + '">'+kx[i].innerText;
		}
	}
		

	ToC += newLine;

	


	ToC +=
		"</ul>" +
		"</nav>";

	$(".table-of-contents").prepend(ToC);
	$(".footnotes").prepend("<h5>References</h5>");


	/* TOOLTIP */
	$(".tooltip").hover(function() {
		$('.tooltip-content', this).stop().fadeIn(700);
	}, function() {
		$('.tooltip-content', this).stop().fadeOut(700);
	});
});