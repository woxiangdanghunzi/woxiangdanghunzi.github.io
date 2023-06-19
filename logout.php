<?php
    foreach ($_COOKIE as $key => $value) {
        setcookie($key, '', time() - 3600, '/');
    }
    echo "<script>location.href='login.php';</script>";
?>