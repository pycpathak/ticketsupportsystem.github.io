

<?php
session_start();
include "partials/dbconnect.php";


if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] = true){
	$loggedin = true;
}else{
	$loggedin = false;
}


$thrId = $_GET['thrid'];  // It is thread_id column data
$catId  = $_GET['catid'];  // It is thread_category_id column data

$showerror = false;

$replyerr = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    if(empty($_POST["reply"])){
        $replyerr = "Reply cannot be empty";
    } else{
        $reply = test_input($_POST["reply"]);
    }
   
    $userId = $_SESSION["id"];  // It is userid column data

    if($replyerr == ""){
	$sql = "INSERT INTO replies (replies_desc,thread_id,reply_by,thread_cat_id) VALUES ('$reply','$thrId','$userId','$catId')";
	$result = mysqli_query($conn, $sql);
    } else {
        $showerror = "Your Reply does not submit.";
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


<?php

$sql = "SELECT * FROM threads WHERE thread_id = '$thrId' ";
$result = mysqli_query($conn, $sql);

?>

<?php 
$sql_a = "SELECT * FROM replies WHERE thread_id = '$thrId' ";
$result_a = mysqli_query($conn, $sql_a);

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title> Ticket Replies </title>
  <meta charset="utf-8">

  <!-- This php file has used bootstrap 3 cdn link ,, class and all styling -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

    <link rel="stylesheet" href="assets\css\ticketreplies.css">
    <link rel="stylesheet" href="assets\css\ticketstyle.css">
</head>

<body>

<?php include "partials/navbar.php";?>

<h1 class="text-center"> Ticket Support System </h1>
<div class="container">
    <div class="row">

    <?php if($showerror){ ?>
    <div class="alert alert-danger alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong> Alert! </strong> <?php echo $showerror; ?>
    </div>
    <?php } ?>

        <div class="col-md-4">
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
						$sql_c = "SELECT * FROM maintopics ";
						$result_c = mysqli_query($conn, $sql_c);
						while($row_c = mysqli_fetch_assoc($result_c)){						
						?>

						<li class="active"> <a href=" tickets.php?catid=<?php echo $row_c["topic_id"];?> "> <?php echo $row_c["topic_name"];?>  	</a></li>

						 <?php } ?>
						
					</ul>
                </div>
            </div>
            </div>


            <div class="col-md-8">
                <div class="post-content">
                <?php

                    $sql_f = "SELECT MAX(topic_id) AS maxtopicid   FROM maintopics ";
                    $result_f = mysqli_query($conn, $sql_f);
                    $row_f = mysqli_fetch_array($result_f);
                    // echo $row_f["maxtopicid"];

                for($i=1; $i<=$row_f["maxtopicid"]; $i++){
                    if($i == $catId ){
                ?>
                        <img src="assets\images\ticket_<?php echo $i ?>.jpg" alt="post-image" class="img-responsive post-image">
                <?php 
                }
            }
               
                ?>
                
                <div class="post-container">
                    <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="user" class="profile-photo-md pull-left">
                    <div class="post-detail">
                    <?php while($row = mysqli_fetch_assoc($result)){ ?>    
                    <div class="user-info">
                        <?php 
                        $thr_user_id = $row['thread_user_id'];
                        $sql_d = "SELECT * FROM users WHERE userid = '$thr_user_id'";
                        $result_d = mysqli_query($conn, $sql_d);
                        $row_d = mysqli_fetch_assoc($result_d);
                        ?>
                        <h5><a href="#" class="profile-link"> <?php echo $row_d['username']; ?> </a> </h5>
                        
                    </div>
                    <!-- <div class="reaction">
                        <a class="btn text-green"><i class="fa fa-thumbs-up"></i> 13</a>
                        <a class="btn text-red"><i class="fa fa-thumbs-down"></i> 0</a>
                    </div> -->
                    <div class="line-divider"></div>
                    <div class="post-text">
                        <p> <?php echo $row['thread_title']; ?>  <i class="em em-anguished"></i> <i class="em em-anguished"></i> <i class="em em-anguished"></i></p>
                    </div>
                    <div class="line-divider"></div>
                    <div class="post-text">
                        <p> <?php echo $row['thread_desc']; ?>  <i class="em em-anguished"></i> <i class="em em-anguished"></i> <i class="em em-anguished"></i></p>
                    </div>
                    <?php } ?>

                    <?php while($row_a = mysqli_fetch_assoc($result_a)){ ?>    
                        <?php 
                        $rep_user_id = $row_a['reply_by'];                       
                        $sql_e = "SELECT * FROM users WHERE userid = '$rep_user_id'";
                        $result_e = mysqli_query($conn, $sql_e);
                        $row_e = mysqli_fetch_assoc($result_e);
                        ?>
                    
                    <div class="post-comment">
                        <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="" class="profile-photo-sm">
                        <p><a href="#" class="profile-link"> <?php echo $row_e['username']; ?>  </a><i class="em em-laughing"></i>
                         <?php echo $row_a['replies_desc']; ?>  </br>
                         <span class="text-muted">Published a reply about 3 mins ago</span> </p>                        
                    </div>
        
                    <?php } ?>
                    
                    <?php if($loggedin){ ?>
                    <form action="<?php echo $_SERVER["REQUEST_URI"]?>" method="post">
                    <div class="post-comment">
                        <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="" class="profile-photo-sm">
                        <input type="text" name="reply" class="form-control" placeholder="Post a reply">
                        &nbsp; &nbsp; &nbsp;
                        <button type="submit" class="btn btn-primary btn-xs pull-right"><i class="fa fa-pencil"></i> Submit </button>
                        <span class="error"> * <?php echo $replyerr; ?> </span> 

                    </div>
                    </form>
                    <?php } ?>

                
                <!-- Trigger the modal with a button -->
					<?php if(!$loggedin){ ?>
                   
                    <div class="post-comment">
                        <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="" class="profile-photo-sm">
                        <input type="text" name="reply" class="form-control" placeholder="Post a reply">
                        &nbsp; &nbsp; &nbsp;
                        <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#loginissue"> Submit </button>
                    </div>
                    

						<!-- Modal -->
						<div class="modal fade" id="loginissue" role="dialog">
						<div class="modal-dialog">
						
							<!-- Modal content-->
							<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Login Problem</h4>
							</div>
							<div class="modal-body">
								<p class="text-center"> You Are Not Logged-In. </p>
                                <a href="signin.php" class="btn btn-warning "  style = "display: block;"> Please Log-in </a>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
							</div>
							
						</div>
						</div>
						
					<?php } ?>
                </div>
            </div>
           
        </div>
    </div>
<body>
</html>