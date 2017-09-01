<?php
$dsn = 'mysql:host=localhost;port=3306;dbname=php39';
$opt = array(PDO :: MYSQL_ATTR_INIT_COMMAND => 'set names utf8');
$user = 'root';
$pass = 'root';
$pdo = new pdo($dsn, $user, $pass, $opt);

// 增删改语句：$pdo->exec($sql) 出错时返回false, 正常时根据影响记录数返回>=0的数字
// 返回数据集: $pdo->query($sql)
$result = $pdo -> exec('delete from user_list where user_id=17'); //有此记录时返回1,否则返回false
var_dump($result);
$result = $pdo -> query('select * from user_list');
var_dump($result);
/**
* PDO结果集对象常用方法：
* 
* $stmt = $pdo->query(“select ...... ”);//这是获得结果集
* $stmt->rowCount() ; //行数
* $stmt->columnCount() ; //列数
* $stmt->fetch( [返回类型] ); //返回类型常用的有：
* PDO::FETCH_ASSOC：表示关联数组
* PDO::FETCH_NUM：表示索引数组
* PDO::FETCH_BOTH：表示前二者皆有，这是默认值
* PDO::FETCH_OBJ：表示对象
* $stmt->fetchAll([返回类型]);
* $stmt->fetchColumn( [$i] ); //取出指定列（$i）的数据
* $stmt->fetchObject();
* $stmt->errorCode(); //静默模式下返回错误代号
* $stmt->errorInfo(); //静默模式下返回错误信息
* $stmt->closeCursor(); //关闭结果集，清理资源
*/

$arr = array();
$mode = PDO :: FETCH_ASSOC;
/**
* mode 参数可取值如下：
* 取值                说明
* PDO::FETCH_ASSOC    关联索引（字段名）数组形式
* PDO::FETCH_NUM      数字索引数组形式
* PDO::FETCH_BOTH     默认，关联及数字索引数组形式都有
* PDO::FETCH_OBJ      按照对象的形式
* PDO::FETCH_BOUND    通过 bindColumn() 方法将列的值赋到变量上
* PDO::FETCH_CLASS    以类的形式返回结果集，如果指定的类属性不存在，会自动创建
* PDO::FETCH_INTO     将数据合并入一个存在的类中进行返回
* PDO::FETCH_LAZY     结合了 PDO::FETCH_BOTH、PDO::FETCH_OBJ，在它们被调用时创建对象变量
* 
* 如果不在 fetch() 中指定返回的结果类型，也可以单独使用 setFetchMode() 方法设定，如：
* ......
* $sth = $db->query($sql);
* $sth->setFetchMode(PDO::FETCH_ASSOC);
* while($row = $result->fetch()){
* ......
* }
*/
// $result->fetch()方法，从结果集中获取一行结果
while ($a = $result -> fetch($mode)) {
    $arr[] = $a;
     } 

header('content-type:text/html;charset=utf8');

echo "<pre>";
var_dump($arr);
echo "</pre>";

/**
* PDOStatement->fetchAll()
* fetchAll() 方法用于把数据从数据集一次性取出并放入数组中。

* 语法：
* PDOStatement->fetchAll([int mode [,int column_index]])
* 
* mode 为可选参数，表示希望返回的数组，column_index 表示列索引序号，当 mode 取值 PDO::FETCH_COLUMN 时指定。
* mode 参数可取值如下：
* 取值                 说明
* PDO::FETCH_COLUMN    指定返回返回结果集中的某一列，具体列索引由 column_index 参数指定
* PDO::FETCH_UNIQUE    以首个键值下表，后面数字下表的形式返回结果集
* PDO::FETCH_GROUP     按指定列的值分组

* 例子：
*/
$result = $pdo -> query('select * from user_list');
$row = $result -> fetchAll();
echo "<hr><pre>";
var_dump($row);
echo "</pre>";

// 只返回 username（index=1）
$result = $pdo -> query('select * from user_list');
$row = $result -> fetchAll(PDO :: FETCH_COLUMN, 1);
echo "<hr><pre>";
var_dump($row);
echo "</pre>";

// 将 username GROUP 返回（注：由于表中 username 无重复记录，因此本例无意义）
$result = $pdo -> query('select * from user_list');
$row = $result -> fetchAll(PDO :: FETCH_COLUMN | PDO :: FETCH_GROUP, 1);
echo "<hr><pre>";
var_dump($row);
echo "</pre>";

// 断开连接
$dbo = null;