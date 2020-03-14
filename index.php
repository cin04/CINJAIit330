
<?php

$servername = "cindyjaisever.mysql.database.azure.com";
$username = "cinjai@cindyjaisever";
$password = "Cindyjai1";
$dbname = "info";

$id='';
$name="";
$address="";


mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
//connect to mysql database
	try{

		$conn = mysqli_connect($servername,$username,$password,$dbname);
	}catch(mysqli_sql_Exeception $ex){
		echo "error in connecting";
	}

//get data
function getdata(){

	$data=array();
	$data[0]=$_POST['id'];
	$data[1]=$_POST['name'];
	$data[2]=$_POST['address'];
	return $data;
}
//search
	
	if (isset($_POST['search'])) {
		# code...
		$info = getData();
		$search_query="SELECT * FROM `information` WHERE if = '$info[0]'";
		$search_result=mysqli_query($conn,$search_query);
			if ($search_result) {
				# code...
				if (mysqli_num_rows($search_result)) {
					# code...
					while ($rows = mysqli_fetch_array($search_result)) {
						# code...
						$id = $rows['id'];
						$name = $rows['name'];
						$location = $rows['address'];
					}
				}else{
					echo "no data are available";
				}
			}else{
				echo "result error";
			}

	}

// insert
	if (isset($_POST['insert'])) {
		# code...
		$info = getData();
		$insert_query="INSERT INTO `information`( `name`, `address`) VALUES ('$info[1]','$info[2]')";
			try{
				$insert_result=mysqli_query($conn,$insert_query);
				if ($insert_query) {
					# code...
					if (mysqli_affected_rows($conn)>0) {
						# code...
						echo("data inserted successfully!");
					}else{
						echo "data are not inserted";
					}
				}
			}catch(Exception $ex){
				echo "error inserted", $ex->getMessage();
			}
	}

//delete
	if (isset($_POST['delete'])) {
		# code...
		$info = getData();
		$delete_query ="DELETE FROM `information` WHERE id = '$info[0]'";
		try{
			$delete_result = mysqli_query($conn,$delete_query);
			if ($delete_result) {
				# code...
				if(mysqli_affected_rows($conn)>0){
					echo "date deleted";
				}else{
					echo "data not deleted";
				}
			}
		}catch(Exception $ex){
			echo "error in delete".$ex->getMessage();
		}
		
	}

	//edit
	if (isset($_POST['update'])) {
		# code...
		$info = getdata(); 
		$update_query= "UPDATE `information` SET `name`='$info[1]',`address`='$info[2]' WHERE id ='$info[0]'";
		try{
			$update_result = mysqli_query($conn,$update_query);
			if ($update_result) {
				# code...
				if (mysqli_affected_rows($conn)>0) {
					# code...
					echo "data updated";
				}else{
					echo "data not updated";
				}
			}
		}catch(Exception $ex){
			echo "error in update".$ex->getMessage();
		}
	}
?>




<html>
<body>

<form method="post" action="index.php">
	<input type="number" name="id" placeholder="id" value="<?php echo ($id);?>"><br><br>
	<input type="text" name="name" placeholder="Name" value="<?php echo ($name);?>"><br><br>
	<input type="text" name="address" placeholder="address" value="<?php echo ($address);?>"><br><br>
	
	<div>
		<input type="submit" name="insert" value="Add">
		<input type="submit" name="update" value="Update">
		<input type="submit" name="delete" value="Delete">
		<input type="submit" name="search" value="Find">
		
	</div>
</form>


</body>
</html>
