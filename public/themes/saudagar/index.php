<!DOCTYPE html>
<html>
<?php

  echo Template::theme_View('_header');

?>
<body>
<?php

    echo Template::theme_View('_sitenav'); 

    echo isset($content) ? $content : Template::content();
    
    echo Template::theme_View('_footer');

?>
</body>
</html>