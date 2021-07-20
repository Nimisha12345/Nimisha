<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css-vc.css">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Bootstrap 4 Bordered Table</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<style type="text/css">
.bs-example{
margin: 20px;
}
</style>
<script type="text/javascript">
$(document).ready(function(){
$('[data-toggle="tooltip"]').tooltip();   
});
</script>
<style>

</style>
</head>
<body>
    <div class="bs-example">
<div class="container">
     <div class="body">
         

<div class="row">
<div class="col-md-12">
<div class="page-header clearfix">
<h2 class="text-center">Customers List</h2>
</div>

<?php
include_once 'config/database_connect.php';
$result = mysqli_query($conn,"SELECT * FROM customers");
//$result2=mysqli_query($conn,"SELECT amount FROM transfers");
?>
<?php
if (mysqli_num_rows($result)!=0) {
?>
<table class="styled-table">
<thead>
    <tr>
<td>Id</td>
<td>Name</td>
<td>Email id</td>
<td>Current balance</td>
<td>Transact</td>
</tr>
</thead>
<tbody>
<?php
$i=0;
while($row = mysqli_fetch_array($result)) {
?>
<tr>
<td><?php echo (isset($row['id']) ? $row['id'] : ''); ?></td>
<td><?php echo (isset($row['nam']) ? $row['nam'] : ''); ?></td>
<td><?php echo (isset($row['email']) ? $row['email'] : ''); ?></td>
<td><?php echo (isset($row['current_balance']) ? $row['current_balance'] : ''); ?></td>
  <style type="text/css">
    	.brand{
    		background: #cbb09c   !important;
    	}
    </style>

<td>
<a href="transfer_money.php?id=<?php echo $row["id"]?>">    
<input style="color:White" type="submit" name="submit" value="Transfer Now" class="btn brand z-depth-0">
</a>
</td>

</tr>
<?php
$i++;
}
?>
</tbody>
</table>
<?php
}
else{
echo "No result found";
}
?>
</div>
</div>        
</div>

     </div>
</div>
</div>

</body>
</html>