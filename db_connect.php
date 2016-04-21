
<?php 

$site_url = 'http://localhost/cointec/';
$BaseName = "cointec";
$Host = "localhost";
$dbUser = "root";
$PassWord ="";

// $site_url = 'http://akashprabhakar.com/cointec';
// $BaseName = "cointec";
// $Host = "localhost";
// $dbUser = "cointec";
// $PassWord ="zSfo39?9";

// $site_url = 'http://treatmentchecklists.com/cointec';
// $BaseName = "treatmen_cointec";
// $Host = "localhost";
// $dbUser = "treatmen_coin";
// $PassWord ="}#85nu@3fGtC";

$con = mysql_pconnect($Host,$dbUser,$PassWord) or die ("Can not connect to $Host.");
mysql_select_db($BaseName,$con);

function get_subtotal($data){
	// $ret = '';
	// $sql="SELECT * FROM `current_match` WHERE 1";
	// $res= mysql_query($sql);
	// $row = mysql_fetch_array($res);
	// $ret = $row['ID'];

	$add = array();
	foreach($data as $score){
		if($score == 'No symptoms' || $score== 'Yes'){
			$add[] = 0;
		}elseif($score == 'Mild and occasional symptoms' || $score== 'Sometimes'){
			$add[] = 1;
		}elseif($score == 'Mild and regular symptoms' || $score== 'No'){
			$add[] = 2;
		}elseif($score == 'Mild and constant symptoms'){
			$add[] = 3;
		}elseif($score == 'Moderate and occasional symptoms'){
			$add[] = 4;
		}elseif($score == 'Moderate and regular symptoms'){
			$add[] = 5;
		}elseif($score == 'Moderate and constant symptoms'){
			$add[] = 6;
		}elseif($score == 'Severe and occasional symptoms'){
			$add[] = 7;
		}elseif($score == 'Severe and regular symptoms'){
			$add[] = 8;
		}elseif($score == 'Severe and constant symptoms'){
			$add[] = 9;
		}
	}

	$sum = array_sum($add);
return $sum;
}

function insert_data($username,$email,$subtotal1,$subtotal2,$subtotal3,$subtotal4,$subtotal5,$total,$feedback){

	$ret = '';
	$sql="INSERT INTO `patient_scores`(`username`,`email`,`subtotal1`, `subtotal2`, `subtotal3`, `subtotal4`, `subtotal5`, `total`, `feedback`) 
	VALUES ('$username','$email','$subtotal1','$subtotal2','$subtotal3','$subtotal4','$subtotal5','$total','$feedback')";


	if(mysql_query($sql)){
		return true;
	}else{
		return false;
	}
	
}

function insert_atec_data($username,$email,$subtotala1,$subtotala2,$subtotala3,$subtotala4,$atectotal,$feedback){

	$ret = '';
	$sql="INSERT INTO `patient_scores_atec`(`username`,`email`,`subtotala1`, `subtotala2`, `subtotala3`, `subtotala4`,`atectotal`, `feedback`) 
	VALUES ('$username','$email','$subtotala1','$subtotala2','$subtotala3','$subtotala4','$atectotal','$feedback')";


	if(mysql_query($sql)){
		return true;
	}else{
		return false;
	}
	
}

function get_history($username,$email){
	$sql="SELECT * FROM `patient_scores` where username='$username' and email='$email'";
	$res= mysql_query($sql);
	while($row = mysql_fetch_array($res)){
		$records[] = $row;
	}
	
	return $records;
}

function get_atec_history($username,$email){
	$sql="SELECT * FROM `patient_scores_atec` where username='$username' and email='$email'";
	$res= mysql_query($sql);
	while($row = mysql_fetch_array($res)){
		$records[] = $row;
	}
	
	return $records;
}

function get_history1($username){
	$sql="SELECT * FROM `patient_scores` where username='$username'";
	$res= mysql_query($sql);
	while($row = mysql_fetch_array($res)){
		$records[] = $row;
	}
	
	return $records;
}


function get_feedback_atec(){
	$sql="SELECT id,username,created_at,feedback,atectotal FROM `patient_scores_atec` WHERE feedback != '' ORDER BY id DESC LIMIT 5";

	$res= mysql_query($sql);
	while($row = mysql_fetch_array($res)){
		$feedbacks[] = $row;
	}
	
	return $feedbacks;
}

function get_feedback(){
	$sql="SELECT id,username,created_at,feedback,total FROM `patient_scores` WHERE feedback != '' ORDER BY id DESC LIMIT 5";

	$res= mysql_query($sql);
	while($row = mysql_fetch_array($res)){
		$feedbacks[] = $row;
	}
	
	return $feedbacks;
}


function get_match_data($mid, $wh){
	$ret = '';
	$sql="SELECT * FROM `current_match` WHERE `ID`='$mid'";
	$res= mysql_query($sql);
	$row = mysql_fetch_array($res);
	$ret = $row[$wh];
	return $ret;
}




function get_players_data($teamid){
	$sql="SELECT * FROM `team_players` WHERE `team_id`='" . $teamid . "'";
  	$res= mysql_query($sql);
  
  	while($row = mysql_fetch_array($res)) {

    	$team[] = $row;

  	}
	return $team;
}

function update_player($player_name,$playerid){
	$sql ="UPDATE `team_players` SET `player_name`='" . $player_name . "' WHERE `id`='" . $playerid . "'";

	$res= mysql_query($sql);

	return $res;
}

?>