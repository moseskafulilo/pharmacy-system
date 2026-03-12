<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

// TOTAL MEDICINES
$med = mysqli_query($conn,"SELECT COUNT(*) as total FROM medicines");
$med_data = mysqli_fetch_assoc($med);

// TOTAL SALES
$sales = mysqli_query($conn,"SELECT SUM(total) as total_sales FROM sales");
$sales_data = mysqli_fetch_assoc($sales);

// LOW STOCK
$low = mysqli_query($conn,"SELECT * FROM medicines WHERE quantity < 10");

?>
<!DOCTYPE html>
<html>
<head>

<title>Pharmacy Dashboard</title>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>

body{
font-family: Arial;
background:#f4f6f9;
margin:0;
}

.navbar{
background:#2c3e50;
color:white;
padding:15px;
}

.navbar a{
color:white;
margin-right:15px;
text-decoration:none;
}

.container{
padding:20px;
}

.cards{
display:flex;
gap:20px;
margin-bottom:30px;
}

.card{
background:white;
padding:20px;
border-radius:8px;
box-shadow:0 2px 5px rgba(0,0,0,0.1);
flex:1;
text-align:center;
}

table{
width:100%;
border-collapse:collapse;
background:white;
}

th,td{
padding:10px;
border:1px solid #ddd;
}

th{
background:#34495e;
color:white;
}

.low{
color:red;
font-weight:bold;
}

</style>

</head>

<body>

<div class="navbar">

<h2>💊 Pharmacy Management System</h2>

<a href="dashboard.php">Dashboard</a>
<a href="add_medicine.php">Add Medicine</a>
<a href="view_medicine.php">View Medicines</a>
<a href="sell.php">Sell</a>
<a href="logout.php">Logout</a>

</div>

<div class="container">

<div class="cards">

<div class="card">
<h3>Total Medicines</h3>
<h1><?php echo $med_data['total']; ?></h1>
</div>

<div class="card">
<h3>Total Sales</h3>
<h1><?php echo $sales_data['total_sales']; ?> TZS</h1>
</div>

</div>

<h2>📊 Sales Chart</h2>

<canvas id="myChart"></canvas>

<script>

const ctx = document.getElementById('myChart');

new Chart(ctx,{
type:'bar',
data:{
labels:['Sales'],
datasets:[{
label:'Total Sales',
data:[<?php echo $sales_data['total_sales']; ?>]
}]
}
});

</script>

<br><br>

<h2>⚠ Low Stock Medicines</h2>

<table>

<tr>
<th>Medicine</th>
<th>Quantity</th>
<th>Expiry Date</th>
</tr>

<?php

while($row = mysqli_fetch_assoc($low)){

?>

<tr>

<td><?php echo $row['name']; ?></td>

<td class="low">
<?php echo $row['quantity']; ?>
</td>

<td>
<?php echo $row['expiry_date']; ?>
</td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>
