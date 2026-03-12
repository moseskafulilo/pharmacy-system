<?php
include 'db.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    mysqli_query($conn, "DELETE FROM medicines WHERE id='$id'");
}

header("Location: view_medicine.php");
exit;
?>
