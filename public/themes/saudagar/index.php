<!DOCTYPE html>
<html>
<?php

  echo Template::themeView('header');

?>
<body>
<?php

    echo Template::themeView('sitenav'); 

    echo isset($content) ? $content : Template::content();
    
    echo Template::themeView('footer');

?>
</body>
</html>
