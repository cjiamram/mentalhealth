
<?php
	//print_r('xxxxx');
	include_once "../config/config.php";
	//print_r('xxxxx');
	include_once "../objects/cypher.php";
	$cnf=new Config();
	$cypher=new Cypher();


	$projectGroupId=isset($_GET["projectGroupId"])?$_GET["projectGroupId"]:0;
	//print_r($projectGroupId);

	$url=$cnf->restURL."/questionair.php?projectGroupId=". $cypher->encrypt($projectGroupId)."&status=1";
	//print_r($url);
?>


<div class="col-sm-12">
<table width="100%">
<tr>
	<td valign="middle" align="center">
		<div id="qrcode" style="width:300px; height:300px; margin-top:15px;">
 	</div>
	</td>
</tr>
<tr>
	<td align='center'>
		<label><?php echo $url; ?></label>
	</td>
</tr>
 </table>
</div>

<script>

var url='<?php echo $url; ?>';

var qrcode = new QRCode(document.getElementById("qrcode"), {
	width : 300,
	height : 300
});

function makeCode () {		
	
	qrcode.makeCode(url);
}

$(document).ready(function(){
	makeCode();
});
</script>