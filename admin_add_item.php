<?php

session_start();

$conn = mysqli_connect('localhost','root');

mysqli_select_db($conn,'rbms');

$item_name = $_POST['item_name'] ;
$item_price = $_POST['item_price'] ;
$salesman_username = $_POST['salesman_username'] ;

 $query = "select item from inventory where item='$item_name'";
 $result = mysqli_query($conn,$query);

 $query1 = "select username from salesman where username='$salesman_username'";
 $result1 = mysqli_query($conn,$query1);

 	if (!$result1) {
        echo "Could not successfully run query ($query1) from DB: " . mysqli_error();
        exit;
    }
    
    if (mysqli_num_rows($result1) == 0) {

    	echo "<script>
		alert('Salesman Is Not Present');
		window.location.href='admin_inventory.php';
		</script>";
    }

    if (!$result) {
        echo "Could not successfully run query ($query) from DB: " . mysqli_error();
        exit;
    }
    
    if (mysqli_num_rows($result) > 0 ) {

    	echo "<script>
		alert('Item is Already Present');
		window.location.href='admin_inventory.php';
		</script>";

    }else if (mysqli_num_rows($result) == 0 && mysqli_num_rows($result1) > 0) {
		$query_reg = "insert into inventory (item, price, salesman_username) values ('$item_name','$item_price','$salesman_username')";
		mysqli_query($conn,$query_reg);
		echo "<script>
		alert('Item Added');
		window.location.href='admin_inventory.php';
		</script>";
	}

?>