<?php
	if($_SERVER['REQUEST_METHOD']=='POST'){
		  /*$request = json_decode(file_get_contents('php://input'));
		  $dbName = $request->dbName;
		  $key = $request->term;
		  $type = $request->type;*/
		
		 $dbName = $_POST['dbName'];
                 $dbUsername = $_POST['dbUsername'];
                 $dbPassword = $_POST['dbPassword'];
		 $type = $_POST['type'];

		require "swiftshopconn.php";
		
			if($type == "getCategories"){
				$qry = "SELECT category FROM `Item` GROUP by category";

			$result = mysqli_query($conn, $qry);
			
			if(mysqli_num_rows($result) >0){
				
				// $categories = array();
				// $subcategories = array();
				// $numRows = mysqli_num_rows($result);
				// $i=0;
				// while($r = mysqli_fetch_row($result)) {
					// $i++;
					// if(!isset($category)){                    //initialise category n subcategories for the first time
						// $category = $r[0];
						// $subcategories[]= $r[1];     
					// }else{
						// if($category==$r[0]){				   //add subcategory to category
						 // $subcategories[] = $r[1];   
					// }else{										//add category to categories
					//	$obj =  array($category => $subcategories);    
					    // $obj = array("name" => $category, "subcategories" => $subcategories);
						// $categories[] = $obj;
						// $category = $r[0];
						// $subcategories = array();
						// $subcategories[] = $r[1];
					// }
					// if($i==$numRows){
					//	$obj =  array($category => $subcategories);
						// $obj = array("name" => $category, "subcategories" => $subcategories);
						// $categories[] = $obj;
					// }						
					// }			
				// }
				// echo json_encode($categories, JSON_FORCE_OBJECT);
				
				$categories = array();
		
				while($r = mysqli_fetch_row($result)) {
					
					$categories[] = $r[0];
				}
				echo json_encode($categories,JSON_FORCE_OBJECT);
				
				
			}else{
				$response = array("message"=>"Item`not found");
				echo json_encode($response);
			}
			}
	else{
		$response = array("message"=>"Please enter a function");
		echo json_encode($response);
	}

	}
	else {
	$response = array("message"=>"use get method");
	echo json_encode($response);

	}
	?>