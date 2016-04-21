<?php 
	require_once 'db_connect.php';
	require_once 'libs/PHPMailer/PHPMailerAutoload.php';

	
	
	require_once 'header.php';

?>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      
      <a class="navbar-brand" href="index.php">Treatment Checklists</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      
      
     <!--  <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Select Test <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li> -->
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


	<div class="container">
		<h3 class="page-header text-center" style="width:75%;height:50%;margin:20px auto;">Treatment Evaluation Checklists

		<div class="btn-group">
		  <button type="button" class="btn btn-info">Select Tests</button>
		  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		    <span class="caret"></span>
		    <span class="sr-only">Toggle Dropdown</span>
		  </button>
		  <ul class="dropdown-menu">
		    <li><a href="cointec.php">Use the Cointec</a></li>
		    <li><a href="atec.php">Use the ATEC</a></li>
		    <!-- <li><a href="alztec.php">Use the AlZTEC</a></li> -->

		  </ul>
		</div>	
	</h3>


	<div class="jumbotron" style="width:75%;height:50%;margin:0 auto;">
	  
	  <p>Sometimes it is difficult to see whether any change in a treatment protocol is effective.  This is especially true where the ailment gives such a wide range of symptoms, such as autism, CFS, Lyme disease etc, and where the treatment gives a consistent but gradual improvement.  By keeping a record of symptoms over a period, it is possible to see which interventions give the best results, and which ones do not help.</p>
	  <p>The questionnaires on this website will help you evaluate your treatments and keep a record of what is helping, so that you can work towards formulating your own personal treatment plan.  These questionnaires can be done at home and it is suggested that they are completed monthly</p>
	  <p>These questionnaires are not intended to diagnose any ailment, nor are they intended to imply any medical advice.</p>
	  <p>For autism, use the <a href="atec.php">ATEC</a>.</p>
	  <p>For co-infection ailments such as Lyme disease, CFS, ME etc, use the <a href="cointec.php">COINTEC</a>.</p>
	  <!-- <p>For alzheimers and dementia, use the <a href="alztec.php">ALZTEC</a>.</p> -->
	  <p>This website and the checklists are sponsored by <a href="http://www.mafactive.eu">www.mafactive.eu</a> </p>
	  <p>We hope that you find these tools helpful and let others know of this free self-assessment checklist.  Don't forget to bookmark this page.</p>
	</div>
	</div>

<?php 
//include header template
require('footer.php'); 

?>