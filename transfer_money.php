<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css-tm2.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style>
.dropbtn {
  background-color: #4CAF50;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown:hover .dropbtn {
  background-color: #3e8e41;
}
td {
  font-size: 40px;
}
</style>
</head>

<?php
include('config/database_connect.php');
if(isset($_POST['submit']))
{	

        	$s = $_GET['id'];
			$r = $_POST['r'];
	        $amount = $_POST['amount'];
	       
	$sql1="SELECT * from customers where id=$s";
	$query=mysqli_query($conn,$sql1);
	if(!$query){
		echo 'Error:query1';
	}
	$sql2=mysqli_fetch_array($query);
	
	$sql3="SELECT * FROM customers WHERE id=$r";
		$query=mysqli_query($conn,$sql3);
		if(!$query){
			echo 'Error:query2';
		}
		$sql4=mysqli_fetch_array($query);
	
	if(($amount) < 0){
		echo '<script>';
        echo ' alert("Negative amount is not acceptable.")';  // showing an alert box.
        echo '</script>';
	}
	elseif(($amount) ==0 ){
		echo '<script>';
        echo ' alert("Zero amount is not acceptable.")';  // showing an alert box.
        echo '</script>';
			}
	elseif( $amount > $sql2['current_balance']){

        echo" <script> alert('Amount is exceeding maximum limit');
			 
			 </script> ";
	}
    else{
		

		$sender=$sql2['nam'];
        $receiver=$sql4['nam'];
 
		$current_balance1=$sql2['current_balance'] - $amount;
		 $sql5="UPDATE customers set current_balance=$current_balance1 WHERE id=$s";
         mysqli_query($conn,$sql5);

		 $current_balance2=$sql4['current_balance'] + $amount;
         $sql6="UPDATE customers set current_balance=$current_balance2 WHERE id=$r";
         mysqli_query($conn,$sql6);



	     $sql7="INSERT INTO transfers(sender,receiver,amount) VALUES('$sender','$receiver','$amount')";
		 $query=mysqli_query($conn,$sql7);
		 if($query)
		 {
			 echo" <script> alert('Transaction Successful');
			 window.location='index.html';
			 </script> ";
		 }

		 $current_balance1=0;
		 $current_balance2=0;
		 $amount=0;
	}

}
?>

<body>
<div class='container'>
<div class="bg">
    <div class="card mx-auto col-md-5 col-8 mt-3 p-0"> <img class='mx-auto pic' src="images/flaticon-svg/svg/transfer_money.png" />
        <div class="card-title d-flex px-4">
            <p class="item text-muted">Transfer Money<label class="register">&reg;</label> </p>
        </div>


         <div class="card-body">
         <div class="center">
             <p class="text-muted">Your payment details</p>	           
         </div>
            		 <?php
			include('config/database_connect.php');
			if (isset($_REQUEST['id'])) {
				$sid = $_GET['id'];
			$sql8="SELECT * FROM customers WHERE id=$sid";
			$result=mysqli_query($conn,$sql8);
			if (!$result) {
                echo "Error : " . $sql8 . "<br>" . mysqli_error($conn);
            }
			$rows=mysqli_fetch_assoc($result);
		}
             ?>
			 <form class="white" name="tcredit" method="POST">
        			<p> Sender</p> 
                 <div class="numbr mb-3">
                     <i class="far fa-user-circle text-muted p-0" style='font-size:24px'>
					 </i> 
				<td class="col-10 p-0" >
				<font face="Georgia" size:200px>
					 <?php 
					 echo (isset($rows['nam']) ? $rows['nam']:'' );
					 ?>
				</font>
					 </input>
				</td>

					   
                 </div>
              

				 
                 <div class="numbr mb-3">
                 <p>Select Receiver</p>
                 <i class="fas fa-user-circle text-muted p-0" style='font-size:24px'>
                  
				  
					 <select name="r" class="form-control" required>
           <option value="" disabled selected>Choose</option>	 
               <?php
                             include('config/database_connect.php');
				            	$senderid=$_GET['id'];
				             $sql9="SELECT * FROM customers WHERE id!=$senderid";
				              $result=mysqli_query($conn,$sql9);
				            	if(!$result)
				            	{
				        		echo "Error ".$sql9."<br>".mysqli_error($conn);
				            	}
                              while($rows=mysqli_fetch_assoc($result)){
				             ?>
				         
                           <option  value="<?php echo $rows['id']; ?>">
                           <font face="Georgia" size="4">
					<?php 
          echo $rows['nam'];
         ?>
         (Balance:<?php echo $rows['current_balance']; ?>)
                    				</font>
					              </option>
				           
                               <?php
				               }
				                  ?>
                 </select>

					</i>    
          </div>  


				
                 <p>Enter Amount</p> 
                 <div class="numbr mb-3">
                 <i class="fas fa-money-bill-wave text-muted p-0" style='font-size:24px'>
               <font size="4" >
                 <input class="col-10 p-0" type="number" name="amount" placeholder="For eg.100" required>
                      </font>
                     </i>    
                 </div>
                 <style type="text/css">
    	.brand{
    		background: #cbb09c   !important;
    	}
        form{
    		max-width:460px;
    		margin:20px auto;
    		padding:20px;
    	}
    </style>
			       
            <div class="center" >
  
                <input style="color:White" type="submit" name="submit" value="Transfer Now" class="btn brand z-depth-0">
            </div>
        	 </form>
             
        </div>
	</div>
</div>
	</body>
</html>
