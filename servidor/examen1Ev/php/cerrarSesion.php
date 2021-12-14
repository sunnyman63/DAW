<?php

    session_start();
    session_unset();
    session_destroy();
    setcookie(session_name(),123,time()-1000);
    header("Location: ../index.html");

?>