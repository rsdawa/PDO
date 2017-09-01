<!doctype html>
<html>
 <head>
  <meta charset="UTF-8">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <title>Document</title>
 </head>
 <body>
 <?php
 // 演示pdo的预处理语法
$dsn = 'mysql:host=localhost;port=3306;dbname=php39';
 $opt = array(PDO :: MYSQL_ATTR_INIT_COMMAND => 'set names utf8');
 $user = 'root';
 $pass = 'root';
 $pdo = new pdo($dsn, $user, $pass, $opt);

// 占位符形式
$arr = array(24, 25, 26, 27, 28);
 $sql = "select * from user_list where user_id = ?"; //占位符形式
 $result = $pdo -> prepare($sql); //对SQL语句预处理，提高执行效率
 foreach($arr as $value) {
    // 给第一个问号赋值为$value
    $result -> bindValue(1, $value);
     // 如果有第二个问题，可以继续：
    // $result->bindValue(2,$v2);
    $result -> execute(); //执行该sql语
     $rec = $result -> fetch(PDO :: FETCH_ASSOC);
     echo "<br>";
     print_r($rec);
     } 

// 命名参数形式
$sql2 = "select * from user_list where age = :v1 and edu = :v2"; //变量前面必须加冒号
$result2 = $pdo -> prepare($sql2);
// 给命名参数赋值
$result2 -> bindValue(":v1", 23);
$result2 -> bindValue(":v2", '大学');
$result -> execute();
$rec = $result -> fetch(PDO :: FETCH_NUM);
echo "<br>";
print_r($rec);
?>  
 </body>
</html>
