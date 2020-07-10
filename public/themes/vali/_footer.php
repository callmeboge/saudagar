<!-- Javascripts-->
  <?php

    echo Template::block('script_tag');
    echo Assets::js();

  ?>
   <script>
  // un/show password with eye toggle
    $('.input-group-addon').click(function(){

      var inputType = $('input[name="password"]'), 
          iconClass = $(this).children('i')

      if (inputType.attr('type') == 'password'){
          iconClass.addClass('fa-eye-slash')
          inputType.attr('type', 'text')
      }else{
          iconClass.removeClass('fa-eye-slash')
          inputType.attr('type', 'password')
      }

    })
  </script>
  </body>
</html>