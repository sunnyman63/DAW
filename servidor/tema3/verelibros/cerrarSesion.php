<?php
    session_start();
    $_SESSION = [];
    setcookie(session_name(),123,time()-10000);
    session_destroy();
    header("Location: index.php");
?>