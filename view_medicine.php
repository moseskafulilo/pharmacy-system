<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user'])){
header("Location: login.php");
}

$result = mysqli_query($conn,"SELECT * FROM medicines");
?>

<!DOCTYPE html>
<html>

<head>

<title>Medicines</title>

<link rel="stylesheet" href="style.css">

<style>

.container{
margin-left:240px;
padding:20px;
}

.search{
width:300px;
padding:10px;
margin-bottom:20px;
border-radius:5px;
border:1px solid #ccc;
}

table{
width:100%;
background:white;
border-radius:10px;
overflow:hidden;
box-shadow:0 4px 10px rgba(0,0,0,0.1);
}

th{
background:#2c3e50;
color:white;
}

th,td{
padding:12px;
text-align:center;
}

.btn-edit{
background:#3498db;
padding:6px 10px;
color:white;
border-radius:5px;
text-decoration:none;
}

.btn-delete{
background:#e74c3c;
padding:6px 10px;
color:white;
border-radius:5px;
text-decoration:none;
}

</style>

</head>

<body>

<div class="sidebar">

<h2>Pharmacy</h2>

<a href="dashboard.php">Dashboard</a>
<a href="view_medicine.php">Medicines</a>

<?php if($_SESSION['role']=="admin"){ ?>
<a href="add_medicine.php">Add Medicine</a>
<?php } ?>

<a href="sell.php">Sell Medicine</a>
<a href="logout.php">Logout</a>

</div>

<div class="container">

<h2>💊 Medicines List</h2>

<input class="search" id="search" placeholder="Search medicine...">

<table id="medicineTable">

<tr>
<th>ID</th>
<th>Name</th>
<th>Quantity</th>
<th>Buy Price</th>
<th>Sell Price</th>
<th>Expiry</th>

<?php if($_SESSION['role']=="admin"){ ?>
<th>Action</th>
<?php } ?>

</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['id'] ?></td>

<td><?php echo $row['name'] ?></td>

<td><?php echo $row['quantity'] ?></td>

<td><?php echo $row['buy_price'] ?></td>

<td><?php echo $row['sell_price'] ?></td>

<td><?php echo $row['expiry_date'] ?></td>

<?php if($_SESSION['role']=="admin"){ ?>

<td>

<a class="btn-edit"
href="edit_medicine.php?id=<?php echo $row['id'] ?>">
Edit
</a>

<a class="btn-delete"
href="delete_medicine.php?id=<?php echo $row['id'] ?>">
Delete
</a>

</td>

<?php } ?>

</tr>

<?php } ?>

</table>

</div>

<script>

let search=document.getElementById("search");

search.addEventListener("keyup",function(){

let filter=search.value.toLowerCase();

let rows=document.querySelectorAll("#medicineTable tr");

rows.forEach((row,i)=>{

if(i==0) return;

let text=row.innerText.toLowerCase();

row.style.display=text.includes(filter) ? "" : "none";

});

});

</script>

</body>

</html>
