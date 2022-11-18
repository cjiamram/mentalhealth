<!DOCTYPE html>
<?php


  session_start();
  $_SESSION["lang"]="TH";
  
  
    include_once "config/config.php";
    include_once "config/database.php";
    include_once "objects/tfullname.php";
    $database = new Database();
    $db = $database->getConnection();
    $cnf=new Config();
    $rootPath=$cnf->path;
    $obj = new tfullname($db);
    if($obj->isExist('chatchai.j')!==true){
      $obj->userCode = 'chatchai.j';
      $obj->fullName ='ฉัตรชัย เจียมรัมย์';
      $obj->departmentCode = "240000";
      $obj->create();
    }
  
  $_SESSION["UserName"]="chatchai.j";
  $_SESSION["FullName"]="ฉัตรชัย เจียมรัมย์";
  $_SESSION["UserType"]=3;
  $cnf=new Config();
  $rootPath=$cnf->path;
  $userCode=isset($_SESSION["UserName"])?$_SESSION["UserName"]:"";
  $fullName=isset($_SESSION["FullName"])?$_SESSION["FullName"]:"";
  $userType=isset($_SESSION["UserType"])?$_SESSION["UserType"]:1;


  echo "<input type='hidden' id='obj_staffId' value='".$userCode."' >";
  echo "<input type='hidden' id='obj_userType' value='".$userType."' >";


?>

<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>NRRU Mental Health</title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
  <link rel="stylesheet" href="css/jquery-ui.css"/>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <link rel="stylesheet"
  href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

<style>
.flex-container {
  display: flex;
  background-color: #fcf1dd;
}

.flex-container > 
div {
  background-color: #f5e2c2;
  margin: 10px;
  padding: 20px;

}

.content {
  max-width: 900px;
  min-width: 412px;
  margin: auto;
  background: white;
  padding: 10px;
  
 
}

.container-main {
  width: 100%;  
  min-height: 100vh;
  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
  padding: 15px;
  background: #F5E2C2;
  background: -webkit-linear-gradient(-135deg, #F5E2C2, #AF8F5C);
  background: -o-linear-gradient(-135deg, #F5E2C2, #AF8F5C);
  background: -moz-linear-gradient(-135deg, #F5E2C2, #AF8F5C);
  background: linear-gradient(-135deg, #F5E2C2, #AF8F5C);
}
</style>
<!--
background: #fcf1dd;
  background: -webkit-linear-gradient(-135deg, #c850c0, #4158d0);
  background: -o-linear-gradient(-135deg, #c850c0, #4158d0);
  background: -moz-linear-gradient(-135deg, #c850c0, #4158d0);
  background: linear-gradient(-135deg, #c850c0, #4158d0);

-->


<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js">
</script>
<script src="js/plugins/sweetalert/sweetalert2.all.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="js/component.js"></script>

</head>
<body class="hold-transition skin-blue sidebar-mini" style="padding:no-padding">
<div class="container-main">
<div class="content">
<div class="flex-container">
  <div class="flexBox"> 
    <img src="img/Banner-250.jpg" width="100%">
  </div>

</div>
<div class="flex-container">
  <div id="dvContent" class="col-xs-12" >
  </div>
</div>

</div>
</div>

</body >
</html>

<script>
  
  function isSurveyExist(){
      var url="<?=$rootPath?>/tsurveytransaction/isSurveyExist.php?userCode=<?=$userCode?>";
      data=queryData(url);
      return data.flag;
  }

  function getSurveyForm(){
    console.log(<?=$userType?>);
    if(isSurveyExist()!=true){
        var url="";
        var userType= <?=$userType?>;
        if(<?=$userType?>===1) 
             url="<?=$rootPath?>/tstudentsurveyform/studentForm.php?userCode=<?=$userCode?>&projectGroupId=10&userType="+$("#obj_userType").val();
        else
             url="<?=$rootPath?>/tstaffsurveyform/staffForm.php?userCode=<?=$userCode?>&projectGroupId=7&userType="+$("#obj_userType").val();
        
        $("#dvContent").load(url);
    }else{
      if(<?=$userType?>===1)
            var url="<?=$rootPath?>/burnout/burnoutStudentReport.php?userCode=<?=$userCode?>";

      else
            var url="<?=$rootPath?>/burnout/burnoutReport.php?userCode=<?=$userCode?>";

      //console.log(url);
      $("#dvContent").load(url);


    }
  }

  function deleteSuicide(){
    var url="<?=$rootPath?>/tsurveytransaction/deleteSuicide.php";
    executeGet(url);
  }

  function getSuicide(){
    var url="<?=$rootPath?>/tprojectgroup/genSuicide8Q.php?projectGroupId=9&userCode=chatchai.j&userType=3";
    console.log(url);
    $("#dvContent").load(url);
  }

  $(document).ready(function(){
     deleteSuicide();
     getSuicide();
  });

</script>