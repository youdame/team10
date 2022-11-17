<!--홍진서-->
<?php
header('Content-Type: text/html; charset=UTF-8');
?>
<?php
session_start();
session_destroy();
echo "<script>location.href='main.php';</script>";
?>