<?php
	header ("Content-Type: application/json; charset=utf-8");

	session_start();	
	require_once("../lib/nusoap.php");
	include_once "../lib/classAPI.php";
	include_once("../config/database.php");
	include_once("../objects/tdepartment.php");

	$database=new Database();
	$db=$database->getConnection();
	$obj=new tdepartment($db); 

	$data = json_decode(file_get_contents("php://input"));
	$userCode=$data->userName;
	
	$postObj = array(
		'userName' => $data->userName,
		'password' => $data->password
	);
	
	$jsonObj=json_encode($postObj);
	$api=new ClassAPI();
	$url="http://nrruapp.nrru.ac.th/NRRUCredential/NRRUCredential.php";
	$user=$api->postAPI($url,$jsonObj); 

//	print_r($user[0]["status"]);

	if($user[0]["status"]===1){

			foreach ($user as $row) {

					//print_r($row["usertype"]);

					$_SESSION["UserCode"]=$userCode;
					$_SESSION["UserType"]=$row["usertype"];
					$_SESSION["UserName"]=$row["username"];
					$_SESSION["FullName"]=$row["firstname"].' '.$row["lastname"]  ;
					//print_r($_SESSION["FullName"]);
					 
   					if(intval($row["usertype"])!==1)
   					{
						 $url="http://nrruapp.nrru.ac.th/Credential/getNrruProfile.php?staffId=".$row["staffid"];
						 $data1=$api->getAPI($url);
							if($data1!=""){
								$_SESSION["staffType"]=intval($data1[0]["staffGroup"]);
							}

						$_SESSION["staffid"]=$row["staffid"];
						$_SESSION["Picture"]=$row["picture"];
						if($obj->isDepartmentHead($row["departmentcode1"])==false){
							$_SESSION["DepartmentId"]=$row["departmentcode1"];}
						else{
							$_SESSION["DepartmentId"]=$row["departmentcode2"];}
						}
					else{
						$_SESSION["DepartmentId"]=$obj->getDepartmentCode($row["faculty"]);

					}
					echo json_encode(array("UserCode"=>$row["username"],"message"=>true)) ;

				}
			}
	else
	echo json_encode(array("message"=>false));


	
?>