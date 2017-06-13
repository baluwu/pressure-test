<?php

$dsn = "mysql:host=;dbname=";
try {
    $pdo = new PDO($dsn, '', '', array(PDO::ATTR_PERSISTENT => true));    
} catch (Exception $e) {
    die('连接数据库失败!');    
}

$sql = "SELECT SQL_NO_CACHE a.order_id FROM `order` a WHERE a.order_status = 0 AND a.delivery_status = 0 LIMIT 10"; //SQL语句
$stmt = $pdo->query($sql);
while ($row = $stmt->fetch()) {
    echo "order_id=$row[0]" . '<br />';
}
$pdo = null;
