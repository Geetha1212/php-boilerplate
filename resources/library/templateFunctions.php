<?php
    $configs = "";
    if (strcasecmp(getenv('CUSTOM_ENV_VALUE'), "PRODUCTION") == 0) {
      echo "<div id=\"env-container\" class=\"hidden\">\n" . getenv('CUSTOM_ENV_VALUE') ."</div>\n";
       require_once(realpath(dirname(__FILE__) . "/../config-prod.php"));
       $configs = include(realpath(dirname(__FILE__) . "/../config-prod.php"));
    } else {
      echo "<div id=\"env-container\" class=\"hidden\">\n Non-prod " . getenv('CUSTOM_ENV_VALUE') ." </div>\n";
     require_once(realpath(dirname(__FILE__) . "/../config-default.php"));
     $configs = include(realpath(dirname(__FILE__) . "/../config-default.php"));
    }

    function renderLayoutWithContentFile($contentFile, $variables = array())
    {
        $contentFileFullPath = TEMPLATES_PATH . "/" . $contentFile;

        // making sure passed in variables are in scope of the template
        // each key in the $variables array will become a variable
        if (count($variables) > 0) {
            foreach ($variables as $key => $value) {
                if (strlen($key) > 0) {
                    ${$key} = $value;
                }
            }
        }


        require_once(TEMPLATES_PATH . "/header.php");


        echo "</div>\n<div id=\"main-container\" class=\"container\">\n"
           . "\t<div id=\"mainContent\" class=\"col-md-9\">\n";

        if (file_exists($contentFileFullPath)) {
            require_once($contentFileFullPath);
        } else {
            /*
                If the file isn't found the error can be handled in lots of ways.
                In this case we will just include an error template.
            */
            require_once(TEMPLATES_PATH . "/error.php");
        }
        global $configs;
        print_r ($configs["db"]["db1"]["host"]);
        // close content div and open right bar
        echo "\t</div>\n<div class=\"col-md-3\">\n";

        require_once(TEMPLATES_PATH . "/rightPanel.php");

        // close container div
        echo "</div>\n</div>\n";
        // echo $config
        require_once(TEMPLATES_PATH . "/footer.php");
    }
?>
