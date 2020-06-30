  // $('#home-carousel').swipe();
  // $('#loader').fadeOut('slow');
  $(document).ready(function () {
      var $allVideo = $('iframe[src*="www.youtube.com"], iframe[src*="docs.google.com"], iframe[src*="www.facebook.com"], iframe[src*="www.google.com"]'), $fluidEle = $('.box, #row, .isi-halaman, .box-header');

      $allVideo.each(function () {
          $(this).attr('data-aspectratio', this.height / this.width).removeAttr('height').removeAttr('width');
      });

      $(window).resize(function () {
          var newWidth = $fluidEle.width();
          $allVideo.each(function () {
              var $el = $(this);
              $el.width(newWidth).height(newWidth * $el.attr('data-aspectratio'));
          });
      }).resize();
      
      $('.item:first').addClass('active');
      //iklan and tag
      $('.close-headline').click(function (event) {
          event.preventDefault();
          $(this).parents('.headline-text').fadeOut('slow');
      });
      $('.close-iklan').click(function (event) {
          event.preventDefault();
          $(this).parents('.iklan-fixed').fadeOut('slow');
      });
      // Animate the scroll to top
      $('.go-top').click(function (event) {
          event.preventDefault();
          $('html, body').animate({
              scrollTop: 0
          }, 300);
      });

      $(window).scroll(function () {
          if ($(this).scrollTop() > 55) {
              $('#head_fixed').addClass('navbar-fixed-top');
          } else {
              $('#head_fixed').removeClass('navbar-fixed-top');
          }
          // console.log( $(this).scrollTop() );
      })

      $(".navbar-toggle").click(function (event) {
          $("#menuSamping").css('left', '0');
          $(".navbar-toggle").hide();
          $(".tutup").show();
      });
      
      $(".tutup").click(function (event) {
          $("#menuSamping").css('left', '-100%');
          $(".tutup").hide();
          $(".navbar-toggle").show();
      });
      
      $('.berita img').each(function(){
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
            

      $('.berita').lightGallery({
        download: false,
        actualSize: false,
        autoplayControls: false,
        selector: '.item',
        toogleThumb: false,
        exThumbImage: 'data-exthumbimage'
            });
            
			
			$('.lazy').lazy(); //initial library lazy() for lazy image container
			
    });