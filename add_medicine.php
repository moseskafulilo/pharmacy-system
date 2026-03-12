<?php
include 'db.php';

if(isset($_POST['add'])){
    $name = $_POST['name'];
    $qty = $_POST['quantity'];
    $buy = $_POST['buy_price'];
    $sell = $_POST['sell_price'];
    $exp = $_POST['expiry'];

    mysqli_query($conn,"INSERT INTO medicines (name,quantity,buy_price,sell_price,expiry_date) 
        VALUES('$name','$qty','$buy','$sell','$exp')");

    $success = "Medicine added successfully!";
}
?>

<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
<h2>Add Medicine</h2>

<?php if(isset($success)){echo "<p style='color:green;'>$success</p>";} ?>

<form method="POST">
<input type="text" name="name" placeholder="Medicine Name" required>
<input type="number" name="quantity" placeholder="Quantity" required>
<input type="number" step="0.01" name="buy_price" placeholder="Buying Price" required>
<input type="number" step="0.01" name="sell_price" placeholder="Selling Price" required>
<input type="date" name="expiry" required>
<button name="add">Add Medicine</button>
</form>

<a href="dashboard.php">Back to Dashboard</a>
</div>
</body>
</html>
