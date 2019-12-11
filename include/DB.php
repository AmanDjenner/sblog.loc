<?php
$link = mysqli_connect('localhost', 'root', '');
if (!$link) {
    die('Ошибка соединения: ' . mysql_error());
}
mysqli_close($link);
?>
