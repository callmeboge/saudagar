<?php

  echo theme_view('_header');

?>
  <body>
  <?php

    echo Template::content();
    echo theme_view('_footer');