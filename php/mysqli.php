<?php

$conn = mysqli_connect('', '', '', '');

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
 
mysqli_query($conn, "set names 'utf8'"); 
 
$sql = "SELECT SQL_NO_CACHE a.order_id FROM `order` a WHERE a.order_status = 0 AND a.delivery_status = 0 LIMIT 10";
 
$result = mysqli_query($conn, $sql);

if ($result) {
    printf("Select returned %d rows.\n", mysqli_num_rows($result));
    mysqli_free_result($result);
}

mysqli_close($conn);

?>
