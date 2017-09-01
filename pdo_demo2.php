<?php
// pdo应用事物及错误处理
/**
PDO::lastInsertId() — 返回最后插入行的ID或序列值
PDO::beginTransaction() — 启动一个事务
PDO::commit() — 提交一个事务
PDO::rollBack() — 回滚一个事务
PDO::setAttribute(属性名,属性值) — 设置属性
*/

// 开启事务
$pdo -> beginTransaction();

// 执行相关语句
$pdo -> exec($sql1);
$pdo -> exec($sql2);

// 错误判断和处理
if (没有错误) {
    $pdo -> commit();
     } else {
    $pdo -> rollBack();
     } 

// pdo错误处理模式：

// 静默模式：错误发生后，并不产生错误提示或输出，而是需要“人为”通过代码获取，并判断处理:
$pdo -> exec($sql);
//获取前一次执行sql语句的错误代号，0为无错
$Code = $pdo -> errorCode(); 
if ($Code == 0) {
    echo "执行成功";
     } else {
    $info = $pdo -> errorInfo[2];
     // 返回错误信息，数组类型。errorInfo[2]为错误信息
    echo "执行失败，参考错误信息:" . $info;
     } 


// 异常模式：
try {
    // pdo执行的语句,一旦出错就进行catch范围语句
    $pdo -> exec($sql);    
     } 
catch(Exception $e) {
    // try范围发生错误后，执行此处
    // $e是一个记录错误信息的对象
    echo "执行失败，参考错误信息:" . $e -> getMessage();
     } 
