<?php
$pro_id = $_GET['pro_id'];
require '../connect.php';

$sql = "DELETE FROM products WHERE pro_id = '$pro_id'";
$result = $con->query($sql);

if (!$result) {
    echo "<script>alert('ไม่สามารถลบข้อมูลได้');history.back();</script>";
} else {
    echo "<script>window.location.href='index.php?page=products';</script>";
}
?>
