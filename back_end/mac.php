<?php
    $_IP_SERVER = $_SERVER['SERVER_ADDR'];
    $_IP_ADDRESS = $_SERVER['REMOTE_ADDR'];
    ob_start();
        system('ipconfig /all');
        $_PERINTAH  = ob_get_contents();
        ob_clean();
        $_PECAH = strpos($_PERINTAH, "Physical");
        $_HASIL = substr($_PERINTAH,($_PECAH+36),17);
        echo $_HASIL;  
?>