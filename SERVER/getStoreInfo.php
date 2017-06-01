<?php
	if($_SERVER['REQUEST_METHOD']=='POST'){
	    /*$request = json_decode(file_get_contents('php://input'));
	     $dbName = $request->dbName;
	     $type = $request->type;*/
	  	
          $dbName = $_POST['dbName'];
          $dbUsername = $_POST['dbUsername'];
          $dbPassword = $_POST['dbPassword'];
		$type = $_POST['type'];

	require "swiftshopconn.php";
	
		if($type == "getStoreInfo"){
			
			$qry = "select * from `Store`";
			$result = mysqli_query($conn, $qry);
			$row = mysqli_fetch_row($result);
			$storeID = $row[0];
			$storeName = $row[1];
			$storeDBName = $row[2];
			$storeDBUsername = $row[3];
			$storeDBPassword = $row[4];
			$storeURL = $row[5];
			$storeMap = base64_encode ($row[6]);
					
			$store = array("storeID" => $storeID, "storeName" => $storeName, "storeDBName" => $storeDBName,"storeDBUsername" => $storeDBUsername, "storeDBPassword" => $storeDBPassword, "storeURL" => $storeURL, "storeMap" => $storeMap);
			//var_dump($success);
			//echo implode("|",$success);
			echo json_encode($store);
	
		}
		else{
			$message = array("message"=>"Please enter a function");
			echo (string)json_encode(array("message"=>$message));
		}

	}
	else {
		$message = array("message"=>"use get method");
		echo (string)json_encode(array("message"=>$message));
	}
	?>