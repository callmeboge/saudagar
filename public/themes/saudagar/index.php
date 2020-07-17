<!DOCTYPE html>
<html>
<?php

  echo Template::theme_View('_header');

?>
<body>
<?php

    echo Template::theme_View('_sitenav'); 
<<<<<<< HEAD
=======

    echo isset($content) ? $content : Template::content();
    
>>>>>>> b3dc2be6e291ca866da318c748b02e0c5f388f04
    echo Template::theme_View('_footer');

?>
</body>
</html>