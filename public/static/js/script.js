var Footnotes = {
    footnotetimeout: false,
    setup: function() {
        var footnotelinks = jQuery('[rel=\'footnote\']')

        footnotelinks.unbind('mouseover',Footnotes.footnoteover);
        footnotelinks.unbind('mouseout',Footnotes.footnoteoout);

        footnotelinks.bind('mouseover',Footnotes.footnoteover);
        footnotelinks.bind('mouseout',Footnotes.footnoteoout);
    },
    footnoteover: function() {
        clearTimeout(Footnotes.footnotetimeout);
        jQuery('#footnotediv').stop();
        jQuery('#footnotediv').remove();

        var id = jQuery(this).attr('href').substr(1);
        var position = jQuery(this).offset();

        var div = jQuery(document.createElement('div'));
        div.attr('id','footnotediv');
        div.bind('mouseover',Footnotes.divover);
        div.bind('mouseout',Footnotes.footnoteoout);

        var el = document.getElementById(id);
        div.html('<div>'+jQuery(el).html()+'</div>');

        jQuery(document.body).append(div);

        var left = position.left;
        if(left + 420  > jQuery(window).width() + jQuery(window).scrollLeft())
            left = jQuery(window).width() - 420 + jQuery(window).scrollLeft();
        var top = position.top+20;
        if(top + div.height() > jQuery(window).height() + jQuery(window).scrollTop())
            top = position.top - div.height() - 15;
        div.css({
            left:left,
            top:top,
            opacity:1,
            position: "absolute",
            });
    },
    footnoteoout: function() {
        Footnotes.footnotetimeout = setTimeout(function() {
            jQuery('#footnotediv').animate({
                opacity: 0
            }, 300, function() {
                jQuery('#footnotediv').remove();
            });
        },100);
    },
    divover: function() {
        clearTimeout(Footnotes.footnotetimeout);
        jQuery('#footnotediv').stop();
        jQuery('#footnotediv').css({
                opacity: 1
        });
    },

}



jQuery(document).ready(function() {
  Footnotes.setup();
  var ToC ="<h6>Table of Contents</h6>" +
  "<nav role='navigation'>" +
    "<ul>";

var newLine, el, title, link;

$("article h4").each(function() {

  el = $(this);
  title = el.text();
  link = "#" + el.attr("id");

  newLine =
    "<li>" +
      "<a href='" + link + "'>" +
        title +
      "</a>" +
    "</li>";

  ToC += newLine;

});

ToC +=
   "</ul>" +
  "</nav>";

$(".table-of-contents").prepend(ToC);
$( ".footnotes" ).prepend( "<h5>References</h5>" );
});
