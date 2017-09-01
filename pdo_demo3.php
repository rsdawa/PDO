<?php
// 演示PDO结果集对象PDOStatement的使用
$dsn = 'mysql:host=localhost;port=3306;dbname=php39';
$opt = array(PDO :: MYSQL_ATTR_INIT_COMMAND => 'set names utf8');
$user = 'root';
$pass = 'root';
$pdo = new pdo($dsn, $user, $pass, $opt);

$sql1 = "select user_id,user_name,user_pass from user_list";
$result1 = $pdo -> query($sql1);
$arr1 = $result1 -> fetchAll(PDO :: FETCH_ASSOC);
echo '<pre>';
print_r($arr1);
echo '</pre>';

$sql2 = "select user_id,user_name,user_pass from user_list where user_id=25";
$result2 = $pdo -> query($sql2);
$arr2 = $result2 -> fetch();
echo '<pre>';
print_r($arr2);
echo '</pre>';


$sql3 = "select user_id,user_name,user_pass from user_list where user_id=25";
$result3 = $pdo -> query($sql3);
$user_id = $result3 -> fetchColumn(0);
$user_name = $result3 -> fetchColumn(1);
$user_pass = $result3 -> fetchColumn(2);
echo "user_id:{$user_id}<br>user_name:{$user_name}<br>user_pass:{$user_pass}"; //结果只显示user_id
// fetch执行一次，游标则下移一行。
// fetchColumn()较为适合取单个数据的情况。
?>  