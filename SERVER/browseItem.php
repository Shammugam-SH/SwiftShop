<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	   $request = json_decode(file_get_contents('php://input'));
	    $dbName = $_POST['dbName'];
           $dbUsername = $_POST['dbUsername'];
           $dbPassword = $_POST['dbPassword'];
	    $key = $request->term;
	    $type = $request->type;
	
	 // $dbName = $_POST['dbName'];
 // $key = $_POST['term'];
 // $type = $_POST['type'];

	 require "swiftshopconn.php";
	
	if(!empty($key)){
		if($type == "searchItem"){
			$qry = "select name, sellPrice, discount, image, shelfNo from `Item` where name like '%$key%'";

		$result = mysqli_query($conn, $qry);
		
		if(mysqli_num_rows($result) >0){
			
			$rows = array();
			while($r = mysqli_fetch_assoc($result)) {
			  $r["image"] = base64_encode ($r["image"]);
			  $rows[] = $r; 
			}
			$row = mysqli_fetch_row($result);
	
			echo json_encode($rows, JSON_FORCE_OBJECT);
		}else{
			$response = array("message"=>"Item`not found");
			echo json_encode($response, JSON_FORCE_OBJECT);
		}
		}else if($type == "addToCart"){
			$qry = "select id, name, sellPrice, discount, image, shelfNo from `Item` where id = '$key'";

		$result = mysqli_query($conn, $qry);
		
		if(mysqli_num_rows($result) >0){
			
			$rows = array();
			while($r = mysqli_fetch_assoc($result)) {
			   $r["image"] = base64_encode ($r["image"]);
			  $rows[] = $r; 
			}
			echo json_encode($rows, JSON_FORCE_OBJECT);
		}else{
			$response = array("message"=>"Item`not found in database ");
			echo json_encode($response, JSON_FORCE_OBJECT);
		}
	}
else{
	$response = array("message"=>"Please enter a function");
	echo json_encode($response, JSON_FORCE_OBJECT);
}
}else {
	$response = array("message"=>"Please enter a search keyword");
	echo json_encode($response, JSON_FORCE_OBJECT);
}
}
else if ($_SERVER['REQUEST_METHOD']=='GET'){

$response = array("message"=>"use get method");
echo json_encode($response);

}else{
		$response = array("message"=>"No server request type");
	echo json_encode($response, JSON_FORCE_OBJECT);
}
 ?>