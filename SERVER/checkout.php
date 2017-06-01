<?php
	if($_SERVER['REQUEST_METHOD']=='POST'){
	 /*  $request = json_decode(file_get_contents('php://input'));
	  $dbName = $request->dbName;
	  $items[] = $request->items;
	  $payment[] = $request->payment;
	  $counter = $request->counter;
	  $type = $request->type; */
	  	
	 $dbName = $_POST['dbName'];
         $dbUsername = $_POST['dbUsername'];
         $dbPassword = $_POST['dbPassword'];
	 $type = $_POST['type'];
	 $items = json_decode($_POST['items'],true);
	 $payment = json_decode($_POST['payment'],true);
	 $counter = $_POST['counter'];
	 $type = $_POST['type'];

	require "swiftshopconn.php";
	
		if($type == "checkout"){
	
			$cardNo = $payment[0];
			$cardExp = $payment[1];
			$cardCVV = $payment[2];
			$cardPin = $payment[3];
			
			$cardNoCheck = $cardExpCheck = $cardCVVCheck = $cardPinCheck = false;
			
			if(preg_match("/^[0-9]*$/",$cardNo)){
				$cardNoCheck = true;
			}if(preg_match("/[0-9]{2}\/[0-9]{2}/",$cardExp)){
				$cardExpCheck = true;
			}if(preg_match("/^[0-9]*$/",$cardCVV)){
				$cardCVVCheck = true;
			}if(preg_match("/^[0-9]*$/",$cardPin)){
				$cardPinCheck = true;
			}
			
				
			$message = "";
			
			if($cardNoCheck && $cardExpCheck && $cardCVVCheck && $cardPinCheck){
				$totalPrice = 0;
				date_default_timezone_set("Asia/Kuala_Lumpur"); 
				$t=time();
				$transactiontime = date("Y-m-d H:i:s",$t);
				$qry = "insert into `SalesRecord` (transactiontime) values ('$transactiontime');";
				mysqli_query($conn, $qry);
				$message = $message.mysqli_error($conn);
				$receiptID = mysqli_insert_id($conn);
				for($i=0; $i<count($items); $i++){
					//$item = []; 
					$item = $items[$i];
					$itemID = $item[0];
					$itemPrice = $item[2];
					$itemQty = $item[4];
					
					$itemQty = (int) $itemQty;
					$itemPrice = floatval($itemPrice);
					$totalPrice = $totalPrice + $itemPrice;
				
					$qry = "insert into `Receipt` (receiptID,itemID,itemQty,itemPrice) values ('$receiptID','$itemID',$itemQty,$itemPrice);";
					mysqli_query($conn, $qry);
					$message = $message.mysqli_error($conn);
					$qry = "update `Item` set qty = qty-$itemQty where id = '$itemID'";
					mysqli_query($conn, $qry);
					// $message = $message.mysqli_error($conn);
				}
					$qry = "update `SalesRecord` set payment = $totalPrice where receiptID = $receiptID;";
					mysqli_query($conn, $qry);
				if($message == ""){
					// $qry = "select * from `Store`";
					// $result = mysqli_query($conn, $qry);
					// $row = mysqli_fetch_row($result);
					// $storeName = $row[1];
					// $storeDBName = $row[2];
					// $storeURL = $row[3];
							
					$success = array("message"=>"Payment successful","receiptID"=>(string)$receiptID,"transactiontime" =>$transactiontime, "totalPrice" => (string)$totalPrice);//, "storeName" => $storeName);//, "storeDBName" => $storeDBName, "storeURL" => $storeURL);
					//var_dump($success);
					//echo implode("|",$success);
					echo (string)json_encode($success);
				}
				else{
					echo (string)json_encode(array("message"=>$message));
				}
			}
			else{
				$message = $message."Payment Information is incorrect"." no ".$cardNoCheck." exp ".$cardExpCheck." cvv ".$cardCVVCheck." pin ".$cardPinCheck;
				echo (string)json_encode(array("message"=>$message));
			}	
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