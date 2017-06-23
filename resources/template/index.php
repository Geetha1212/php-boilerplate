<?php
    if (strcasecmp(getenv('CUSTOM_ENV_VALUE'), "PRODUCTION") == 0) {
      echo "<div id=\"env-container\" class=\"hidden\">\n" . getenv('CUSTOM_ENV_VALUE') ."</div>\n";
       require_once(realpath(dirname(__FILE__) . "/../config-prod.php"));
    } else {

      echo "<div id=\"env-container\" class=\"hidden\">\n Non-prod " . getenv('CUSTOM_ENV_VALUE') ." </div>\n";
     require_once(realpath(dirname(__FILE__) . "/../config-default.php"));
    }
    //

    require_once(LIBRARY_PATH . "/templateFunctions.php");

    /*
        Now you can handle all your php logic outside of the template
        file which makes for very clean code!
    */

    $setInIndexDotPhp = "Hey! I was set in the index.php file.";

    // Must pass in variables (as an array) to use in template
    $variables = array(
        'setInIndexDotPhp' => $setInIndexDotPhp
    );
    // echo "The value of Environment Name  retrieved is " . getenv('GAURI_ENV');
    renderLayoutWithContentFile("home.php", $variables);

?>
