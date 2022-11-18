<?php
	header("content-type:application/json;charset=UTF-8");
	include_once "../config/database.php";
	include_once "../objects/tqheader.php";
	include_once "../objects/tprojects.php";

	$database=new Database();
	$db=$database->getConnection();
	$obj=new tqheader($db);
	$objProject=new tprojects($db);

	$projectCode=isset($_GET["projectCode"])?$_GET["projectCode"]:1;
	$projectName=$objProject->getProjectName($projectCode);

	echo "<table class=\"table table-bordered table-hover\">\n";
	echo "<tr>\n";
	echo '<td><label style=\'color:blue;\'>'.$projectName.'</label><td>'."\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "<td>\n";
	echo "<table width=\"100%\" class=\"table table-bordered\">\n";


	$stmt=$obj->getData($projectCode);

	if($stmt->rowCount()>0){
		echo "<tr>";
		echo "<td>No.</td>";
		echo "<td>หัวข้อ</td>";
		echo "<td align=\"center\">1</td>\n";
		echo "<td align=\"center\">2</td>\n";
		echo "<td align=\"center\">3</td>\n";
		echo "<td align=\"center\">4</td>\n";
		echo "<td align=\"center\">5</td>\n";
		echo "</tr>";
		echo "<input type='hidden' id='obj_QCount' value='".$stmt->rowCount()."'>";

		while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
			extract($row);
			
			if($QtypeCode==1){

					echo "<tr>\n";
					echo "<td width=\"70px\" align=\"center\">\n";
					echo $QuestionNo;
					echo "</td>\n";
					echo '<td>'.$HeaderCaption.'</td>';
					echo '<td width="50px" align=\'center\'><input type="radio" name="obj_Q-'.$id.'" value="1"></td>';
					echo '<td width="50px" align=\'center\'><input type="radio" name="obj_Q-'.$id.'" value="2"></td>';
					echo '<td width="50px" align=\'center\'><input type="radio" name="obj_Q-'.$id.'" value="3"></td>';
					echo '<td width="50px" align=\'center\'><input type="radio" name="obj_Q-'.$id.'" value="4"></td>';
					echo '<td width="50px" align=\'center\'><input type="radio" name="obj_Q-'.$id.'" value="5"></td>';
					echo "</tr>\n"; 
			}
			else
			{
				echo "<tr>\n";
				echo "<td width=\"70px\"></td>\n";
				echo $QuestionNo;
				echo "</td>\n";
				echo '<td colspan=\'6\'>'.$HeaderCaption.'</td>'."\n";
				echo "</tr>\n";
				echo "<tr>\n";
				echo '<td colspan=\'7\'><textarea class=\'form-control\' name=\'obj_Q-'.$id.'\' id=\'obj_Q-'.$id.'\' rows=\'3\'></textarea></td>'."\n";
				echo "</tr>\n";
			}
		}
	}

	echo "</table>\n";
	echo "</td>\n";
	echo "</tr>\n";
	echo "</table>\n";




?>