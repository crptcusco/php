<?php 
$site = 'work';

if ($site == 'house') {
    define('HOST','localhost');
    define('DB_USER','root');
    define('DB_0','allemant01');
    define('DB_1','allemant02');
    define('DB_2','allemant03');
    define('DB_PASS','admin');    
} elseif($site == 'work') {
    define('HOST','localhost');
    define('DB_USER','root');
    define('DB_0','allemant02');
    define('DB_1','dev01');
    define('DB_2','dev02');
    define('DB_PASS','allemant');    
}





?>