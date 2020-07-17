<!DOCTYPE html>
<html>
<?php

  echo Template::themeView('_header');

?>
<body>
<?php

    // echo Template::themeView('_sitenav'); 

    echo isset($content) ? $content : Template::content();
    
    // echo Template::themeView('_footer');

?>
</body>
</html>