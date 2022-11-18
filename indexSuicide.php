<!DOCTYPE html>
<?php
  header("content-type:text/html;charset=UTF-8");
  include_once "config/config.php";
  $cnf=new Config();
  $rootPath=$cnf->path;


?>
<input type="hidden" id="obj_userType" value='<?=$userType?>'>
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
  background: #fcf1dd;
  background: -webkit-linear-gradient(-135deg, #c850c0, #4158d0);
  background: -o-linear-gradient(-135deg, #c850c0, #4158d0);
  background: -moz-linear-gradient(-135deg, #c850c0, #4158d0);
  background: linear-gradient(-135deg, #c850c0, #4158d0);
}
</style>
<style type="text/css">
.center {
  text-align: center;
  border: 1px solid green;
}
</style>


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
  function getSurveyForm(){
    var url="<?=$rootPath?>/tprojectgroup/genDepress9Q.php?projectGroupId=8&usserCode=chatchai.j";
        //var url="<?=$rootPath?>/tprojectgroup/genSuicide8Q.php?projectGroupId=9&usserCode=chatchai.j";
        //var url="<?=$rootPath?>/tprojectgroup/genMentalHealth.php?projectGroupId=7&usserCode=chatchai.j";

    $("#dvContent").load(url);
  }

  $(document).ready(function(){
     getSurveyForm();
  });

</script>