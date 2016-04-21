<?php 
	require_once 'db_connect.php';
	require_once 'libs/PHPMailer/PHPMailerAutoload.php';

	$m = new PHPMailer();

	$m->isSMTP();
	$m->SMTPAuth = true;
	 //$m->SMTPDebug = 2;

	$m->Host = 'smtp.gmail.com';
	$m->Username = 'Your gmail email id';
	$m->Password = 'gmail password';
	$m->SMTPSecure = 'tls';
	$m->Port = 587;

	
	$data = array();
	$data1 = array();
	$data2 = array();
	$data3 = array();
	$data4 = array();
	$records = array();
	$feedbacks = array();
	$flag=false;
	$nameErr = '';

	$feedback ='';
	$subtotal1 = '';$subtotal2 = '';$subtotal3 = '';$subtotal4 = '';$subtotal5 = '';$total = '';
	if(isset($_POST['submit'])){

		if (isset($_POST["username"]) && !empty($_POST["username"])) {
		    $username = $_POST['username'];
		    $flag = true;

		  } else {
		    
		    $nameErr = "Please enter your user name..";
		    //$username = $_POST['username'];
		    $flag=false;


		  }
		
		$email = $_POST['email'];
		$data[] = $_POST['balancevertigo'];
		$data[] = $_POST['tempreg'];
		$data[] = $_POST['noise'];
		$data[] = $_POST['light'];
		$data[] = $_POST['headaches'];
		$data[] = $_POST['vision'];
		$data[] = $_POST['coma'];
		$data[] = $_POST['seizures'];
		$data[] = $_POST['sleep'];
		$data1[] = $_POST['chest_pain'];
		$data1[] = $_POST['low_blood'];
		$data1[] = $_POST['feetburn'];
		$data1[] = $_POST['poor_digest'];
		$data2[] = $_POST['weakness'];
		$data2[] = $_POST['spasms'];
		$data2[] = $_POST['swallowing'];
		$data2[] = $_POST['tingling'];
		$data2[] = $_POST['twitching'];
		$data3[] = $_POST['disjointed'];
		$data3[] = $_POST['delay_speech'];
		$data3[] = $_POST['handwriting'];
		$data3[] = $_POST['morethan1'];
		$data3[] = $_POST['basic_maths'];
		$data3[] = $_POST['spacial_awarness'];
		$data3[] = $_POST['rem_faces'];
		$data4[] = $_POST['nauseated'];
		$data4[] = $_POST['tenderness'];
		$data4[] = $_POST['fdallergies'];
		$data4[] = $_POST['challergies'];
		$data4[] = $_POST['blotchiness'];
		$data4[] = $_POST['rigidity'];
		$data4[] = $_POST['exertionf'];
		$data4[] = $_POST['exertions'];

		if (!empty($_POST["feedback"])) {
		    $feedback = $_POST['feedback'];

		  } else {
		   $feedback = '';
		    
		  }
		
		
		

	
	$subtotal1 = get_subtotal($data);
	$subtotal2 = get_subtotal($data1);
	$subtotal3 = get_subtotal($data2);
	$subtotal4 = get_subtotal($data3);
	$subtotal5 = get_subtotal($data4);

	$total = $subtotal1 + $subtotal2 + $subtotal3 + $subtotal4 + $subtotal5;

	if($flag){
	$result = insert_data($username,$email,$subtotal1,$subtotal2,$subtotal3,$subtotal4,$subtotal5,$total,$feedback);
	$m->From = 'sender emailid ';
	$m->FromName = 'senders name';
	$m->addReplyTo('reply@gmail.com','Reply address');
	$m->addAddress($email, $username);

	$m->isHTML(true);

	$m->Subject = 'Cointec Form Details And Scores';
	$m->Body = '<p><h3>Dear '.$username. ',</h3> <p>Following are the scores for the survey taken on the cointec website.</p> <h4>Neurological signs and symptoms -><b style="color:#f00">'.$subtotal1.'</b>/81</h4>';
	$m->Body .= '<h4>Cardiovascular signs and symptoms -><b style="color:#f00">'.$subtotal2.'</b>/36</h4>';
	$m->Body .= '<h4>Muscular signs and symptoms -><b style="color:#f00">'.$subtotal3.'</b>/45</h4>';
	$m->Body .= '<h4>Cognition signs and symptoms	 -><b style="color:#f00">'.$subtotal4.'</b>/63</h4>';
	$m->Body .= '<h4>Other signs and symptoms -><b style="color:#f00">'.$subtotal5.'</b>/72</h4>';
	$m->Body .= '<h4>Total Score -><b style="color:#f00">'.$total.'</b>/297</h4></p>';

	$m->AltBody = 'This is the body of an email';
	if($m->send()){
		//echo "mail sent";
	}else{
		//echo "mail not sent";
	}
}else{
	$result = '';
}

	

	}

	$records = get_history($username);

	$feedbacks = get_feedback();
	
	

?>


<!DOCTYPE html>
<html>
<head>
	<title>Cointec Website</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script src="http://code.highcharts.com/highcharts.js"></script>
	<script src="http://code.highcharts.com/modules/exporting.js"></script>
	<script src="common.js"></script>
</head>
<style>
.container{
	width: 100%!important;
}

.space{
	padding-top: 75px;
	padding-bottom: 100px;
}
</style>

<script type="text/javascript">
	
</script>
<body>

	<div class="container">
		<h3 class="page-header text-center">COINTEC - The Coinfection Treatment Evaluation Checklist.</h3>

		<h4 style="color:#A8A8A8;">Score sheet for assessing ME, CFS, Lyme disease and associated ailments.</h4>
		<p style="color:#A8A8A8;">On a scale of zero to ten, where zero is no symptoms and ten is severe symptoms, please indicate where you are on the following questions.</p>

		<div class="row">
			<div class="col-md-12">
				
				
				<form action="" method="post">
				<!-- section 1 start ---->
				<div class="row">
					<div class="col-md-8">
					<h3 class="page-header text-center">Personal Details</h3>
				<div class="col-md-6 form-group">
					<input type="text" name="username" id="username" placeholder="Please enter you username.." class="form-control"/>	
					<span class="error" style="color:#f00;">* <?php echo $nameErr;?></span>
				</div>
				<div class="col-md-6 form-group">
					
					<input type="text" name="email" id="email" placeholder="Please enter you email address.." class="form-control"/>
				</div>
				</div>
				<div class="col-md-8">
				
				<h3 class="page-header text-center">Neurological signs and symptoms.</h3>
					<div class="col-md-6 form-group">
					    <label for="balancevertigo" style="color:#A8A8A8;">Do you have balance and vertigo problems?</label>
					    <select id="balancevertigo" name="balancevertigo" class=" form-control" required>
					      <option value="">Choose a symptom</option>
						  <option value="No symptoms">No symptoms</option>
						  <option value="Mild and occasional symptoms">Mild and occasional symptoms</option>
						  <option value="Mild and regular symptoms">Mild and regular symptoms</option>
						  <option value="Mild and constant symptoms">Mild and constant symptoms</option>
						  <option value="Moderate and occasional symptoms">Moderate and occasional symptoms</option>
						  <option value="Moderate and regular symptoms">Moderate and regular symptoms</option>
						  <option value="Moderate and constant symptoms">Moderate and constant symptoms</option>
						  <option value="Severe and occasional symptoms">Severe and occasional symptoms</option>
						  <option value="Severe and regular symptoms">Severe and regular symptoms</option>
						  <option value="Severe and constant symptoms">Severe and constant symptoms</option>
						</select>
					</div>

					<div class="col-md-6 form-group">
					    <label for="tempreg" style="color:#A8A8A8;">Do you have poor temperature regulation, and poor tolerance for hot or cold environments?</label>
					    <select id="tempreg" name="tempreg" class="form-control" required>
						  <option value="">Choose a symptom</option>
						  <option value="No symptoms">No symptoms</option>
						  <option value="Mild and occasional symptoms">Mild and occasional symptoms</option>
						  <option value="Mild and regular symptoms">Mild and regular symptoms</option>
						  <option value="Mild and constant symptoms">Mild and constant symptoms</option>
						  <option value="Moderate and occasional symptoms">Moderate and occasional symptoms</option>
						  <option value="Moderate and regular symptoms">Moderate and regular symptoms</option>
						  <option value="Moderate and constant symptoms">Moderate and constant symptoms</option>
						  <option value="Severe and occasional symptoms">Severe and occasional symptoms</option>
						  <option value="Severe and regular symptoms">Severe and regular symptoms</option>
						  <option value="Severe and constant symptoms">Severe and constant symptoms</option>
						</select>
					</div>

					<div class="col-md-6 form-group">
					    <label for="noise" style="color:#A8A8A8;">Are you particularly sensitive to noise?</label>
					    <select required id="noise" name="noise" class=" form-control">
						  <option value="">Choose a symptom</option>
						  <option value="No symptoms">No symptoms</option>
						  <option value="Mild and occasional symptoms">Mild and occasional symptoms</option>
						  <option value="Mild and regular symptoms">Mild and regular symptoms</option>
						  <option value="Mild and constant symptoms">Mild and constant symptoms</option>
						  <option value="Moderate and occasional symptoms">Moderate and occasional symptoms</option>
						  <option value="Moderate and regular symptoms">Moderate and regular symptoms</option>
						  <option value="Moderate and constant symptoms">Moderate and constant symptoms</option>
						  <option value="Severe and occasional symptoms">Severe and occasional symptoms</option>
						  <option value="Severe and regular symptoms">Severe and regular symptoms</option>
						  <option value="Severe and constant symptoms">Severe and constant symptoms</option>
						</select>
					</div>

					<div class="col-md-6 form-group">
					    <label for="light" style="color:#A8A8A8;">Are you particularly sensitive to light?</label>
					    <select id="light" name="light" class=" form-control" required>
						  <option value="">Choose a symptom</option>
						  <option value="No symptoms">No symptoms</option>
						  <option value="Mild and occasional symptoms">Mild and occasional symptoms</option>
						  <option value="Mild and regular symptoms">Mild and regular symptoms</option>
						  <option value="Mild and constant symptoms">Mild and constant symptoms</option>
						  <option value="Moderate and occasional symptoms">Moderate and occasional symptoms</option>
						  <option value="Moderate and regular symptoms">Moderate and regular symptoms</option>
						  <option value="Moderate and constant symptoms">Moderate and constant symptoms</option>
						  <option value="Severe and occasional symptoms">Severe and occasional symptoms</option>
						  <option value="Severe and regular symptoms">Severe and regular symptoms</option>
						  <option value="Severe and constant symptoms">Severe and constant symptoms</option>
						</select>
					</div>

					<div class="col-md-6 form-group">
					    <label for="headaches" style="color:#A8A8A8;">Do you suffer from headaches?</label>
					    <select id="headaches" name="headaches" class=" form-control" required>
						  <option value="">Choose a symptom</option>
						  <option value="No symptoms">No symptoms</option>
						  <option value="Mild and occasional symptoms">Mild and occasional symptoms</option>
						  <option value="Mild and regular symptoms">Mild and regular symptoms</option>
						  <option value="Mild and constant symptoms">Mild and constant symptoms</option>
						  <option value="Moderate and occasional symptoms">Moderate and occasional symptoms</option>
						  <option value="Moderate and regular symptoms">Moderate and regular symptoms</option>
						  <option value="Moderate and constant symptoms">Moderate and constant symptoms</option>
						  <option value="Severe and occasional symptoms">Severe and occasional symptoms</option>
						  <option value="Severe and regular symptoms">Severe and regular symptoms</option>
						  <option value="Severe and constant symptoms">Severe and constant symptoms</option>
						</select>
					</div>

					<div class="col-md-6 form-group">
						<label for="vision" style="color:#A8A8A8;">Do you have blurred, wavy, or any other disturbances to your vision?</label>
					    <select id="vision" name="vision" class=" form-control" required>
						  <option value="">Choose a symptom</option>
						  <option value="No symptoms">No symptoms</option>
						  <option value="Mild and occasional symptoms">Mild and occasional symptoms</option>
						  <option value="Mild and regular symptoms">Mild and regular symptoms</option>
						  <option value="Mild and constant symptoms">Mild and constant symptoms</option>
						  <option value="Moderate and occasional symptoms">Moderate and occasional symptoms</option>
						  <option value="Moderate and regular symptoms">Moderate and regular symptoms</option>
						  <option value="Moderate and constant symptoms">Moderate and constant symptoms</option>
						  <option value="Severe and occasional symptoms">Severe and occasional symptoms</option>
						  <option value="Severe and regular symptoms">Severe and regular symptoms</option>
						  <option value="Severe and constant symptoms">Severe and constant symptoms</option>
						</select>
					</div>

					<div class="col-md-6 form-group">
					    <label for="coma" style="color:#A8A8A8;">Do you suffer from stroke-like or coma-like episodes?</label>
					    <select id="coma" name="coma" class=" form-control" required>
						  <option value="">Choose a symptom</option>
						  <option value="No symptoms">No symptoms</option>
						  <option value="Mild and occasional symptoms">Mild and occasional symptoms</option>
						  <option value="Mild and regular symptoms">Mild and regular symptoms</option>
						  <option value="Mild and constant symptoms">Mild and constant symptoms</option>
						  <option value="Moderate and occasional symptoms">Moderate and occasional symptoms</option>
						  <option value="Moderate and regular symptoms">Moderate and regular symptoms</option>
						  <option value="Moderate and constant symptoms">Moderate and constant symptoms</option>
						  <option value="Severe and occasional symptoms">Severe and occasional symptoms</option>
						  <option value="Severe and regular symptoms">Severe and regular symptoms</option>
						  <option value="Severe and constant symptoms">Severe and constant symptoms</option>
						</select>
					</div>

					<div class="col-md-6 form-group">
					    <label for="seizures" style="color:#A8A8A8;">Do you have seizures or other dramatic sensory storms?</label>
					    <select id="seizures" name="seizures" class=" form-control" required>
						  <option value="">Choose a symptom</option>
						  <option value="No symptoms">No symptoms</option>
						  <option value="Mild and occasional symptoms">Mild and occasional symptoms</option>
						  <option value="Mild and regular symptoms">Mild and regular symptoms</option>
						  <option value="Mild and constant symptoms">Mild and constant symptoms</option>
						  <option value="Moderate and occasional symptoms">Moderate and occasional symptoms</option>
						  <option value="Moderate and regular symptoms">Moderate and regular symptoms</option>
						  <option value="Moderate and constant symptoms">Moderate and constant symptoms</option>
						  <option value="Severe and occasional symptoms">Severe and occasional symptoms</option>
						  <option value="Severe and regular symptoms">Severe and regular symptoms</option>
						  <option value="Severe and constant symptoms">Severe and constant symptoms</option>
						</select>
					</div>

					<div class="col-md-6 form-group">
					    <label for="sleep" style="color:#A8A8A8;">Do you have disturbed sleep, including sleep paralysis?</label>
					    <select id="sleep" name="sleep" class=" form-control" required>
						  <option value="">Choose a symptom</option>
						  <option value="No symptoms">No symptoms</option>
						  <option value="Mild and occasional symptoms">Mild and occasional symptoms</option>
						  <option value="Mild and regular symptoms">Mild and regular symptoms</option>
						  <option value="Mild and constant symptoms">Mild and constant symptoms</option>
						  <option value="Moderate and occasional symptoms">Moderate and occasional symptoms</option>
						  <option value="Moderate and regular symptoms">Moderate and regular symptoms</option>
						  <option value="Moderate and constant symptoms">Moderate and constant symptoms</option>
						  <option value="Severe and occasional symptoms">Severe and occasional symptoms</option>
						  <option value="Severe and regular symptoms">Severe and regular symptoms</option>
						  <option value="Severe and constant symptoms">Severe and constant symptoms</option>
						</select>
					</div>


				</div>

					<!-- scores section -->
					<div class="col-md-4">
						<h3 class="page-header text-center">Score -> <?php echo $subtotal1; ?> / 81</h3>
						<input type="hidden" id="subtotal1" value="<?php echo $subtotal1; ?>" >
						<div id="container" style="min-width: 210px; height: 300px; max-width: 500px; margin: 0 auto"></div>
					</div>
				 	</div>

				 	<!-- section 1 end ---->

				 	<!-- section 2 start ---->
					<div class="row">
					<div class="col-md-8">
					<h3 class="page-header text-center">Cardiovascular signs and symptoms.</h3>
						<div class="col-md-6 form-group">
						    <label for="chest_pain" style="color:#A8A8A8;">Do you have a high heart rate, fluttering, or chest pain?</label>
						    <select id="chest_pain" name="chest_pain" class=" form-control" required>
							  <option value="">Choose a symptom</option>
						  <option value="No symptoms">No symptoms</option>
						  <option value="Mild and occasional symptoms">Mild and occasional symptoms</option>
						  <option value="Mild and regular symptoms">Mild and regular symptoms</option>
						  <option value="Mild and constant symptoms">Mild and constant symptoms</option>
						  <option value="Moderate and occasional symptoms">Moderate and occasional symptoms</option>
						  <option value="Moderate and regular symptoms">Moderate and regular symptoms</option>
						  <option value="Moderate and constant symptoms">Moderate and constant symptoms</option>
						  <option value="Severe and occasional symptoms">Severe and occasional symptoms</option>
						  <option value="Severe and regular symptoms">Severe and regular symptoms</option>
						  <option value="Severe and constant symptoms">Severe and constant symptoms</option>
							</select>
						</div>

						<div class="col-md-6 form-group">
						    <label for="low_blood" style="color:#A8A8A8;">Do you have low blood pressure particularly when standing?</label>
						    <select id="low_blood" name="low_blood" class="form-control" required>
							  <option value="">Choose a symptom</option>
						  <option value="No symptoms">No symptoms</option>
						  <option value="Mild and occasional symptoms">Mild and occasional symptoms</option>
						  <option value="Mild and regular symptoms">Mild and regular symptoms</option>
						  <option value="Mild and constant symptoms">Mild and constant symptoms</option>
						  <option value="Moderate and occasional symptoms">Moderate and occasional symptoms</option>
						  <option value="Moderate and regular symptoms">Moderate and regular symptoms</option>
						  <option value="Moderate and constant symptoms">Moderate and constant symptoms</option>
						  <option value="Severe and occasional symptoms">Severe and occasional symptoms</option>
						  <option value="Severe and regular symptoms">Severe and regular symptoms</option>
						  <option value="Severe and constant symptoms">Severe and constant symptoms</option>
							</select>
						</div>

						<div class="col-md-6 form-group">
						    <label for="feetburn" style="color:#A8A8A8;">Do your feet burn or discolour on standing?</label>
						    <select id="feetburn" name="feetburn" class=" form-control" required>
							  <option value="">Choose a symptom</option>
						  <option value="No symptoms">No symptoms</option>
						  <option value="Mild and occasional symptoms">Mild and occasional symptoms</option>
						  <option value="Mild and regular symptoms">Mild and regular symptoms</option>
						  <option value="Mild and constant symptoms">Mild and constant symptoms</option>
						  <option value="Moderate and occasional symptoms">Moderate and occasional symptoms</option>
						  <option value="Moderate and regular symptoms">Moderate and regular symptoms</option>
						  <option value="Moderate and constant symptoms">Moderate and constant symptoms</option>
						  <option value="Severe and occasional symptoms">Severe and occasional symptoms</option>
						  <option value="Severe and regular symptoms">Severe and regular symptoms</option>
						  <option value="Severe and constant symptoms">Severe and constant symptoms</option>
							</select>
						</div>

						<div class="col-md-6 form-group">
						    <label for="poor_digest" style="color:#A8A8A8;">Do you have pain, discomfort or poor digestion following meals?</label>
						    <select id="poor_digest" name="poor_digest" class=" form-control" required>
							 <option value="">Choose a symptom</option>
						  <option value="No symptoms">No symptoms</option>
						  <option value="Mild and occasional symptoms">Mild and occasional symptoms</option>
						  <option value="Mild and regular symptoms">Mild and regular symptoms</option>
						  <option value="Mild and constant symptoms">Mild and constant symptoms</option>
						  <option value="Moderate and occasional symptoms">Moderate and occasional symptoms</option>
						  <option value="Moderate and regular symptoms">Moderate and regular symptoms</option>
						  <option value="Moderate and constant symptoms">Moderate and constant symptoms</option>
						  <option value="Severe and occasional symptoms">Severe and occasional symptoms</option>
						  <option value="Severe and regular symptoms">Severe and regular symptoms</option>
						  <option value="Severe and constant symptoms">Severe and constant symptoms</option>
							</select>
						</div>
					</div>
					<!-- scores section -->
					<div class="col-md-4">
						<h3 class="page-header text-center">Score -> <?php echo $subtotal2; ?> / 36</h3>
						<input type="hidden" id="subtotal2" value="<?php echo $subtotal2; ?>" >
						<div id="container1" style="min-width: 210px; height: 300px; max-width: 500px; margin: 0 auto"></div>
					</div>
					</div>
					<!-- section 2 end ---->

					<!-- section 3 start ---->
					<div class="row">
						<div class="col-md-8">
						<h3 class="page-header text-center">Muscular signs and symptoms.</h3>
						<div class="col-md-6 form-group">
						    <label for="weakness" style="color:#A8A8A8;">Do you have muscle weakness or paralysis?</label>
						    <select id="weakness" name="weakness" class=" form-control" required>
							 <option value="">Choose a symptom</option>
						  <option value="No symptoms">No symptoms</option>
						  <option value="Mild and occasional symptoms">Mild and occasional symptoms</option>
						  <option value="Mild and regular symptoms">Mild and regular symptoms</option>
						  <option value="Mild and constant symptoms">Mild and constant symptoms</option>
						  <option value="Moderate and occasional symptoms">Moderate and occasional symptoms</option>
						  <option value="Moderate and regular symptoms">Moderate and regular symptoms</option>
						  <option value="Moderate and constant symptoms">Moderate and constant symptoms</option>
						  <option value="Severe and occasional symptoms">Severe and occasional symptoms</option>
						  <option value="Severe and regular symptoms">Severe and regular symptoms</option>
						  <option value="Severe and constant symptoms">Severe and constant symptoms</option>
							</select>
						</div>

						<div class="col-md-6 form-group">
							<label for="spasms" style="color:#A8A8A8;">Do you have muscle pain, or spasms?</label>
						    <select id="spasms" name="spasms" class=" form-control" required>
							  <option value="">Choose a symptom</option>
						  <option value="No symptoms">No symptoms</option>
						  <option value="Mild and occasional symptoms">Mild and occasional symptoms</option>
						  <option value="Mild and regular symptoms">Mild and regular symptoms</option>
						  <option value="Mild and constant symptoms">Mild and constant symptoms</option>
						  <option value="Moderate and occasional symptoms">Moderate and occasional symptoms</option>
						  <option value="Moderate and regular symptoms">Moderate and regular symptoms</option>
						  <option value="Moderate and constant symptoms">Moderate and constant symptoms</option>
						  <option value="Severe and occasional symptoms">Severe and occasional symptoms</option>
						  <option value="Severe and regular symptoms">Severe and regular symptoms</option>
						  <option value="Severe and constant symptoms">Severe and constant symptoms</option>
							</select>
						</div>

						<div class="col-md-6 form-group">
						    <label for="swallowing" style="color:#A8A8A8;">Do you have difficulty breathing, chewing or swallowing?</label>
						    <select id="swallowing" name="swallowing" class=" form-control" required>
							  <option>Choose a symptom</option>
							  <o<option value="">Choose a symptom</option>
						  <option value="No symptoms">No symptoms</option>
						  <option value="Mild and occasional symptoms">Mild and occasional symptoms</option>
						  <option value="Mild and regular symptoms">Mild and regular symptoms</option>
						  <option value="Mild and constant symptoms">Mild and constant symptoms</option>
						  <option value="Moderate and occasional symptoms">Moderate and occasional symptoms</option>
						  <option value="Moderate and regular symptoms">Moderate and regular symptoms</option>
						  <option value="Moderate and constant symptoms">Moderate and constant symptoms</option>
						  <option value="Severe and occasional symptoms">Severe and occasional symptoms</option>
						  <option value="Severe and regular symptoms">Severe and regular symptoms</option>
						  <option value="Severe and constant symptoms">Severe and constant symptoms</option>
							</select>
						</div>

						<div class="col-md-6 form-group">
						    <label for="tingling" style="color:#A8A8A8;">Do you have regular tickling, burning or tingling of the skin, or 'pins and needles'?</label>
						    <select id="tingling" name="tingling" class=" form-control" required>
							  <option value="">Choose a symptom</option>
						  <option value="No symptoms">No symptoms</option>
						  <option value="Mild and occasional symptoms">Mild and occasional symptoms</option>
						  <option value="Mild and regular symptoms">Mild and regular symptoms</option>
						  <option value="Mild and constant symptoms">Mild and constant symptoms</option>
						  <option value="Moderate and occasional symptoms">Moderate and occasional symptoms</option>
						  <option value="Moderate and regular symptoms">Moderate and regular symptoms</option>
						  <option value="Moderate and constant symptoms">Moderate and constant symptoms</option>
						  <option value="Severe and occasional symptoms">Severe and occasional symptoms</option>
						  <option value="Severe and regular symptoms">Severe and regular symptoms</option>
						  <option value="Severe and constant symptoms">Severe and constant symptoms</option>
							</select>
						</div>

						<div class="col-md-6 form-group">
						    <label for="twitching" style="color:#A8A8A8;">Do you have sudden, involuntery muscle jerks or twitching?</label>
						    <select id="twitching" name="twitching" class=" form-control" required>
							  <option value="">Choose a symptom</option>
						  <option value="No symptoms">No symptoms</option>
						  <option value="Mild and occasional symptoms">Mild and occasional symptoms</option>
						  <option value="Mild and regular symptoms">Mild and regular symptoms</option>
						  <option value="Mild and constant symptoms">Mild and constant symptoms</option>
						  <option value="Moderate and occasional symptoms">Moderate and occasional symptoms</option>
						  <option value="Moderate and regular symptoms">Moderate and regular symptoms</option>
						  <option value="Moderate and constant symptoms">Moderate and constant symptoms</option>
						  <option value="Severe and occasional symptoms">Severe and occasional symptoms</option>
						  <option value="Severe and regular symptoms">Severe and regular symptoms</option>
						  <option value="Severe and constant symptoms">Severe and constant symptoms</option>
							</select>
						</div>
						</div>
						<!-- scores section -->
						<div class="col-md-4">
							<h3 class="page-header text-center">Score -> <?php echo $subtotal3; ?> / 45</h3>
							<input type="hidden" id="subtotal3" value="<?php echo $subtotal3; ?>" >
						<div id="container2" style="min-width: 210px; height: 300px; max-width: 500px; margin: 0 auto"></div>
						</div>
					  </div>	
					  <!-- section 3 end ---->

					<!-- section 4 start ---->
					<div class="row">
						<div class="col-md-8">
						<h3 class="page-header text-center">Cognition signs and symptoms.</h3>
						<div class="col-md-6 form-group">
						    <label for="disjointed" style="color:#A8A8A8;">Do you have difficulty in speaking, finding the right words, disjointed speaking?</label>
						    <select id="disjointed" name="disjointed" class="form-control" required>
							  <option value="">Choose a symptom</option>
						  <option value="No symptoms">No symptoms</option>
						  <option value="Mild and occasional symptoms">Mild and occasional symptoms</option>
						  <option value="Mild and regular symptoms">Mild and regular symptoms</option>
						  <option value="Mild and constant symptoms">Mild and constant symptoms</option>
						  <option value="Moderate and occasional symptoms">Moderate and occasional symptoms</option>
						  <option value="Moderate and regular symptoms">Moderate and regular symptoms</option>
						  <option value="Moderate and constant symptoms">Moderate and constant symptoms</option>
						  <option value="Severe and occasional symptoms">Severe and occasional symptoms</option>
						  <option value="Severe and regular symptoms">Severe and regular symptoms</option>
						  <option value="Severe and constant symptoms">Severe and constant symptoms</option>
							</select>
						</div>

						<div class="col-md-6 form-group">
							<label for="delay_speech" style="color:#A8A8A8;">Do you have difficulty or a delay in understanding others speech?</label>
						    <select id="delay_speech" name="delay_speech" class="form-control" required>
							  <option value="">Choose a symptom</option>
						  <option value="No symptoms">No symptoms</option>
						  <option value="Mild and occasional symptoms">Mild and occasional symptoms</option>
						  <option value="Mild and regular symptoms">Mild and regular symptoms</option>
						  <option value="Mild and constant symptoms">Mild and constant symptoms</option>
						  <option value="Moderate and occasional symptoms">Moderate and occasional symptoms</option>
						  <option value="Moderate and regular symptoms">Moderate and regular symptoms</option>
						  <option value="Moderate and constant symptoms">Moderate and constant symptoms</option>
						  <option value="Severe and occasional symptoms">Severe and occasional symptoms</option>
						  <option value="Severe and regular symptoms">Severe and regular symptoms</option>
						  <option value="Severe and constant symptoms">Severe and constant symptoms</option>
							</select>
						</div>

						<div class="col-md-6 form-group">
						    <label for="handwriting" style="color:#A8A8A8;">Do you have difficulty in handwriting or in comprehending text??</label>
						    <select id="handwriting" name="handwriting" class=" form-control" required>
							 <option value="">Choose a symptom</option>
						  <option value="No symptoms">No symptoms</option>
						  <option value="Mild and occasional symptoms">Mild and occasional symptoms</option>
						  <option value="Mild and regular symptoms">Mild and regular symptoms</option>
						  <option value="Mild and constant symptoms">Mild and constant symptoms</option>
						  <option value="Moderate and occasional symptoms">Moderate and occasional symptoms</option>
						  <option value="Moderate and regular symptoms">Moderate and regular symptoms</option>
						  <option value="Moderate and constant symptoms">Moderate and constant symptoms</option>
						  <option value="Severe and occasional symptoms">Severe and occasional symptoms</option>
						  <option value="Severe and regular symptoms">Severe and regular symptoms</option>
						  <option value="Severe and constant symptoms">Severe and constant symptoms</option>
							</select>
						</div>

						<div class="col-md-6 form-group">
						    <label for="morethan1" style="color:#A8A8A8;">Do you have difficulties in doing more than one thing at a time?</label>
						    <select id="morethan1" name="morethan1" class=" form-control" required>
							  <option value="">Choose a symptom</option>
						  <option value="No symptoms">No symptoms</option>
						  <option value="Mild and occasional symptoms">Mild and occasional symptoms</option>
						  <option value="Mild and regular symptoms">Mild and regular symptoms</option>
						  <option value="Mild and constant symptoms">Mild and constant symptoms</option>
						  <option value="Moderate and occasional symptoms">Moderate and occasional symptoms</option>
						  <option value="Moderate and regular symptoms">Moderate and regular symptoms</option>
						  <option value="Moderate and constant symptoms">Moderate and constant symptoms</option>
						  <option value="Severe and occasional symptoms">Severe and occasional symptoms</option>
						  <option value="Severe and regular symptoms">Severe and regular symptoms</option>
						  <option value="Severe and constant symptoms">Severe and constant symptoms</option>
							</select>
						</div>

						<div class="col-md-6 form-group">
						    <label for="basic_maths" style="color:#A8A8A8;">Do you have difficulty with basic maths (addition and subtraction)?</label>
						    <select id="basic_maths" name="basic_maths" class=" form-control" required>
							  <option value="">Choose a symptom</option>
						  <option value="No symptoms">No symptoms</option>
						  <option value="Mild and occasional symptoms">Mild and occasional symptoms</option>
						  <option value="Mild and regular symptoms">Mild and regular symptoms</option>
						  <option value="Mild and constant symptoms">Mild and constant symptoms</option>
						  <option value="Moderate and occasional symptoms">Moderate and occasional symptoms</option>
						  <option value="Moderate and regular symptoms">Moderate and regular symptoms</option>
						  <option value="Moderate and constant symptoms">Moderate and constant symptoms</option>
						  <option value="Severe and occasional symptoms">Severe and occasional symptoms</option>
						  <option value="Severe and regular symptoms">Severe and regular symptoms</option>
						  <option value="Severe and constant symptoms">Severe and constant symptoms</option>
							</select>
						</div>

						<div class="col-md-6 form-group">
						    <label for="spacial_awarness" style="color:#A8A8A8;">Do you have difficulty with spacial awareness, such as walking into things?</label>
						    <select id="spacial_awarness" name="spacial_awarness" class=" form-control" required>
							  <option value="">Choose a symptom</option>
						  <option value="No symptoms">No symptoms</option>
						  <option value="Mild and occasional symptoms">Mild and occasional symptoms</option>
						  <option value="Mild and regular symptoms">Mild and regular symptoms</option>
						  <option value="Mild and constant symptoms">Mild and constant symptoms</option>
						  <option value="Moderate and occasional symptoms">Moderate and occasional symptoms</option>
						  <option value="Moderate and regular symptoms">Moderate and regular symptoms</option>
						  <option value="Moderate and constant symptoms">Moderate and constant symptoms</option>
						  <option value="Severe and occasional symptoms">Severe and occasional symptoms</option>
						  <option value="Severe and regular symptoms">Severe and regular symptoms</option>
						  <option value="Severe and constant symptoms">Severe and constant symptoms</option>
							</select>
						</div>

						<div class="col-md-6 form-group">
						    <label for="rem_faces" style="color:#A8A8A8;">Do you have difficulty in remembering new things, faces or names?</label>
						    <select id="rem_faces" name="rem_faces" class=" form-control" required>
							 <option value="">Choose a symptom</option>
						  <option value="No symptoms">No symptoms</option>
						  <option value="Mild and occasional symptoms">Mild and occasional symptoms</option>
						  <option value="Mild and regular symptoms">Mild and regular symptoms</option>
						  <option value="Mild and constant symptoms">Mild and constant symptoms</option>
						  <option value="Moderate and occasional symptoms">Moderate and occasional symptoms</option>
						  <option value="Moderate and regular symptoms">Moderate and regular symptoms</option>
						  <option value="Moderate and constant symptoms">Moderate and constant symptoms</option>
						  <option value="Severe and occasional symptoms">Severe and occasional symptoms</option>
						  <option value="Severe and regular symptoms">Severe and regular symptoms</option>
						  <option value="Severe and constant symptoms">Severe and constant symptoms</option>
							</select>
						</div>
						</div>
						<!-- scores section -->
						<div class="col-md-4">
							<h3 class="page-header text-center">Score -> <?php echo $subtotal4; ?> / 63</h3>
							<input type="hidden" id="subtotal4" value="<?php echo $subtotal4; ?>" >
						<div id="container3" style="min-width: 210px; height: 300px; max-width: 500px; margin: 0 auto"></div>
						</div>
					  </div>	
					  <!-- section 4 end ---->

					  <!-- section 5 start ---->
					<div class="row">
						<div class="col-md-8">
						<h3 class="page-header text-center">Other signs and symptoms.</h3>
						<div class="col-md-6 form-group">
						    <label for="nauseated" style="color:#A8A8A8;">Do you feel nauseated, vomit or feel very ill?</label>
						    <select id="nauseated" name="nauseated" class="form-control" required>
							  <option value="">Choose a symptom</option>
						  <option value="No symptoms">No symptoms</option>
						  <option value="Mild and occasional symptoms">Mild and occasional symptoms</option>
						  <option value="Mild and regular symptoms">Mild and regular symptoms</option>
						  <option value="Mild and constant symptoms">Mild and constant symptoms</option>
						  <option value="Moderate and occasional symptoms">Moderate and occasional symptoms</option>
						  <option value="Moderate and regular symptoms">Moderate and regular symptoms</option>
						  <option value="Moderate and constant symptoms">Moderate and constant symptoms</option>
						  <option value="Severe and occasional symptoms">Severe and occasional symptoms</option>
						  <option value="Severe and regular symptoms">Severe and regular symptoms</option>
						  <option value="Severe and constant symptoms">Severe and constant symptoms</option>
							</select>
						</div>

						<div class="col-md-6 form-group">
							<label for="tenderness" style="color:#A8A8A8;">Do you have throat and gland pain and tenderness, chills and/or low grade fever?</label>
						    <select id="tenderness" name="tenderness" class="form-control" required>
							  <option value="">Choose a symptom</option>
						  <option value="No symptoms">No symptoms</option>
						  <option value="Mild and occasional symptoms">Mild and occasional symptoms</option>
						  <option value="Mild and regular symptoms">Mild and regular symptoms</option>
						  <option value="Mild and constant symptoms">Mild and constant symptoms</option>
						  <option value="Moderate and occasional symptoms">Moderate and occasional symptoms</option>
						  <option value="Moderate and regular symptoms">Moderate and regular symptoms</option>
						  <option value="Moderate and constant symptoms">Moderate and constant symptoms</option>
						  <option value="Severe and occasional symptoms">Severe and occasional symptoms</option>
						  <option value="Severe and regular symptoms">Severe and regular symptoms</option>
						  <option value="Severe and constant symptoms">Severe and constant symptoms</option>
							</select>
						</div>

						<div class="col-md-6 form-group" style="margin-top:-20px;">
						    <label for="fdallergies" style="color:#A8A8A8;" >Do you have food allergies?</label>
						    <select id="fdallergies" name="fdallergies" class=" form-control" required>
							 <option value="">Choose a symptom</option>
						  <option value="No symptoms">No symptoms</option>
						  <option value="Mild and occasional symptoms">Mild and occasional symptoms</option>
						  <option value="Mild and regular symptoms">Mild and regular symptoms</option>
						  <option value="Mild and constant symptoms">Mild and constant symptoms</option>
						  <option value="Moderate and occasional symptoms">Moderate and occasional symptoms</option>
						  <option value="Moderate and regular symptoms">Moderate and regular symptoms</option>
						  <option value="Moderate and constant symptoms">Moderate and constant symptoms</option>
						  <option value="Severe and occasional symptoms">Severe and occasional symptoms</option>
						  <option value="Severe and regular symptoms">Severe and regular symptoms</option>
						  <option value="Severe and constant symptoms">Severe and constant symptoms</option>
							</select>
						</div>

						<div class="col-md-6 form-group" >
						    <label for="challergies" style="color:#A8A8A8;">Do you have chemical allergies (eg food additives, pharmaceuticals, personal care products)?</label>
						    <select id="challergies" name="challergies" class=" form-control" required>
							 <option value="">Choose a symptom</option>
						  <option value="No symptoms">No symptoms</option>
						  <option value="Mild and occasional symptoms">Mild and occasional symptoms</option>
						  <option value="Mild and regular symptoms">Mild and regular symptoms</option>
						  <option value="Mild and constant symptoms">Mild and constant symptoms</option>
						  <option value="Moderate and occasional symptoms">Moderate and occasional symptoms</option>
						  <option value="Moderate and regular symptoms">Moderate and regular symptoms</option>
						  <option value="Moderate and constant symptoms">Moderate and constant symptoms</option>
						  <option value="Severe and occasional symptoms">Severe and occasional symptoms</option>
						  <option value="Severe and regular symptoms">Severe and regular symptoms</option>
						  <option value="Severe and constant symptoms">Severe and constant symptoms</option>
							</select>
						</div>

						<div class="col-md-6 form-group" style="margin-top:-20px;">
						    <label for="blotchiness" style="color:#A8A8A8;">Do you have a pale pallor of face, or unusual blotchiness of the skin?</label>
						    <select id="blotchiness" name="blotchiness" class=" form-control" required>
							 <option value="">Choose a symptom</option>
						  <option value="No symptoms">No symptoms</option>
						  <option value="Mild and occasional symptoms">Mild and occasional symptoms</option>
						  <option value="Mild and regular symptoms">Mild and regular symptoms</option>
						  <option value="Mild and constant symptoms">Mild and constant symptoms</option>
						  <option value="Moderate and occasional symptoms">Moderate and occasional symptoms</option>
						  <option value="Moderate and regular symptoms">Moderate and regular symptoms</option>
						  <option value="Moderate and constant symptoms">Moderate and constant symptoms</option>
						  <option value="Severe and occasional symptoms">Severe and occasional symptoms</option>
						  <option value="Severe and regular symptoms">Severe and regular symptoms</option>
						  <option value="Severe and constant symptoms">Severe and constant symptoms</option>
							</select>
						</div>

						<div class="col-md-6 form-group">
						    <label for="rigidity" style="color:#A8A8A8;">Do you suffer from a rigidity of facial expression?</label>
						    <select id="rigidity" name="rigidity" class=" form-control" required>
							  <option value="">Choose a symptom</option>
						  <option value="No symptoms">No symptoms</option>
						  <option value="Mild and occasional symptoms">Mild and occasional symptoms</option>
						  <option value="Mild and regular symptoms">Mild and regular symptoms</option>
						  <option value="Mild and constant symptoms">Mild and constant symptoms</option>
						  <option value="Moderate and occasional symptoms">Moderate and occasional symptoms</option>
						  <option value="Moderate and regular symptoms">Moderate and regular symptoms</option>
						  <option value="Moderate and constant symptoms">Moderate and constant symptoms</option>
						  <option value="Severe and occasional symptoms">Severe and occasional symptoms</option>
						  <option value="Severe and regular symptoms">Severe and regular symptoms</option>
						  <option value="Severe and constant symptoms">Severe and constant symptoms</option>
							</select>
						</div>

						<div class="col-md-6 form-group">
						    <label for="exertionf" style="color:#A8A8A8;">Do you feel fatigued after 5 minutes exertion?</label>
						    <select id="exertionf" name="exertionf" class=" form-control" required>
							  <option value="">Choose a symptom</option>
						  <option value="No symptoms">No symptoms</option>
						  <option value="Mild and occasional symptoms">Mild and occasional symptoms</option>
						  <option value="Mild and regular symptoms">Mild and regular symptoms</option>
						  <option value="Mild and constant symptoms">Mild and constant symptoms</option>
						  <option value="Moderate and occasional symptoms">Moderate and occasional symptoms</option>
						  <option value="Moderate and regular symptoms">Moderate and regular symptoms</option>
						  <option value="Moderate and constant symptoms">Moderate and constant symptoms</option>
						  <option value="Severe and occasional symptoms">Severe and occasional symptoms</option>
						  <option value="Severe and regular symptoms">Severe and regular symptoms</option>
						  <option value="Severe and constant symptoms">Severe and constant symptoms</option>
							</select>
						</div>

						<div class="col-md-6 form-group" style="margin-top:-10px;">
						    <label for="exertions" style="color:#A8A8A8;">Do you get an increase in severity of symptoms 1-3 days after exertion?</label>
						    <select id="exertions" name="exertions" class=" form-control" required>
							  <option value="">Choose a symptom</option>
						  <option value="No symptoms">No symptoms</option>
						  <option value="Mild and occasional symptoms">Mild and occasional symptoms</option>
						  <option value="Mild and regular symptoms">Mild and regular symptoms</option>
						  <option value="Mild and constant symptoms">Mild and constant symptoms</option>
						  <option value="Moderate and occasional symptoms">Moderate and occasional symptoms</option>
						  <option value="Moderate and regular symptoms">Moderate and regular symptoms</option>
						  <option value="Moderate and constant symptoms">Moderate and constant symptoms</option>
						  <option value="Severe and occasional symptoms">Severe and occasional symptoms</option>
						  <option value="Severe and regular symptoms">Severe and regular symptoms</option>
						  <option value="Severe and constant symptoms">Severe and constant symptoms</option>
							</select>
						</div>
						</div>
						<!-- scores section -->
						<div class="col-md-4">
							<h3 class="page-header text-center">Score -> <?php echo $subtotal5; ?> / 72</h3>
							<input type="hidden" id="subtotal5" value="<?php echo $subtotal5; ?>" >
						<div id="container4" style="min-width: 210px; height: 300px; max-width: 500px; margin: 0 auto"></div>
						</div>
					  </div>	
					  <!-- section 5 end ---->

					<div class="row">
						<div class="col-md-8">
						<h3 class="page-header text-center">Feedback Form.</h3>
						<div class="col-md-12 form-group">
						    
						    <textarea id="feedback" name="feedback" class="form-control" rows="10" placeholder="Please give your feedback"></textarea>
						</div>

						</div>

						 <!-- overall score ---->
						<div class="col-md-4">
							<h3 class="page-header text-center">Overall Score -> <?php echo $total; ?> / 297</h3>
							<input type="hidden" id="total" value="<?php echo $total; ?>" >
						<div id="container5" style="min-width: 210px; height: 300px; max-width: 500px; margin: 0 auto"></div>
						</div>
						
					  </div>	
					  <!-- section 5 end ---->


					<div class="col-md-12 text-center">
				  	<button type="submit" id="submit" name="submit" class="col-md-8 btn btn-primary">Submit</button>
					</div>
				</form>
				
			

			<!--- scores section ---->

			<div class="col-md-12 space">
			<h4 style="color:#A8A8A8;">Thank you to the Hummingbird Foundation, for a very informative website on all aspects of ME (www.hfme.org).</h4>
			<p style="color:#A8A8A8;">This has been an invaluable resource in helping to pull together this evaluation checksheet to assess the benefits or otherwise of natural treatments
that do not go through the standard accepted clinic trial process.</p>
			</div>

			<div class="col-md-12 text-center">
			<h3 class="page-header text-center">Patient History</h3>
			<table class="table table-bordered">
			    <thead>
			      <tr>
			        <th>Date </th>
			        <th>Username </th>
			        <th>Neurological signs and symptoms</th>
			        <th>Cardiovascular signs and symptoms</th>
			        <th>Muscular signs and symptoms</th>
			        <th>Cognition signs and symptoms</th>
			        <th>Other signs and symptoms</th>
			        <th>Overall Score</th>
			      </tr>
			    </thead>
			    <tbody>
			    <?php if(!empty($records)) { ?>
			    <?php foreach($records as $record) { ?>
			      <tr>
			        <td><?php echo $record['created_at']; ?></td>
			        <td><?php echo $record['username']; ?></td>
			        <td><?php echo $record['subtotal1']; ?></td>
			        <td><?php echo $record['subtotal2']; ?></td>
			        <td><?php echo $record['subtotal3']; ?></td>
			        <td><?php echo $record['subtotal4']; ?></td>
			        <td><?php echo $record['subtotal5']; ?></td>
			        <td><?php echo $record['total']; ?></td>
			      </tr>

			     <?php } ?>
			     <?php } ?>

			    </tbody>
			  </table>
			</div>

			<!-- Feedback history -->
			<div class="col-md-12 text-center">
			<h3 class="page-header text-center">Feedback History</h3>
			<table class="table table-bordered">
			    <thead class="text-center">
			      <tr>
			        <th class="text-center">Date </th>
			        <th class="text-center">username </th>
			        <th class="text-center" >Feedback</th>
			        <th class="text-center">Overall Score</th>
			        <th class="text-center" style="width:300px">Pie Chart</th>
			      </tr>
			    </thead>
			    <tbody>
			     <?php if(!empty($feedbacks)) { ?>
			    <?php foreach($feedbacks as $feedback) { ?>
			      <tr>
			        <td><?php echo $feedback['created_at']; ?></td>
			         <td><?php echo $feedback['username']; ?></td>
			        <td><?php echo $feedback['feedback']; ?></td>
					<td><?php echo $feedback['total']; ?></td>
					<td><input type="button" style="display:none;"id="feedbacktotal" value="<?php echo $feedback['total']; ?>" >
						<div class="containerfb" data-total="<?php echo $feedback['total']; ?>" style="min-width: 210px; height: 300px; max-width: 500px; margin: 0 auto"></div></td>

			      </tr>

			     <?php } ?>
			     <?php } ?>
			    </tbody>
			  </table>
			</div>

		</div>
	</div>

</body>
</html>