<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>NRRU Questionair Management</title>

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
  background-color: DodgerBlue;
}

.flex-container > 
div {
  background-color: #f1f1f1;
  margin: 10px;
  padding: 20px;

}
</style>


<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js">
</script>
<script src="js/plugins/sweetalert/sweetalert2.all.min.js"></script>

<script src="dist/js/adminlte.min.js"></script>
<script src="js/component.js"></script>

</head>
<body>
<div class="flex-container">
<div class="row">
  <div class="flexBox" style="
    display: flex;
    flex-flow: row wrap;
    justify-content: center;">
    <img src="img/logo.png">
  </div>
  
</div>


</div>
<div class="flex-container">
  <div id="dvMain" class="col-sm-12">

  </div>
</div>



</body>
</html>

<?php

include_once "objects/cypher.php";
include_once "config/config.php";
$cypher=new Cypher();
$cnf=new Config();
$rootPath=$cnf->path;

  


  $projectGroupId=isset($_GET["projectGroupId"])?$_GET["projectGroupId"]:0;

  if(isset($_GET["status"])){
    $projectGroupId=$cypher->decrypt($projectGroupId);
  }

  

?>

<script>
 var projectGroupId='<?php echo  $projectGroupId; ?>';

 $(document).ready(function(){
      var url="<?=$rootPath?>/tprojectgroup/simQuestionairProject.php?projectGroupId="+projectGroupId;
    $("#dvMain").load(url);
 })

</script>

