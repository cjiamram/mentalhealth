<?php
	header("content-type:text/html;charset=UTF-8");
	include_once "../config/config.php";
	include_once "../lib/classAPI.php";

	$cnf=new Config();
	$url=$cnf->restURL."tconsense/getData.php";
	$api=new ClassAPI();
	$data=$api->getAPI($url);
	if(!isset($data["message"])){
		echo $data["consense"];
	}

?>