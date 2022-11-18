<!DOCTYPE html>
<html lang="en">
<head>
	<title>Mental Health</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="mentalHealth/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="mentalHealth/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="mentalHealth/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="mentalHealth/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="mentalHealth/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="mentalHealth/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="mentalHealth/css/util.css">
	<link rel="stylesheet" type="text/css" href="mentalHealth/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="mentalHealth/images/Mental Health_Logo900.jpg" alt="IMG">
				</div>

				<form class="login100-form validate-form">
					<span class="login100-form-title">
						Mental Health Login
					</span>
					<span >
						<table width="100%">
						<tr>
							<td><p style="color:blue;">นักศึกษาใช้รหัสผ่านของระบบบริการการศึกษา</p>
							</td>
						</tr>
						<tr>
							<td><p style="color:blue;">บุคลากรใช้รหัสผ่านของระบบ NRRU MIS</p>
							</td>
						</tr>
							<tr>
							<td><p style="color:blue;">โดยไม่ต้องมี @nrru.ac.th</p>
							</td>
						</tr>		
						</table>
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" id="obj_email" placeholder="User Name">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="pass" id="obj_password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">

						<a href="#" id="btnLogin" class="login100-form-btn">Login</a>
					</div>

				</form>
			</div>
		</div>
	</div>
	
	<?php
		include_once "config/config.php";
		$cnf=new Config();
		$rootPath=$cnf->path;


	?>

	
<!--===============================================================================================-->	
	<script src="mentalHealth/vendor/jquery/jquery-3.2.1.min.js"></script>
  <script src="js/plugins/sweetalert/sweetalert2.all.min.js"></script>

<!--===============================================================================================-->


	<script >

	function executeData(url,jsonObj){
    //console.log(url);
    var result;
    var jsonData=JSON.stringify (jsonObj);
      $.ajax({
        //**************
          url: url,
          contentType: "application/json; charset=utf-8",
          type: "POST",
          dataType: "json",
          data:jsonData,
          async:false,
          success: function(data){
              result = data;
          } 
        //**************
      });
      return result;
  }

  function executeGet(url){
    var result;
    $.ajax({
      type:'GET',
      url:url,
      dataType:'json',
      async:false,
      success:function(data){
 
       result=data;
      }
    });
    return result;
  }


    function validLogin(){
      
      var url="<?=$rootPath?>/api/nrruCredentail.php";
      //console.log(url);
      var jsonObj={
      	 	userName: $("#obj_email").val(),
            password: $("#obj_password").val()
      }
      jsonData=JSON.stringify(jsonObj);
      data=executeData(url,jsonObj);
      if(data.message!=false){
      	 $(location).attr('href','index.php');
      }
      else{

      	 swal.fire({
                            title: "รหัสผ่านไม่ถูกต้อง",
                            type: "error",
                            buttons: [false, "ปิด"],
                            dangerMode: true,
                        });
            }

      
    
    }

    $("#btnLogin").click(function(){
      validLogin();
    });
 
	</script>


</body>
</html>