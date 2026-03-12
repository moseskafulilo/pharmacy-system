<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user'])){
    header("Location: login.php");
}

if(isset($_POST['sell'])){
    $medicine_id = $_POST['medicine'];
    $qty = $_POST['quantity'];

    $med = mysqli_fetch_assoc(mysqli_query($conn,
        "SELECT * FROM medicines WHERE id='$medicine_id'"));

    if($qty > $med['quantity']){
        $error = "Not enough stock!";
    } else {

        $total = $med['sell_price'] * $qty;
        $profit = ($med['sell_price'] - $med['buy_price']) * $qty;

        mysqli_query($conn,"INSERT INTO sales (medicine_id,total,profit)
            VALUES('$medicine_id','$total','$profit')");

        mysqli_query($conn,"UPDATE medicines 
            SET quantity=quantity-$qty 
            WHERE id='$medicine_id'");

        $success = "Sale Completed! Total: $total | Profit: $profit";
    }
}
?>

<link rel="stylesheet" href="style.css">

<div class="container">

<h2>💊 Sell Medicine</h2>

<?php if(isset($error)){ ?>
<div style="background:#f8d7da; padding:10px; 
            border-radius:5px; color:#721c24; 
            margin-bottom:15px; text-align:center;">
    <?php echo $error; ?>
</div>
<?php } ?>

<?php if(isset($success)){ ?>
<div style="background:#d4edda; padding:10px; 
            border-radius:5px; color:#155724; 
            margin-bottom:15px; text-align:center;">
    <?php echo $success; ?>
</div>
<?php } ?>

<form method="POST">

<label>Select Medicine</label>
<select name="medicine" required>
<option value="">-- Choose Medicine --</option>
<?php
$res = mysqli_query($conn,"SELECT * FROM medicines WHERE quantity > 0");
while($row=mysqli_fetch_assoc($res)){
    echo "<option value='".$row['id']."'>".$row['name']." (Stock: ".$row['quantity'].")</option>";
}
?>
</select>

<label>Quantity</label>
<input type="number" name="quantity" placeholder="Enter quantity" required>

<br>
<button name="sell">🧾 Complete Sale</button>

</form>

<br>

<a href="dashboard.php">⬅ Back to Dashboard</a>

</div>
