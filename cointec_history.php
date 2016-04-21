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
        <li><a href="cointec.php" class="btn btn-info" style="color:#fff;font-weight:bold;">Take Cointec Test</a></li>
        <!-- <li class="dropdown">
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

	<form action="" method="post">
				<!-- section 1 start ---->
				<div class="row" style="width:35%;height:50%;margin:0 auto	">
				<?php
				if(isset($_POST['submit'])){
					if (isset($_POST["name"]) && !empty($_POST["name"])) {
		    			$name = $_POST['name'];
					 } 

					if (isset($_POST["email"]) && !empty($_POST["email"])) {
					    $email = $_POST['email'];
					    
					  } 

			  		$records = get_history($name,$email);
		  
		  			if($records){
					  	echo "<div class='alert alert-success' role='alert'>Records Found</div>";
					  }else{
					  	echo "<div class='alert alert-danger' role='alert'>No Records Found ..Please take test.</div>";
					  }

				}
				

				?>
				<h3 class="page-header text-center">Login to get details</h3>
					<form action="" method="post">
					  <div class="form-group">
					    <label for="name">Name</label>
					    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" required>
					  </div>
					  <div class="form-group">
					    <label for="email">Email address</label>
					    <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" required>
					  </div>
					  <button type="submit" name="submit" class="btn btn-info">Log in</button>
					</form>
				</div>

	</form>
<section>
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
			        <th>Feedback</th>
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
			        <td><?php echo $record['feedback']; ?></td>
			      </tr>

			     <?php } ?>
			     <?php } ?>

			    </tbody>
			  </table>
			</div>

</section>
<?php 
//include header template
require('footer.php'); 

?>
