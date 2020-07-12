$(document).ready(function(){
  // $(".flex-container .item-flex:first-child").addClass('grid-thumb-big');
  // $(".flex-container .item-flex + .item-flex").addClass('grid-thumb-medium');
  $(".item:first, li[data-target='#carousel-example-generic']:first").addClass('active');
  $("#carousel-example-generic").carousel({interval: 3000});

    var $allVideo = $('iframe[src*="www.youtube.com"], iframe[src*="docs.google.com"], iframe[src*="www.facebook.com"], iframe[src*="www.google.com"]'),
        $fluidEle = $('.isi-berita, .main-video, #row, #maps');

    $allVideo.each(function(){
      $(this).attr('data-aspectratio', this.height / this.width).removeAttr('height').removeAttr('width');
    });

    $(window).resize(function(){
      var newWidth = $fluidEle.width();

      $allVideo.each(function(){
        var $el = $(this);
        $el.width(newWidth).height(newWidth * $el.attr('data-aspectratio'));
      });
    }).resize();
    
    $("#scroll-fixed").scrollToFixed({
      marginTop: function(){
        var marginTop = $(window).height() - $("#scroll-fixed").outerHeight(true) - 20;
        if(marginTop >= 0) return 20;
        return marginTop;
        },
      limit: function(){
        return $('footer').offset().top - $('#scroll-fixed').outerHeight(true) - 100;
      },
      unfixed: function(){$("#scroll-fixed").css({
        left: 30,
        top: $('footer').offset().top - $('#scroll-fixed').outerHeight(true) - 500
      })}
    })

    $("#ads_news").scrollToFixed({
      marginTop: 10,
      limit: function(){
        return $('.tagline').offset().top - $(this).height();
      },
      fixed: function(){
        $('#ads_news').css('width', 160);
        $('#ads_news').next().css({
          float: 'left',
          width: 'auto'
        });
      },
      unfixed: function(){
        $('#ads_news').css({
          float: 'right',
          width: 160,
          left: 613,
          top: function(){
            return $('.tagline').offset().top - $(this).height() - 280 ;
          }
        });
      }
    });
    
    $(".main-menu").hover(function(){
      $(this).find('.menu-show').stop(true, true).delay(200).fadeIn(500);},
      function(){$(this).find('.menu-show').stop(true, true).delay(200).fadeOut(500);}
    );
    $('.go-top').click(function(event) {
      event.preventDefault();
      $('html, body').animate({scrollTop: 0}, 300);
    });

    $('.isi-berita img').each(function(){
      var _replace = $(this).attr('src');

      $(this).after(function(){
        var alt = $(this).attr('alt');
        return "<div class='caption-foto'>"+ alt +"</div>";
      });
      $(this).parent().attr({
        'class': 'item',
        'data-src': $(this).attr('src'),
        'data-exthumbimage': _replace.replace('img_body', 'img_body/.thumbs')
        });

    })

    $('.isi-berita').lightGallery({
      download: false,
      actualSize: false,
      autoplayControls: false,
      selector: '.item',
      toogleThumb: false,
      exThumbImage: 'data-exthumbimage'
    });

    $('.lazy').lazy();

    // alert('INI SUDAH Dijalankan');
  });
