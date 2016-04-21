<?php 
	require_once 'db_connect.php';
	require_once 'libs/PHPMailer/PHPMailerAutoload.php';
	require_once 'header.php';
	$m = new PHPMailer();

	$m->isSMTP();
	$m->SMTPAuth = true;
	 //$m->SMTPDebug = 2;

	$m->Host = 'smtp.gmail.com';
	$m->Username = 'akashmudliyar@gmail.com';
	$m->Password = 'gauridurai';
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
	$subtotala1 = '';$subtotala2 = '';$subtotala3 = '';$subtotala4 = '';$subtotala5 = '';$atectotal = '';
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

		for ($x = 1; $x <= 14; $x++) {
			$text = 'speech'.$x;
  			$data[] = $_POST[$text];
		}

		for ($x = 1; $x <= 20; $x++) {
			$text = 'social'.$x;
  			$data1[] = $_POST[$text];
		}

		for ($x = 1; $x <= 18; $x++) {
			$text = 'sense'.$x;
  			$data2[] = $_POST[$text];
		}
		
		for ($x = 1; $x <= 25; $x++) {
			$text = 'behave'.$x;
  			$data3[] = $_POST[$text];
		}
		

		if (!empty($_POST["feedback"])) {
		    $feedback = $_POST['feedback'];

		  } else {
		   $feedback = '';
		    
		  }
		
		
		

	$subtotala1 = array_sum($data);
	$subtotala2 = array_sum($data1);
	$subtotala3 = array_sum($data2);
	$subtotala4 = array_sum($data3);



	$atectotal = $subtotala1 + $subtotala2 + $subtotala3 + $subtotala4;
	//echo $atectotal;
	if($flag){
	$result = insert_atec_data($username,$email,$subtotala1,$subtotala2,$subtotala3,$subtotala4,$atectotal,$feedback);
	$m->From = 'akashmudliyar@gmail.comm ';
	$m->FromName = 'Admin';
	$m->addReplyTo('reply@gmail.com','Reply address');
	$m->addAddress($email, $username);

	$m->isHTML(true);

	$m->Subject = 'Atec Form Details And Scores';
	$m->Body = '<p><h3>Dear '.$username. ',</h3> <p>Following are the scores for the survey taken on the cointec website.</p> <h4>Speech, Language and Communication  -><b style="color:#f00">'.$subtotala1.'</b>/28</h4>';
	$m->Body .= '<h4>Sociability Maximum  -><b style="color:#f00">'.$subtotala2.'</b>/20</h4>';
	$m->Body .= '<h4>Cognitive and sensory awareness  -><b style="color:#f00">'.$subtotala3.'</b>/36</h4>';
	$m->Body .= '<h4>Health and physical behaviour	 -><b style="color:#f00">'.$subtotala4.'</b>/75</h4>';
	$m->Body .= '<h4>Total Score -><b style="color:#f00">'.$atectotal.'</b>/179</p>';
	$m->Body .= '<h4>Feedback Comments -><b style="color:#f00">'.$feedback.'</h4></p>';

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

	//$records = get_history1($username);

	$feedbacks = get_feedback_atec();
	
	

?>


<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      
      <a class="navbar-brand" href="index.php">Treatment Checklists</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      
      
      <ul class="nav navbar-nav navbar-right">
        <li><a href="atec_history.php" class="btn btn-info" style="color:#fff;font-weight:bold;">Check History</a></li>
        <li><a href="#" class="btn btn-danger" style="color:#fff;font-weight:bold;">ATEC</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

	<div class="container">
		<h3 class="page-header text-center">ATEC - Autism Treatment Evaluation Checklist.</h3>
		<h4 class="text-center" style="color:#A8A8A8;margin-bottom:50px;">Sponsored by MAFActive - www.mafactive.eu</h4>

		<!-- h4 style="color:#A8A8A8;">Score sheet for assessing ME, CFS, Lyme disease and associated ailments.</h4>
		<p style="color:#A8A8A8;">On a scale of zero to ten, where zero is no symptoms and ten is severe symptoms, please indicate where you are on the following questions.</p>
 -->
		<div class="row">
			<div class="col-md-12">
				
				
				<form action="" method="post" id="atec">
				<!-- section 1 start ---->
				<div class="row">
					<div class="col-md-8">
					<h3 class="page-header text-center">Personal Details</h3>
				<div class="col-md-6 form-group">
					<input type="text" name="username" id="username" placeholder="Enter first name of person being assessed.." class="form-control required"/>	
					<span class="error" style="color:#f00;">* <?php echo $nameErr;?></span>
				</div>
				<div class="col-md-6 form-group">
					
					<input type="text" name="email" id="email" placeholder="Please enter your email address.." class="form-control required" required/>
				</div>
				</div>
				<div class="col-md-8">
				
				<h3 class="page-header text-center">Speech, Language and Communication .</h3>
					<div class="col-md-6 form-group">
					    <label for="speech1" style="color:#A8A8A8;">Knows own name </label>
					    <select id="speech1" name="speech1" class="form-control required" required>
					      <option value="">Choose an option</option>
						  <option value="0">Yes</option>
						  <option value="1">Sometimes </option>
						  <option value="2">No</option>
						</select>
					</div>

					<div class="col-md-6 form-group">
					    <label for="speech2" style="color:#A8A8A8;">Responds to 'No' or 'Stop' </label>
					    <select id="speech2" name="speech2" class="form-control required" required>
					      <option value="">Choose an option</option>
					      <option value="0">Yes</option>
						  <option value="1">Sometimes </option>
						  <option value="2">No</option>
						</select>
					</div>

					<div class="col-md-6 form-group">
					    <label for="speech3" style="color:#A8A8A8;">Can follow some commands  </label>
					    <select id="speech3" name="speech3" class="form-control required" required>
					      <option value="">Choose an option</option>
						  <option value="0">Yes</option>
						  <option value="1">Sometimes </option>
						  <option value="2">No</option>
						</select>
					</div>

					<div class="col-md-6 form-group">
					    <label for="speech4" style="color:#A8A8A8;">Can use just one word at a time (No, eat, water etc)  </label>
					    <select id="speech4" name="speech4" class="form-control required" required>
					      <option value="">Choose an option</option>
						  <option value="0">no, uses more </option>
						  <option value="1">yes </option>
						  <option value="2">uses less</option>
						</select>
					</div>

					<div class="col-md-6 form-group">
					    <label for="speech5" style="color:#A8A8A8;">Can use two words at a time (don’t want, go home) </label>
					    <select id="speech5" name="speech5" class="form-control required" required>
					      <option value="">Choose an option</option>
						  <option value="0">no, uses more </option>
						  <option value="1">yes </option>
						  <option value="2">uses less</option>
						</select>
					</div>

					<div class="col-md-6 form-group">
					    <label for="speech6" style="color:#A8A8A8;">Can use three words at a time (want more milk etc) </label>
					    <select id="speech6" name="speech6" class="form-control required" required>
					    <option value="">Choose an option</option>
					      <option value="0">no, uses more </option>
						  <option value="1">yes </option>
						  <option value="2">uses less</option>
						</select>
					</div>

					<div class="col-md-6 form-group">
					    <label for="speech7" style="color:#A8A8A8;">Knows 10 or more words </label>
					    <select id="speech7" name="speech7" class="form-control required" required>
					      <option value="">Choose an option</option>
						  <option value="0">Yes</option>
						  <option value="1">Sometimes </option>
						  <option value="2">No</option>
						</select>
					</div>

					<div class="col-md-6 form-group">
					    <label for="speech8" style="color:#A8A8A8;">Can use sentences with 4 or more words </label>
					    <select id="speech8" name="speech8" class="form-control required" required>
					      <option value="">Choose an option</option>
						  <option value="0">Yes</option>
						  <option value="1">Sometimes </option>
						  <option value="2">No</option>
						</select>
					</div>

					<div class="col-md-6 form-group">
					    <label for="speech9" style="color:#A8A8A8;">Can explain what he / she wants </label>
					    <select id="speech9" name="speech9" class="form-control required" required>
					      <option value="">Choose an option</option>
						  <option value="0">Yes</option>
						  <option value="1">Sometimes </option>
						  <option value="2">No</option>
						</select>
					</div>

					<div class="col-md-6 form-group">
					    <label for="speech10" style="color:#A8A8A8;">Can ask meaningful questions  </label>
					    <select id="speech10" name="speech10" class="form-control required" required>
					      <option value="">Choose an option</option>
						  <option value="0">Yes</option>
						  <option value="1">Sometimes </option>
						  <option value="2">No</option>
						</select>
					</div>

					<div class="col-md-6 form-group">
					    <label for="speech11" style="color:#A8A8A8;">Speech tends to be meaningful / relevant   </label>
					    <select id="speech11" name="speech11" class="form-control required" required>
					      <option value="">Choose an option</option>
						  <option value="0">Yes</option>
						  <option value="1">Sometimes </option>
						  <option value="2">No</option>
						</select>
					</div>

					<div class="col-md-6 form-group">
					    <label for="speech12" style="color:#A8A8A8;">Often uses several successive sentences   </label>
					    <select id="speech12" name="speech12" class="form-control required" required>
					      <option value="">Choose an option</option>
						  <option value="0">Yes</option>
						  <option value="1">Sometimes </option>
						  <option value="2">No</option>
						</select>
					</div>

					<div class="col-md-6 form-group">
					    <label for="speech13" style="color:#A8A8A8;">Carries on a fairly good conversations </label>
					    <select id="speech13" name="speech13" class="form-control required" required>
					      <option value="">Choose an option</option>
						  <option value="0">Yes</option>
						  <option value="1">Sometimes </option>
						  <option value="2">No</option>
						</select>
					</div>

					<div class="col-md-6 form-group">
					    <label for="speech14" style="color:#A8A8A8;">Has normal ability to communicate for his / her age  </label>
					    <select id="speech14" name="speech14" class="form-control required" required>
					      <option value="">Choose an option</option>
						  <option value="0">Yes</option>
						  <option value="1">Sometimes </option>
						  <option value="2">No</option>
						</select>
					</div>




				</div>

					<!-- scores section -->
					<div class="col-md-4">
						<h3 class="page-header text-center">Score -> <?php echo $subtotala1; ?> / 28</h3>
						<input type="hidden" id="subtotala1" value="<?php echo $subtotala1; ?>" >
						<div id="containeratec" style="min-width: 210px; height: 300px; max-width: 500px; margin: 0 auto"></div>
					</div>
				 	</div>

				 	<!-- section 1 end ---->

				 	<!-- section 2 start ---->
				
				 	<div class="row">
					<div class="col-md-8">
					<h3 class="page-header text-center">Sociability Maximum.</h3>
						<div class="col-md-6 form-group">
						    <label for="social1" style="color:#A8A8A8;">Seems to be in a shell, you cannot reach him /her age </label>
						    <select id="social1" name="social1" class="form-control required" required>
						  <option value="">Choose an option</option>
						  <option value="0">No</option>
						  <option value="1">Sometimes </option>
						  <option value="2">Yes</option>
							</select>
						</div>

						<div class="col-md-6 form-group">
						    <label for="social2" style="color:#A8A8A8;">Ignores other people</label>
						    <select id="social2" name="social2" class="form-control required" required>
						  <option value="">Choose an option</option>
						  <option value="0">No</option>
						  <option value="1">Sometimes </option>
						  <option value="2">Yes</option>
							</select>
						</div>

						<div class="col-md-6 form-group">
						    <label for="social3" style="color:#A8A8A8;">Pays little or no attention when addressed </label>
						    <select id="social3" name="social3" class="form-control required" required>
						  <option value="">Choose an option</option>
						  <option value="0">No</option>
						  <option value="1">Sometimes </option>
						  <option value="2">Yes</option>
							</select>
						</div>

						<div class="col-md-6 form-group">
						    <label for="social4" style="color:#A8A8A8;">Uncooperative and resistant </label>
						    <select id="social4" name="social4" class="form-control required" required>
						  <option value="">Choose an option</option>
						  <option value="0">No</option>
						  <option value="1">Sometimes </option>
						  <option value="2">Yes</option>
							</select>
						</div>

						<div class="col-md-6 form-group">
						    <label for="social5" style="color:#A8A8A8;">No eye contact </label>
						    <select id="social5" name="social5" class="form-control required" required>
						  <option value="">Choose an option</option>
						  <option value="0">No</option>
						  <option value="1">Sometimes </option>
						  <option value="2">Yes</option>
							</select>
						</div>

						<div class="col-md-6 form-group">
						    <label for="social6" style="color:#A8A8A8;">Prefers to be left alone </label>
						    <select id="social6" name="social6" class="form-control required" required>
						  <option value="">Choose an option</option>
						  <option value="0">No</option>
						  <option value="1">Sometimes </option>
						  <option value="2">Yes</option>
							</select>
						</div>

						<div class="col-md-6 form-group">
						    <label for="social7" style="color:#A8A8A8;">Shows no affection </label>
						    <select id="social7" name="social7" class="form-control required" required>
						  <option value="">Choose an option</option>
						  <option value="0">No</option>
						  <option value="1">Sometimes </option>
						  <option value="2">Yes</option>
							</select>
						</div>

						<div class="col-md-6 form-group">
						    <label for="social8" style="color:#A8A8A8;">Fails to greet parents  </label>
						    <select id="social8" name="social8" class="form-control required" required>
						  <option value="">Choose an option</option>
						  <option value="0">No</option>
						  <option value="1">Sometimes </option>
						  <option value="2">Yes</option>
							</select>
						</div>

						<div class="col-md-6 form-group">
						    <label for="social9" style="color:#A8A8A8;">Avoids contact with others  </label>
						    <select id="social9" name="social9" class="form-control required" required>
						  <option value="">Choose an option</option>
						  <option value="0">No</option>
						  <option value="1">Sometimes </option>
						  <option value="2">Yes</option>
							</select>
						</div>

						<div class="col-md-6 form-group">
						    <label for="social10" style="color:#A8A8A8;">Does not imitate others  </label>
						    <select id="social10" name="social10" class="form-control required" required>
						  <option value="">Choose an option</option>
						  <option value="0">No</option>
						  <option value="1">Sometimes </option>
						  <option value="2">Yes</option>
							</select>
						</div>

						<div class="col-md-6 form-group">
						    <label for="social11" style="color:#A8A8A8;">Dislikes being held / cuddled </label>
						    <select id="social11" name="social11" class="form-control required" required>
						  <option value="">Choose an option</option>
						  <option value="0">No</option>
						  <option value="1">Sometimes </option>
						  <option value="2">Yes</option>
							</select>
						</div>

						<div class="col-md-6 form-group">
						    <label for="social12" style="color:#A8A8A8;">Does not show or share  </label>
						    <select id="social12" name="social12" class="form-control required" required>
						  <option value="">Choose an option</option>
						  <option value="0">No</option>
						  <option value="1">Sometimes </option>
						  <option value="2">Yes</option>
							</select>
						</div>

						<div class="col-md-6 form-group">
						    <label for="social13" style="color:#A8A8A8;">Does not wave goodbye </label>
						    <select id="social13" name="social13" class="form-control required" required>
						  <option value="">Choose an option</option>
						  <option value="0">No</option>
						  <option value="1">Sometimes </option>
						  <option value="2">Yes</option>
							</select>
						</div>

						<div class="col-md-6 form-group">
						    <label for="social14" style="color:#A8A8A8;">Disagreeable / not compliant </label>
						    <select id="social14" name="social14" class="form-control required" required>
						  <option value="">Choose an option</option>
						  <option value="0">No</option>
						  <option value="1">Sometimes </option>
						  <option value="2">Yes</option>
							</select>
						</div>

						<div class="col-md-6 form-group">
						    <label for="social15" style="color:#A8A8A8;">Temper tantrums</label>
						    <select id="social15" name="social15" class="form-control required" required>
						  <option value="">Choose an option</option>
						  <option value="0">No</option>
						  <option value="1">Sometimes </option>
						  <option value="2">Yes</option>
							</select>
						</div>

						<div class="col-md-6 form-group">
						    <label for="social16" style="color:#A8A8A8;">Lacks friends or companions </label>
						    <select id="social16" name="social16" class="form-control required" required>
						  <option value="">Choose an option</option>
						  <option value="0">No</option>
						  <option value="1">Sometimes </option>
						  <option value="2">Yes</option>
							</select>
						</div>

						<div class="col-md-6 form-group">
						    <label for="social17" style="color:#A8A8A8;">Rarely smiles  </label>
						    <select id="social17" name="social17" class="form-control required" required>
						  <option value="">Choose an option</option>
						  <option value="0">No</option>
						  <option value="1">Sometimes </option>
						  <option value="2">Yes</option>
							</select>
						</div>

						<div class="col-md-6 form-group">
						    <label for="social18" style="color:#A8A8A8;">Insensitive to others feelings </label>
						    <select id="social18" name="social18" class="form-control required" required>
						  <option value="">Choose an option</option>
						  <option value="0">No</option>
						  <option value="1">Sometimes </option>
						  <option value="2">Yes</option>
							</select>
						</div>

						<div class="col-md-6 form-group">
						    <label for="social19" style="color:#A8A8A8;">Indifferent to being liked  </label>
						    <select id="social19" name="social19" class="form-control required" required>
						  <option value="">Choose an option</option>
						  <option value="0">No</option>
						  <option value="1">Sometimes </option>
						  <option value="2">Yes</option>
							</select>
						</div>

						<div class="col-md-6 form-group">
						    <label for="social20" style="color:#A8A8A8;">Indifferent if parents leave </label>
						    <select id="social20" name="social20" class="form-control required" required>
						  <option value="">Choose an option</option>
						  <option value="0">No</option>
						  <option value="1">Sometimes </option>
						  <option value="2">Yes</option>
							</select>
						</div>
					</div>
					<!-- scores section -->
					<div class="col-md-4">
						<h3 class="page-header text-center">Score -> <?php echo $subtotala2; ?> / 40</h3>
						<input type="hidden" id="subtotala2" value="<?php echo $subtotala2; ?>" >
						<div id="containeratec1" style="min-width: 210px; height: 300px; max-width: 500px; margin: 0 auto"></div>
					</div>
					</div>
					<!-- section 2 end ---->

					<!-- section 3 start ---->
					<div class="row">
						<div class="col-md-8">
						<h3 class="page-header text-center">Cognitive and sensory awareness .</h3>
							<div class="col-md-6 form-group">
					    <label for="sense1" style="color:#A8A8A8;">Responds to own name </label>
					    <select id="sense1" name="sense1" class="form-control required" required>
					      <option value="">Choose an option</option>
						  <option value="0">Yes</option>
						  <option value="1">Sometimes </option>
						  <option value="2">No</option>
						</select>
					</div>

					<div class="col-md-6 form-group">
					    <label for="sense2" style="color:#A8A8A8;">Responds to praise </label>
					    <select id="sense2" name="sense2" class="form-control required" required>
					      <option value="">Choose an option</option>
					      <option value="0">Yes</option>
						  <option value="1">Sometimes </option>
						  <option value="2">No</option>
						</select>
					</div>

					<div class="col-md-6 form-group">
					    <label for="sense3" style="color:#A8A8A8;">Looks at people and animals  </label>
					    <select id="sense3" name="sense3" class="form-control required" required>
					      <option value="">Choose an option</option>
						  <option value="0">Yes</option>
						  <option value="1">Sometimes </option>
						  <option value="2">No</option>
						</select>
					</div>

					<div class="col-md-6 form-group">
					    <label for="sense4" style="color:#A8A8A8;">Looks at pictures and TV  </label>
					    <select id="sense4" name="sense4" class="form-control required" required>
					      <option value="">Choose an option</option>
						  <option value="0">Yes</option>
						  <option value="1">Sometimes </option>
						  <option value="2">No</option>
						</select>
					</div>

					<div class="col-md-6 form-group">
					    <label for="sense5" style="color:#A8A8A8;">Does drawing, colouring, art </label>
					    <select id="sense5" name="sense5" class="form-control required" required>
					      <option value="">Choose an option</option>
						  <option value="0">Yes</option>
						  <option value="1">Sometimes </option>
						  <option value="2">No</option>
						</select>
					</div>

					<div class="col-md-6 form-group">
					    <label for="sense6" style="color:#A8A8A8;">Plays with toys appropriately </label>
					    <select id="sense6" name="sense6" class="form-control required" required>
					    <option value="">Choose an option</option>
					      <option value="0">Yes</option>
						  <option value="1">Sometimes </option>
						  <option value="2">No</option>
						</select>
					</div>

					<div class="col-md-6 form-group">
					    <label for="sense7" style="color:#A8A8A8;">Appropriate facial expressions </label>
					    <select id="sense7" name="sense7" class="form-control required" required>
					      <option value="">Choose an option</option>
						  <option value="0">Yes</option>
						  <option value="1">Sometimes </option>
						  <option value="2">No</option>
						</select>
					</div>

					<div class="col-md-6 form-group">
					    <label for="sense8" style="color:#A8A8A8;">Understands stories on TV </label>
					    <select id="sense8" name="sense8" class="form-control required" required>
					      <option value="">Choose an option</option>
						  <option value="0">Yes</option>
						  <option value="1">Sometimes </option>
						  <option value="2">No</option>
						</select>
					</div>

					<div class="col-md-6 form-group">
					    <label for="sense9" style="color:#A8A8A8;">Understands explanations </label>
					    <select id="sense9" name="sense9" class="form-control required" required>
					      <option value="">Choose an option</option>
						  <option value="0">Yes</option>
						  <option value="1">Sometimes </option>
						  <option value="2">No</option>
						</select>
					</div>

					<div class="col-md-6 form-group">
					    <label for="sense10" style="color:#A8A8A8;">Aware of environment </label>
					    <select id="sense10" name="sense10" class="form-control required" required>
					      <option value="">Choose an option</option>
						  <option value="0">Yes</option>
						  <option value="1">Sometimes </option>
						  <option value="2">No</option>
						</select>
					</div>

					<div class="col-md-6 form-group">
					    <label for="sense11" style="color:#A8A8A8;">Aware of danger  / relevant   </label>
					    <select id="sense11" name="sense11" class="form-control required" required>
					      <option value="">Choose an option</option>
						  <option value="0">Yes</option>
						  <option value="1">Sometimes </option>
						  <option value="2">No</option>
						</select>
					</div>

					<div class="col-md-6 form-group">
					    <label for="sense12" style="color:#A8A8A8;">Shows imagination  </label>
					    <select id="sense12" name="sense12" class="form-control required" required>
					      <option value="">Choose an option</option>
						  <option value="0">Yes</option>
						  <option value="1">Sometimes </option>
						  <option value="2">No</option>
						</select>
					</div>

					<div class="col-md-6 form-group">
					    <label for="sense13" style="color:#A8A8A8;">Initiates activities  </label>
					    <select id="sense13" name="sense13" class="form-control required" required>
					      <option value="">Choose an option</option>
						  <option value="0">Yes</option>
						  <option value="1">Sometimes </option>
						  <option value="2">No</option>
						</select>
					</div>

					<div class="col-md-6 form-group">
					    <label for="sense14" style="color:#A8A8A8;">Dresses self </label>
					    <select id="sense14" name="sense14" class="form-control required" required>
					      <option value="">Choose an option</option>
						  <option value="0">Yes</option>
						  <option value="1">Sometimes </option>
						  <option value="2">No</option>
						</select>
					</div>

					<div class="col-md-6 form-group">
					    <label for="sense15" style="color:#A8A8A8;">Curous, interested  </label>
					    <select id="sense15" name="sense15" class="form-control required" required>
					      <option value="">Choose an option</option>
						  <option value="0">Yes</option>
						  <option value="1">Sometimes </option>
						  <option value="2">No</option>
						</select>
					</div>

					<div class="col-md-6 form-group">
					    <label for="sense16" style="color:#A8A8A8;">Venturesome, explores </label>
					    <select id="sense16" name="sense16" class="form-control required" required>
					      <option value="">Choose an option</option>
						  <option value="0">Yes</option>
						  <option value="1">Sometimes </option>
						  <option value="2">No</option>
						</select>
					</div>

					<div class="col-md-6 form-group">
					    <label for="sense17" style="color:#A8A8A8;">Tuned in, not spacey </label>
					    <select id="sense17" name="sense17" class="form-control required" required>
					      <option value="">Choose an option</option>
						  <option value="0">Yes</option>
						  <option value="1">Sometimes </option>
						  <option value="2">No</option>
						</select>
					</div>

					<div class="col-md-6 form-group">
					    <label for="sense18" style="color:#A8A8A8;">Looks where others are looking  </label>
					    <select id="sense18" name="sense18" class="form-control required" required>
					      <option value="">Choose an option</option>
						  <option value="0">Yes</option>
						  <option value="1">Sometimes </option>
						  <option value="2">No</option>
						</select>
					</div>

					</div>
						<!-- scores section -->
						<div class="col-md-4">
							<h3 class="page-header text-center">Score -> <?php echo $subtotala3; ?> / 36</h3>
							<input type="hidden" id="subtotala3" value="<?php echo $subtotala3; ?>" >
						<div id="containeratec2" style="min-width: 210px; height: 300px; max-width: 500px; margin: 0 auto"></div>
						</div>
					  </div>	
					  <!-- section 3 end ---->

					<!-- section 4 start ---->
					<div class="row">
						<div class="col-md-8">
						<h3 class="page-header text-center">Health and physical behaviour. </h3>
						<div class="col-md-6 form-group">
						    <label for="behave1" style="color:#A8A8A8;">Bedwetting</label>
						    <select id="behave1" name="behave1" class="form-control required" required>
							  <option value="">Choose an option</option>
						  <option value="0">Not a problem </option>
						  <option value="1">minor problem </option>
						  <option value="2">moderate problem </option>
						  <option value="3">serious problem</option>
							</select>
						</div>

						<div class="col-md-6 form-group">
						    <label for="behave2" style="color:#A8A8A8;">Wets pants or diapers </label>
						    <select id="behave2" name="behave2" class="form-control required" required>
							  <option value="">Choose an option</option>
						  <option value="0">Not a problem </option>
						  <option value="1">minor problem </option>
						  <option value="2">moderate problem </option>
						  <option value="3">serious problem</option>
							</select>
						</div>

						<div class="col-md-6 form-group">
						    <label for="behave3" style="color:#A8A8A8;">Soils pants or diapers </label>
						    <select id="behave3" name="behave3" class="form-control required" required>
							  <option value="">Choose an option</option>
						  <option value="0">Not a problem </option>
						  <option value="1">minor problem </option>
						  <option value="2">moderate problem </option>
						  <option value="3">serious problem</option>
							</select>
						</div>
						<div class="col-md-6 form-group">
						    <label for="behave4" style="color:#A8A8A8;">Diarrhoea </label>
						    <select id="behave4" name="behave4" class="form-control required" required>
							  <option value="">Choose an option</option>
						  <option value="0">Not a problem </option>
						  <option value="1">minor problem </option>
						  <option value="2">moderate problem </option>
						  <option value="3">serious problem</option>
							</select>
						</div>
						<div class="col-md-6 form-group">
						    <label for="behave5" style="color:#A8A8A8;">Constipation </label>
						    <select id="behave5" name="behave5" class="form-control required" required>
							  <option value="">Choose an option</option>
						  <option value="0">Not a problem </option>
						  <option value="1">minor problem </option>
						  <option value="2">moderate problem </option>
						  <option value="3">serious problem</option>
							</select>
						</div>
						<div class="col-md-6 form-group">
						    <label for="behave6" style="color:#A8A8A8;">Sleep problems </label>
						    <select id="behave6" name="behave6" class="form-control required" required>
							  <option value="">Choose an option</option>
						  <option value="0">Not a problem </option>
						  <option value="1">minor problem </option>
						  <option value="2">moderate problem </option>
						  <option value="3">serious problem</option>
							</select>
						</div>
						<div class="col-md-6 form-group">
						    <label for="behave7" style="color:#A8A8A8;">Eats too much or too little </label>
						    <select id="behave7" name="behave7" class="form-control required" required>
							  <option value="">Choose an option</option>
						  <option value="0">Not a problem </option>
						  <option value="1">minor problem </option>
						  <option value="2">moderate problem </option>
						  <option value="3">serious problem</option>
							</select>
						</div>
						<div class="col-md-6 form-group">
						    <label for="behave8" style="color:#A8A8A8;">Extremely limited diet </label>
						    <select id="behave8" name="behave8" class="form-control required" required>
							  <option value="">Choose an option</option>
						  <option value="0">Not a problem </option>
						  <option value="1">minor problem </option>
						  <option value="2">moderate problem </option>
						  <option value="3">serious problem</option>
							</select>
						</div>
						<div class="col-md-6 form-group">
						    <label for="behave9" style="color:#A8A8A8;">Hyperactive </label>
						    <select id="behave9" name="behave9" class="form-control required" required>
							  <option value="">Choose an option</option>
						  <option value="0">Not a problem </option>
						  <option value="1">minor problem </option>
						  <option value="2">moderate problem </option>
						  <option value="3">serious problem</option>
							</select>
						</div>
						<div class="col-md-6 form-group">
						    <label for="behave10" style="color:#A8A8A8;">Lethargic </label>
						    <select id="behave10" name="behave10" class="form-control required" required>
							  <option value="">Choose an option</option>
						  <option value="0">Not a problem </option>
						  <option value="1">minor problem </option>
						  <option value="2">moderate problem </option>
						  <option value="3">serious problem</option>
							</select>
						</div>
						<div class="col-md-6 form-group">
						    <label for="behave11" style="color:#A8A8A8;">Hits or injures self </label>
						    <select id="behave11" name="behave11" class="form-control required" required>
							  <option value="">Choose an option</option>
						  <option value="0">Not a problem </option>
						  <option value="1">minor problem </option>
						  <option value="2">moderate problem </option>
						  <option value="3">serious problem</option>
							</select>
						</div>
						<div class="col-md-6 form-group">
						    <label for="behave12" style="color:#A8A8A8;">Hits or injures others </label>
						    <select id="behave12" name="behave12" class="form-control required" required>
							  <option value="">Choose an option</option>
						  <option value="0">Not a problem </option>
						  <option value="1">minor problem </option>
						  <option value="2">moderate problem </option>
						  <option value="3">serious problem</option>
							</select>
						</div>
						<div class="col-md-6 form-group">
						    <label for="behave13" style="color:#A8A8A8;">Destructive </label>
						    <select id="behave13" name="behave13" class="form-control required" required>
							  <option value="">Choose an option</option>
						  <option value="0">Not a problem </option>
						  <option value="1">minor problem </option>
						  <option value="2">moderate problem </option>
						  <option value="3">serious problem</option>
							</select>
						</div>
						<div class="col-md-6 form-group">
						    <label for="behave14" style="color:#A8A8A8;">Sound sensitive </label>
						    <select id="behave14" name="behave14" class="form-control required" required>
							  <option value="">Choose an option</option>
						  <option value="0">Not a problem </option>
						  <option value="1">minor problem </option>
						  <option value="2">moderate problem </option>
						  <option value="3">serious problem</option>
							</select>
						</div>
						<div class="col-md-6 form-group">
						    <label for="behave15" style="color:#A8A8A8;">Anxious / fearful </label>
						    <select id="behave15" name="behave15" class="form-control required" required>
							  <option value="">Choose an option</option>
						  <option value="0">Not a problem </option>
						  <option value="1">minor problem </option>
						  <option value="2">moderate problem </option>
						  <option value="3">serious problem</option>
							</select>
						</div>
						<div class="col-md-6 form-group">
						    <label for="behave16" style="color:#A8A8A8;">Unhappy / crying </label>
						    <select id="behave16" name="behave16" class="form-control required" required>
							  <option value="">Choose an option</option>
						  <option value="0">Not a problem </option>
						  <option value="1">minor problem </option>
						  <option value="2">moderate problem </option>
						  <option value="3">serious problem</option>
							</select>
						</div>
						<div class="col-md-6 form-group">
						    <label for="behave17" style="color:#A8A8A8;">Seizures </label>
						    <select id="behave17" name="behave17" class="form-control required" required>
							  <option value="">Choose an option</option>
						  <option value="0">Not a problem </option>
						  <option value="1">minor problem </option>
						  <option value="2">moderate problem </option>
						  <option value="3">serious problem</option>
							</select>
						</div>
						<div class="col-md-6 form-group">
						    <label for="behave18" style="color:#A8A8A8;">Obsessive speech </label>
						    <select id="behave18" name="behave18" class="form-control required" required>
							  <option value="">Choose an option</option>
						  <option value="0">Not a problem </option>
						  <option value="1">minor problem </option>
						  <option value="2">moderate problem </option>
						  <option value="3">serious problem</option>
							</select>
						</div>
						<div class="col-md-6 form-group">
						    <label for="behave19" style="color:#A8A8A8;">Rigid routines </label>
						    <select id="behave19" name="behave19" class="form-control required" required>
							  <option value="">Choose an option</option>
						  <option value="0">Not a problem </option>
						  <option value="1">minor problem </option>
						  <option value="2">moderate problem </option>
						  <option value="3">serious problem</option>
							</select>
						</div>
						<div class="col-md-6 form-group">
						    <label for="behave20" style="color:#A8A8A8;">Shouts or scream </label>
						    <select id="behave20" name="behave20" class="form-control required" required>
							  <option value="">Choose an option</option>
						  <option value="0">Not a problem </option>
						  <option value="1">minor problem </option>
						  <option value="2">moderate problem </option>
						  <option value="3">serious problem</option>
							</select>
						</div>
						<div class="col-md-6 form-group">
						    <label for="behave21" style="color:#A8A8A8;">Demands sameness </label>
						    <select id="behave21" name="behave21" class="form-control required" required>
							  <option value="">Choose an option</option>
						  <option value="0">Not a problem </option>
						  <option value="1">minor problem </option>
						  <option value="2">moderate problem </option>
						  <option value="3">serious problem</option>
							</select>
						</div>
						<div class="col-md-6 form-group">
						    <label for="behave22" style="color:#A8A8A8;">Often agitated </label>
						    <select id="behave22" name="behave22" class="form-control required" required>
							  <option value="">Choose an option</option>
						  <option value="0">Not a problem </option>
						  <option value="1">minor problem </option>
						  <option value="2">moderate problem </option>
						  <option value="3">serious problem</option>
							</select>
						</div>
						<div class="col-md-6 form-group">
						    <label for="behave23" style="color:#A8A8A8;">Not sensitive to pain </label>
						    <select id="behave23" name="behave23" class="form-control required" required>
							  <option value="">Choose an option</option>
						  <option value="0">Not a problem </option>
						  <option value="1">minor problem </option>
						  <option value="2">moderate problem </option>
						  <option value="3">serious problem</option>
							</select>
						</div>
						<div class="col-md-6 form-group">
						    <label for="behave24" style="color:#A8A8A8;">Hooked or fixated on certain objects or topics </label>
						    <select id="behave24" name="behave24" class="form-control required" required>
							  <option value="">Choose an option</option>
						  <option value="0">Not a problem </option>
						  <option value="1">minor problem </option>
						  <option value="2">moderate problem </option>
						  <option value="3">serious problem</option>
							</select>
						</div>
						<div class="col-md-6 form-group">
						    <label for="behave25" style="color:#A8A8A8;">Repetitive movements (stimming, rocking etc) </label>
						    <select id="behave25" name="behave25" class="form-control required" required>
							  <option value="">Choose an option</option>
						  <option value="0">Not a problem </option>
						  <option value="1">minor problem </option>
						  <option value="2">moderate problem </option>
						  <option value="3">serious problem</option>
							</select>
						</div>
						</div>
						<!-- scores section -->
						<div class="col-md-4">
							<h3 class="page-header text-center">Score -> <?php echo $subtotala4; ?> / 75</h3>
							<input type="hidden" id="subtotala4" value="<?php echo $subtotala4; ?>" >
						<div id="containeratec3" style="min-width: 210px; height: 300px; max-width: 500px; margin: 0 auto"></div>
						</div>
					  </div>	
					  <!-- section 4 end ---->

					

					<div class="row">
						<div class="col-md-8">
						<p class="text-muted page-header " style="color:#A8A8A8;font-style:bold;">Please use this space to record any changes in your treatment since the last time. This will enable you to track what has worked and what hasn't.</p>
						<div class="col-md-12 form-group">
						    
						    <textarea id="feedback" name="feedback" class="form-control required" rows="10" placeholder="Please give your feedback"></textarea>
						</div>

						</div>

						 <!-- overall score ---->
						<div class="col-md-4">
							<h3 class="page-header text-center">Overall Score -> <?php echo $atectotal; ?> / 179</h3>
							<input type="hidden" id="atectotal" value="<?php echo $atectotal; ?>" >
						<div id="containeratec5" style="min-width: 210px; height: 300px; max-width: 500px; margin: 0 auto"></div>
						</div>
						
					  </div>	

					  <!-- section 5 end ---->


					<div class="col-md-12 text-center">
				  	<button type="submit" id="submit" name="submit" class="col-md-8 btn btn-primary">Submit</button>
					</div>
				</form>
				
			

			<!--- scores section ---->

			<!-- <div class="col-md-12 space">
			<h4 style="color:#A8A8A8;">Thank you to the Hummingbird Foundation, for a very informative website on all aspects of ME (www.hfme.org).</h4>
			<p style="color:#A8A8A8;">This has been an invaluable resource in helping to pull together this evaluation checksheet to assess the benefits or otherwise of natural treatments
that do not go through the standard accepted clinic trial process.</p>
			</div> -->

			<!-- <div class="col-md-12 text-center">
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
 -->
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
					<td><?php echo $feedback['atectotal']; ?></td>
					<td><input type="button" style="display:none;"id="feedbacktotal" value="<?php echo $feedback['total']; ?>" >
						<div class="containeratecfb" data-total="<?php echo $feedback['atectotal']; ?>" style="min-width: 210px; height: 300px; max-width: 500px; margin: 0 auto"></div></td>

			      </tr>

			     <?php } ?>
			     <?php } ?>
			    </tbody>
			  </table>
			</div>

		</div>
	</div>

<?php 
//include header template
require('footer.php'); 

?>
