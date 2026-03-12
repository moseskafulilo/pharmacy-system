<?php
include 'db.php';

if(!isset($_GET['id'])){
    header("Location: view_medicine.php");
    exit;
}

$id = $_GET['id'];
$res = mysqli_query($conn, "SELECT * FROM medicines WHERE id='$id'");
$row = mysqli_fetch_assoc($res);

if(isset($_POST['update'])){
    $name = $_POST['name'];
    $qty = $_POST['quantity'];
    $buy = $_POST['buy_price'];
    $sell = $_POST['sell_price'];
    $exp = $_POST['expiry'];

    mysqli_query($conn,"UPDATE medicines SET 
        name='$name',
        quantity='$qty',
        buy_price='$buy',
        sell_price='$sell',
        expiry_date='$exp'
        WHERE id='$id'");

    header("Location: view_medicine.php");
    exit;
}
?>

<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
<h2>Edit Medicine</h2>
<form method="POST">
<input type="text" name="name" value="<?php echo $row['name']; ?>" required>
<input type="number" name="quantity" value="<?php echo $row['quantity']; ?>" required>
<input type="number" step="0.01" name="buy_price" value="<?php echo $row['buy_price']; ?>" required>
<input type="number" step="0.01" name="sell_price" value="<?php echo $row['sell_price']; ?>" required>
<input type="date" name="expiry" value="<?php echo $row['expiry_date']; ?>" required>
<button name="update">Update Medicine</button>
</form>
</div>
</body>
</html>
