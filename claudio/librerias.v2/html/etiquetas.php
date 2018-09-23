<?php

class EtiquetasHtml {

    public static $title = '';
    public static $path = '';
    public static $files = '';
    protected static $testing = FALSE;
    
    public static function testing_mode() {
        self::$testing=TRUE;
    }

    // crear 4 funciones: add_css_(header o footer), add_js_(header o footer) 
    // estos llama a: add_file

    static function h($num, $title) {
        printf('<h%s>%s</h%s>'
                , $num
                , $title
                , $num);
    }

    static function header() {
        $files_str = "";
        if (isset(self::$files['header'])) {
            $files_str = self::files(self::$files['header']);
        }

        printf('<!DOCTYPE html>
                <!--[if IE 9]><html class="lt-ie10" lang="en" ><![endif]-->
                <html class="no-js" lang="es" >
                <head>
                  <meta charset="utf-8">
                  <!-- If you delete this meta tag World War Z will become a reality -->
                  <meta name="viewport" content="width=device-width, initial-scale=1.0">
                  <title>%3$s</title>
                  <!-- If you are using the CSS version, only link these 2 files, you may add app.css to use for your overrides if you like -->
                  <link rel="stylesheet" href="%1$s/vendor/normalize.css">
                  <link rel="stylesheet" href="%1$s/vendor/foundation/css/foundation.css">
                  <link rel="stylesheet" href="%1$s/vendor/foundation-icons/foundation-icons.css">
                  <link rel="stylesheet" href="%1$s/main.css?v=1.0">
                  %2$s
                  <script src="%1$s/vendor/modernizr.js"></script>
                </head>
                <body>'
                , self::$path
                , $files_str
                , self::$title
        );
    }

    static function footer() {
        $files_str = "";
        if (isset(self::$files['footer'])) {
            $files_str = self::files(self::$files['footer']);
        }
        if (self::$testing==TRUE)
            self::debug();
        
        printf('
                    <script src="%1$s/vendor/jquery.js"></script>
                    <script src="%1$s/vendor/foundation/js/foundation.min.js"></script>
                    
                    <script>
                      $(document).foundation();
                    </script>
                    %2$s 
                  </body>
                  </html>
                '
                , self::$path
                , $files_str
        );
    }

    protected static function files($array) {
        $output = '';
        if ($array) {
            foreach ($array AS $key => $values) {
                if ($key == 'css') {
                    foreach ($values AS $val) {
                        $output.=sprintf('<link href="%s" rel="stylesheet">', $val);
                    }
                } elseif ($key == 'js') {
                    foreach ($values AS $val) {
                        $output.=sprintf('<script src="%s"></script>', $val);
                    }
                }
            }
        }
        return $output;
    }

    public static function debug() {
        print "
                <style>
                .debug-claudio-printr {
                     background-color: #4F5256;
                     border: 3px solid #373737;
                     color: #F5F1FF;
                     font-family: monospace;
                     font-size: 1.5em;
                     margin: 1em 0;
                     max-height: 280px;
                     overflow: scroll;
                     padding: 1em 0.5em 0;
                }
               </style>
               <script>
                console.log('debug.php--------------------------');
                function c(input)
                {
                  console.log(input);
                }
                function a(input)
                {
                  alert(input);
                }
               </script>            
         ";
    }

    static function printr($imput) {
        print '<pre class="debug-claudio-printr">';
        print_r($imput);
        print '</pre>';
    }

}

?>