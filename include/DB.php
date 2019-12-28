<?php
$Connection=mysqli_connect('localhost', 'djener', '11111111','dpgcl');
//$ConnectionDB=mysqli_select_db($Connection, 'dpgcl');
if (!$Connection) {
    echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
    echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
//echo "Соединение с MySQL установлено!" . PHP_EOL;
//echo "Информация о сервере: " . mysqli_get_host_info($Connection) . PHP_EOL;

//mysqli_close($Connection);
//mysqli_connect_error();
//mysqli_connect_errno();
?>