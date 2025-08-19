<?php
$roots_includes = array(
  '/functions/functions_setup.php',
  '/functions/functions_scripts.php',
  '/functions/functions_customizer.php',
  '/functions/functions_rest.php',
  '/functions/functions_admincontrols.php',
);

foreach($roots_includes as $file){
  if(!$filepath = locate_template($file)) {
    trigger_error("Error locating `$file` for inclusion!", E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);