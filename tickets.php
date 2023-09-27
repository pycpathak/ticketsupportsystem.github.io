
<?php
session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] = true){
	$loggedin = true;
}else{
	$loggedin = false;
}

include "partials/dbconnect.php";

$catId = $_GET['catid'];  // It is topic_id which is inserted into thread_cat_id column data

$showerror = false;

$subjecterr = $messageerr ="";

if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	if(empty($_POST["subject"])){
		$subjecterr = "Subject cannot be empty";
	} else{
		$subject = test_input($_POST["subject"]);
	}

	if(empty($_POST["message"])){
		$messageerr = "Message cannot be empty ";
	} else{
		$message = test_input($_POST["message"]);
	}
	
	$userId = $_SESSION["id"]; // It is userid column data
	// echo $subject;
	// echo $message;
	// die();


	if( $subjecterr=="" && $messageerr==""){
	$sql = "INSERT INTO threads (thread_title,thread_desc,thread_cat_id,thread_user_id) VALUES ('$subject','$message','$catId', '$userId')";
	$result = mysqli_query($conn, $sql);
	} else {
		$showerror =  "Your Form does not submit.";
	}
}

function test_input($data)
{
  $data = trim($data);
  $data = stripcslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title> Tickets </title>
  <meta charset="utf-8">

  <!-- This php file has used bootstrap 3 cdn link ,, class and all styling -->

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

  <link rel="stylesheet" href="assets\css\ticketstyle.css">
</head>




<?php

$sql_a = "SELECT * FROM threads WHERE thread_cat_id='$catId'";


$result_a = mysqli_query($conn, $sql_a);

$num_of_rows = mysqli_num_rows($result_a);
?>

<?php 



/*$sql = "SELECT * FROM threads WHERE thread_cat_id= 2 ";
$result = mysqli_query($conn, $sql);

$num_of_rowsc = mysqli_num_rows($result);

$sql = "SELECT * FROM threads WHERE thread_cat_id= 3 ";
$result = mysqli_query($conn, $sql);

$num_of_rowsj = mysqli_num_rows($result);

$sql = "SELECT * FROM threads WHERE thread_cat_id= 4 ";
$result = mysqli_query($conn, $sql);

$num_of_rowsp = mysqli_num_rows($result);
*/


?>

<body>

<?php include "partials/navbar.php" ; ?>

<h1 class="text-center"> Ticket Support System </h1>

<div class="container">
<section class="content">
	<div class="row">
	<?php if($showerror){ ?>
    <div class="alert alert-danger alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong> Alert! </strong> <?php echo $showerror; ?>
    </div>
    <?php } ?>

		<!-- BEGIN NAV TICKET -->
		<div class="col-md-3">
			<div class="grid support">
				<div class="grid-body">
					<h2>Browse</h2>
					
					<hr>
					<?php
					for($i = 1; $i <= 4; $i++){
						$sql_b = "SELECT * FROM threads WHERE thread_cat_id= '$i' ";
						$result_b = mysqli_query($conn, $sql_b);
						
						$num =  mysqli_num_rows($result_b);
						//$num_i = $num."".$i;
						
					
					} ?>
					
					<ul>
						<?php 
						$sql_d = "SELECT * FROM maintopics ";
						$result_d = mysqli_query($conn, $sql_d);
						while($row_d = mysqli_fetch_assoc($result_d)){						
						?>

						<li class="active"><a href=" tickets.php?catid=<?php echo $row_d["topic_id"];?> "> <?php echo $row_d["topic_name"];?> 	</a></li>

						 <?php } ?>
						
					</ul>
					

					
					
					<!-- <hr>
					
					<p><strong>Labels</strong></p>
					<ul class="support-label">
						<li><a href="#"><span class="bg-blue">&nbsp;</span>&nbsp;&nbsp;&nbsp;application<span class="pull-right">2</span></a></li>
						<li><a href="#"><span class="bg-red">&nbsp;</span>&nbsp;&nbsp;&nbsp;css<span class="pull-right">7</span></a></li>
						<li><a href="#"><span class="bg-yellow">&nbsp;</span>&nbsp;&nbsp;&nbsp;design<span class="pull-right">128</span></a></li>
						<li><a href="#"><span class="bg-black">&nbsp;</span>&nbsp;&nbsp;&nbsp;html<span class="pull-right">41</span></a></li>
						<li><a href="#"><span class="bg-light-blue">&nbsp;</span>&nbsp;&nbsp;&nbsp;javascript<span class="pull-right">22</span></a></li>
						<li><a href="#"><span class="bg-green">&nbsp;</span>&nbsp;&nbsp;&nbsp;management<span class="pull-right">87</span></a></li>
						<li><a href="#"><span class="bg-purple">&nbsp;</span>&nbsp;&nbsp;&nbsp;mobile<span class="pull-right">92</span></a></li>
						<li><a href="#"><span class="bg-teal">&nbsp;</span>&nbsp;&nbsp;&nbsp;php<span class="pull-right">140</span></a></li>
					</ul> -->
				</div>
			</div>
		</div>
		<!-- END NAV TICKET -->
		<!-- BEGIN TICKET -->
		<div class="col-md-9">
			<div class="grid support-content">
				 <div class="grid-body">
				 <?php 
					$sql_c = "SELECT * FROM maintopics WHERE topic_id='$catId'";
					$result_c = mysqli_query($conn, $sql_c);
					$row_c = mysqli_fetch_assoc($result_c);
				?>
				<h2>  <?php echo $row_c["topic_name"];?> Tickets </h2>					
					 
					 <hr>
					 
					 <div class="btn-group">
						<!-- <button type="button" class="btn btn-default active">162 Open</button>
						<button type="button" class="btn btn-default">95,721 Closed</button> -->
					</div>
					 
					 <div class="btn-group">
						<!-- <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> Sort: <strong>Newest</strong> <span class="caret"></span></button>
						<ul class="dropdown-menu fa-padding" role="menu">
							<li><a href="#"><i class="fa fa-check"></i> Newest</a></li>
							<li><a href="#"><i class="fa"> </i> Oldest</a></li>
							<li><a href="#"><i class="fa"> </i> Recently updated</a></li>
							<li><a href="#"><i class="fa"> </i> Least recently updated</a></li>
							<li><a href="#"><i class="fa"> </i> Most commented</a></li>
							<li><a href="#"><i class="fa"> </i> Least commented</a></li>
						</ul> -->
					</div>
					
					<!-- BEGIN NEW TICKET -->

					<!-- Trigger the modal with a button -->
					<?php if(!$loggedin){ ?>
					<button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#loginissue"> Create New Issue</button>
						<!-- Modal -->
						<div class="modal fade" id="loginissue" role="dialog">
						<div class="modal-dialog">
						
							<!-- Modal content-->
							<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title"> Login Problem</h4>
							</div>
							<div class="modal-body">
								
								<p class="text-center"> You Are Not Logged-In. </p>
								<a href="signin.php" class="btn btn-warning text-center"  style = "display: block;"> Please Log-in </a>
								
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
							</div>
							
						</div>
						</div>
						
					<?php } ?>

					<?php if($loggedin){  ?>

					<button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#newissue"> Create New Issue</button>
	
					<div class="modal fade" id="newissue" tabindex="-1" role="dialog" aria-labelledby="newissue" aria-hidden="true">
					
						<div class="modal-wrapper">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header bg-blue">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										<h4 class="modal-title"><i class="fa fa-pencil"></i> Create New Issue</h4>
									</div>
									
									<form action="<?php echo $_SERVER["REQUEST_URI"]?>" method="post">
									<!-- In above it is the form submitting the post by Request _uri as it will send the full url with cat_id also -->
										<div class="modal-body">
											
											<div class="form-group">
												
												

												<input name="department" type="text" class="form-control" placeholder="<?php echo $row_c['topic_name'] ; ?>"  disabled>
											</div>
											
											<div class="form-group">
												<span class="error"> * <?php echo $subjecterr; ?> </span> 
												<input name="subject" type="text" class="form-control" placeholder="Subject">
												
											</div>
											<div class="form-group">
												<span class="error"> * <?php echo $messageerr; ?> </span> 
												<textarea name="message" class="form-control" placeholder="Please detail your issue or question" style="height: 120px;"></textarea>
												
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>
											<button type="submit" class="btn btn-primary pull-right"><i class="fa fa-pencil"></i> Create</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<?php } ?>
					</div>
				
					<!-- END NEW TICKET -->
					 
					<div class="padding"></div>
					 
					<div class="row">
						<!-- BEGIN TICKET CONTENT -->
						<?php if($num_of_rows > 0){ ?>
						<div class="col-md-12">
						<?php while($row_a = mysqli_fetch_assoc($result_a)){ ?>
							<ul class="list-group fa-padding">
							
								<li class="list-group-item" data-toggle="modal" data-target="#issue">
									<div class="media">
										<i class="fa fa-cog pull-left"></i>   
										<div class="media-body">
										<!-- email=" . $email_address . "&event_id=" . $event_id; -->
				

											<strong> <a href="ticketreplies.php?thrid=<?php echo $row_a['thread_id']?> &catid=<?php echo $catId;?>">
											 <?php echo $row_a['thread_title']; ?></a> </strong> <span class="number pull-right"># <?php echo $row_a['thread_id']; ?> </span>
											 <?php
											 	$thr_user_id = $row_a['thread_user_id'];
											 	$sql_e = "SELECT * FROM users WHERE userid = '$thr_user_id'";
												$result_e = mysqli_query($conn, $sql_e);
												$row_e = mysqli_fetch_assoc($result_e);
											?>
											<p class="info">Created by <a href="#"><?php echo $row_e['username']; ?></a> 5 hours ago 
											<!-- <i class="fa fa-comments"></i><a href="#">2 comments</a> -->
											</p>
										</div>
									</div>
								</li>
								<!-- <li class="list-group-item" data-toggle="modal" data-target="#issue">
									<div class="media">
										<i class="fa fa-file-o pull-left"></i>
										<div class="media-body">
											<strong>  </strong> <span class="label label-success">SUCCESS</span><span class="number pull-right"># 13697</span>
											<p class="info">Opened by <a href="#">lgardner</a> 12 hours ago <i class="fa fa-comments"></i> <a href="#">7 comments</a></p>
										</div>
									</div>
								</li> -->
								<!-- <li class="list-group-item" data-toggle="modal" data-target="#issue">
									<div class="media">
										<i class="fa fa-code-fork pull-left"></i>
										<div class="media-body">
											<strong>Manually triggering dropdown not working</strong> <span class="label label-primary">NOT IMPORTANT</span><span class="number pull-right"># 13695</span>
											<p class="info">Opened by <a href="#">ehernandez</a> 19 hours ago <i class="fa fa-comments"></i> <a href="#">14 comments</a></p>
										</div>
									</div>
								</li>
								<li class="list-group-item" data-toggle="modal" data-target="#issue">
									<div class="media">
										<i class="fa fa-code pull-left"></i>
										<div class="media-body">
											<strong>Add classes for respective directions to affix</strong> <span class="label label-primary">NOT IMPORTANT</span><span class="number pull-right"># 13691</span>
											<p class="info">Opened by <a href="#">tmckenzie</a> 1 day ago <i class="fa fa-comments"></i> <a href="#">20 comments</a></p>
										</div>
									</div>
								</li> -->
								<!-- <li class="list-group-item" data-toggle="modal" data-target="#issue">
									<div class="media">
										<i class="fa fa-code pull-left"></i>
										<div class="media-body">
											<strong>Responsive tables of the horizontal scroll bar</strong> <span class="label label-danger">IMPORTANT</span><span class="number pull-right"># 13680</span>
											<p class="info">Opened by <a href="#">tmckenzie</a> 2 days ago <i class="fa fa-comments"></i> <a href="#">5 comments</a></p>
										</div>
									</div>
								</li> -->
								
								</li>
								
							</ul>
							
							
							<!-- BEGIN DETAIL TICKET -->

							<!-- <div class="modal fade" id="issue" tabindex="-1" role="dialog" aria-labelledby="issue" aria-hidden="true">

								<div class="modal-wrapper">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header bg-blue">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
												<h4 class="modal-title"><i class="fa fa-cog"></i> Add drag and drop config import closes</h4>
											</div>
											<form action="#" method="post">
												<div class="modal-body">
													<div class="row">
														<div class="col-md-2">
															<img src="assets/img/user/avatar01.png" class="img-circle" alt="" width="50">
														</div>
														<div class="col-md-10">
															<p>Issue <strong>#13698</strong> opened by <a href="#">jqilliams</a> 5 hours ago</p>
															<p> <?php // echo $row['thread_desc']; ?></p>
														</div>
													</div>
													<div class="row support-content-comment">
														<div class="col-md-2">
															<img src="assets/img/user/avatar02.png" class="img-circle" alt="" width="50">
														</div>
														<div class="col-md-10">
															<p>Posted by <a href="#">ehernandez</a> on 16/06/2014 at 14:12</p>
															<p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
															<a href="#"><span class="fa fa-reply"></span> &nbsp;Post a reply</a>
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							
							
								</div> -->
							<!-- END DETAIL TICKET -->
							
							<?php } ?>
						</div>
						<?php }else{ ?>
							<h2 class="text-center"> No Records Found </h2>
						<?php } ?>
						<!-- END TICKET CONTENT -->
					</div>
				</div>
			</div>
		</div>
		<!-- END TICKET -->
	</div>
</section>
</div>

</body>
</html>
