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
      
      
      <ul class="nav navbar-nav navbar-right">
       <!--  <li><a href="atec_history.php" class="btn btn-info" style="color:#fff;font-weight:bold;">Check History</a></li> -->
        <li><a href="#" class="btn btn-danger" style="color:#fff;font-weight:bold;">AlZTEC</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

	<div class="container">
		<h1 class="page-header text-center"> Coming Soon </h1>
	</div>

<?php 
//include header template
require('footer.php'); 

?>
