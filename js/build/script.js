// Les variable de travail
    detectObjectArray = [];
// Le mode debug affiche les console.log
    debugMode = 0;
// Si la page est en edit mode
    editMode = $('body').is('.edit-mode');



$(document).ready(function(){
// Le loader
    NProgress.configure({trickleRate: .5, trickleSpeed: 1000});
    NProgress.start();
// Le parallax du header
    parallaxHandler();
// Le breadcrumb
    $("#jquery_breadcrumb").rcrumbs();

    detectOnView();

// Les masonery
    launchMasonry();

// Le breakpoint.js
    $(window).setBreakpoints();
// Maintenant comme référence pour fixer le menu,
// On prend le premier sous-header, sinon le deuxième, sinon le contenu principal
    var nav = $('.top-bar');
    var m1 = $('#sub-header-1');
    var m2 = $('#sub-header-2');
    var m = $('.main-container');
    var main = m1.size() ? m1 : (m2.size() ? m2 : m);
    var b = nav.height() + parseInt(nav.css('top'),10);
    var mainWatch = scrollMonitor.create(main,{top:b});
    mainWatch.stateChange(function() {
        nav.toggleClass('fixedtop', this.isAboveViewport);
    });
    // le démarrer manuelement si la page est chargé en plein milieu
    var i = $('.intro');
    if(i.height() < $(window).scrollTop())  nav.addClass('fixedtop') ;

// Met en gras les element dans des header :
    $('h1:has(b,strong,em),h2:has(b,strong,em),h3:has(b,strong,em)').addClass('change-wheight');

// Le Video BG
    var headerVideo = $("#mb_YTPlayer");
    if(headerVideo.size()) {
      // Le cript a besoin que le container ai une position definie.
      var $videoContainer = $('article.intro');
      $videoContainer.css('height', $videoContainer.height() + 'px');
      // Initialisation du script
      headerVideo.mb_YTPlayer();
    }

// Le bouton qui failt glisser la page en full header
    $('.gotobottom').on('click', function(){
        $("body").animate({ scrollTop: i.height()-nav.height() }, "slow");
    });

// Les accordions
    $('.anitya-accordion').each(function(){
        var titles = $(this).find('.title');

        titles.not('.active').each(function(){$(this).next('.content').hide()});

        titles.click(function(e){
            e.preventDefault();
            var title = $(this);
            if (title.is('.active')) return;

            var accordion = title.parent().parent();
            accordion.find('.title.active').removeClass('active');
            accordion.find('.content.active').slideUp().removeClass('active');

            title.addClass('active');
            title.next(".content").slideDown().addClass('active');
        });
    });

    if(!editMode) {
// Les Tabs 
          initializeTabs();

// Les parallax
        $('.grid-overlay').wrapInner('<div class="area-wrap" />');
        $('.area-wrap').prepend('<div class="pattern" />');
        $('.grid-overlay').attr('data-stellar-background-ratio','.5');
        $(window).stellar();

// Les hauteurs égales par classes css
        setHeightClass();

// Les sliders
        $('.slick').slick({
              dots: true,
              infinite: false,
              slidesToShow: 3,
              slidesToScroll: 3,
              adaptiveHeight: true,
              respondTo:'slider',
              responsive: [
                {
                  breakpoint: 1024,
                  settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                  }
                },
                {
                  breakpoint: 600,
                  settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                  }
                },
                {
                  breakpoint: 480,
                  settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                  }
                }
              ]
        });

    }

// -- Seulement pour que les images svg prennent la couleur
    jQuery('.svg-primary img, .svg-quaternary img').each(function(){
        var $img = jQuery(this);
        var imgID = $img.attr('id');
        var imgClass = $img.attr('class');
        var imgURL = $img.attr('src');

        jQuery.get(imgURL, function(data) {
            // Get the SVG tag, ignore the rest
            var $svg = jQuery(data).find('svg');

            // Add replaced image's ID to the new SVG
            if(typeof imgID !== 'undefined') {
                $svg = $svg.attr('id', imgID);
            }
            // Add replaced image's classes to the new SVG
            if(typeof imgClass !== 'undefined') {
                $svg = $svg.attr('class', imgClass+' replaced-svg');
            }

            // Remove any invalid XML tags as per http://validator.w3.org
            $svg = $svg.removeAttr('xmlns:a');

            // Replace image with new SVG
            $img.replaceWith($svg);

        }, 'xml');

    });

 // Dupliquerl le logo dans la barre de navigation mobile
    var responsiveLogoContainer = $('#responsive_logo a');
    var logo = $('.an .logo');

    if(responsiveLogoContainer.size() && logo.size()) {
        responsiveLogoContainer.html(logo.html());
        $('#responsive_logo').find('.replaced-svg').removeClass('replaced-svg');
    }

})
$(window).load(function() {
    NProgress.done();
    $('.an').addClass('loaded');
    l('document loaded');
})

function parallaxHandler () {
    var nav = $('#top-nav');
    var intro = $('#intro-content');
    $(window).scroll(function(i){
        var scrollVar = $(window).scrollTop();
        intro.css({'top': .7*scrollVar });
    })
};


function launchMasonry() {
    l('launch masonry');
    var $container = $('.masonry');
    // initialize
    $container.each(function(){
        $c = $(this);
        $c.imagesLoaded(function(){
            $c.masonry({
                columnWidth:'.grid-sizer',
                itemSelector: '.item'
            });
        })

    });
};

function initializeTabs () {
    $(".tabs-menu a").click(function(event) {
        event.preventDefault();
        $(this).parent().addClass("current");
        $(this).parent().siblings().removeClass("current");
        var tab = $(this).attr("href");
        $(".tab-content", $(this).parent().parent().parent() ).not(tab).css("display", "none");
        $(tab).fadeIn();
    });
}

// -- Ajoute la classe 'view' sur les element '.detect' une fois qu'il arrive dans le viewport -- \\
function detectOnView () {
    l('launch detectOnView');
    $('.detect').each(function(i){
        var $e = $(this);
        var detectWatch = scrollMonitor.create($e);
        detectObjectArray.push(detectWatch);
        var rand = Math.random() * 200;
          detectWatch.exitViewport(function() {
            $e.removeClass('view');
          });
          detectWatch.enterViewport(function() {
            setTimeout(function(){
              $e.addClass('view');
            },rand);
          });
      });
}

// -- Detruit les observateurs (utilisé pour les mobiles) -- \\
function destroyDetectOnView () {
    l('launch destroyDetectOnView');
    // On rend tous les elements visibles
    $('.detect').each(function(i){$(this).addClass('view')});
    // et on detruit les eénement qui leurs sont liés
    $(detectObjectArray).each(function(e){this.destroy()});
}

function setHeightClass() {
    jQuery('div:regex(class,height-custom-[0-9])').each(function () {
        reg = new RegExp("height-([0-9]+)", "gi");
        height = reg.exec(jQuery(this).attr('class'));
        height = height[0].replace(/height-/i, '');
        jQuery(this).css('min-height', parseInt(height)).addClass('height-resized');
    });

}
/*
    jQuery regex from http://www.jquery.info/spip.php?article91

*/
jQuery.expr[':'].regex = function (elem, index, match) {
    if (match) {
        var matchParams = match[3].split(','),
            validLabels = /^(data|css):/,
            attr = {
                method: matchParams[0].match(validLabels) ? matchParams[0].split(':')[0] : 'attr',
                property: matchParams.shift().replace(validLabels, '')
            }, regexFlags = 'ig';
        regex = new RegExp(matchParams.join('').replace(/^\s+|\s+$/g, ''), regexFlags);
        return regex.test(jQuery(elem)[attr.method](attr.property));
    }
}


$(window).bind('enterBreakpoint320',function() {
    l('Entering 320 breakpoint');
    // launchMasonry(1);
    destroyDetectOnView();
});

$(window).bind('enterBreakpoint480',function() {
 l('Entering 480 breakpoint');
    // launchMasonry(2);
    destroyDetectOnView();
});
$(window).bind('enterBreakpoint768',function() {
 l('Entering 768 breakpoint');
    // launchMasonry(2);
    detectOnView();
});

$(window).bind('enterBreakpoint1024',function() {
    l('Entering 1024 breakpoint');
    // launchMasonry(3);
    detectOnView();
});



// -- Responsive navigation -- \\
(function() {
    var container = $( 'div.ccm-page' ),
        triggerBttn = $('#hamburger-icon'),
        overlay = $( '.overlay' ),
        closeBttn = $( 'button.overlay-close' );
    function toggleOverlay() {
        if( overlay.is('.open' ) ) {
            overlay.removeClass('open' );
            container.removeClass('overlay-open' );
            triggerBttn.removeClass('active');
        }
        else {
            overlay.addClass('open' );
            container.addClass('overlay-open' );
            triggerBttn.addClass('active');
        }
    }

    triggerBttn.on( 'click', toggleOverlay );
})();

// -- Les log dans la console -- \\
function l(m) {
    if (debugMode) console.log(m)
}
