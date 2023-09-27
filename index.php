
<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Index Page</title>
        	
    <!-- THIS INDEX PAGE  IS FULLY WORKING ONLY ON BOOTSTRAP 3 -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
    *{
		box-sizing: border-box;
		margin: 0;
		padding: 0;
	}

    .container{
		max-width: 80% !important;
		margin: auto;
		padding: 0 15px;	 
	}

    .card{
        margin: 10px 0;
        overflow: hidden;
        transition:all 0.5s;
       
    }

    .card:hover{
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 2), 0 6px 20px 0 rgba(0, 0, 0, 1);
    }

    .card img{
        transform: scale(1.0);
        transition:all 0.5s;
    }

    .card:hover img{
        transform: scale(1.2);
    }

    .card h2{
        color: lightseagreen;
        text-align: center;
    }

    .card h4{
        color: lightslategray;
        line-height: 24px;
        font-family: monospace;
    }

    .card-wrapper{
        padding: 10px;
    }
    
    .card-wrapper a{
        width: 100%;
    }

    .carousel-caption p{
        color: #ff006a;
        font-size: 20px;
    }

 

</style>
</head>
<body>
<?php include "partials/dbconnect.php" ?>

<?php include "partials/navbar.php"; ?>

<!-- <img src="assets\images\logo-ts.webp" alt ="Logo" width="1000px" height="300px">   -->

<?php // include "slider/index.html"; ?>

<?php 
$query = "SELECT * FROM maintopics  ";
$result = mysqli_query($conn, $query);
$num_of_rows = mysqli_num_rows($result);

?>

<div class="container mt-3">

<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">

      <div class="item active">
        <img src="assets\images\slider_1.jpg" alt=" Ticket System" style="width:100%;">
        <div class="carousel-caption">
          <h3>  </h3>
          <p>An IT helpdesk ticket system works by generating a ticket whenever an incident related to asset, network access, etc. is raised!</p>
        </div>
      </div>

      <div class="item">
        <img src="assets\images\slider_2.png" alt="Chicago" style="width:100%;">
        <div class="carousel-caption">
          <h3>   </h3>
          <p>Comprehensive Recordkeeping, Better Communication with Customer, Centralization of information!</p>
        </div>
      </div>
    
      <div class="item">
        <img src="assets\images\slider_3.webp" alt="New York" style="width:100%;">
        <div class="carousel-caption">
          <h3>   </h3>
          <p> Resources We've Used! </p>
        </div>
      </div>
  
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>


  <h2 > CATEGORIES: </h2>
  <!-- <p>Image at the top (card-img-top):</p> -->
  <div class ="row">
  <?php if($num_of_rows > 0){ ?>
    <?php
    while($row = mysqli_fetch_assoc($result)){
    ?>
        
        <div class="col-sm-6">
            <div class="card">
                <div style="overflow:hidden;">
                    <img class="card-img-top" src="<?php echo $row['topic_logo']?>" alt="Card image"  width="100%" height="300px">
                </div>
                <!-- <div class="card-body"> -->
                <div class="card-wrapper">
                    <h2 class="card-title"> <?php echo $row['topic_name']; ?> </h2>
                    <h4 class="card-text"> <?php echo $row['topic_desc']; ?> </h4>
                    <a href="tickets.php?catid=<?php echo $row['topic_id']; ?>" class="btn btn-primary btn-lg">See Tickets</a>
                </div>
                <!-- </div> -->
            </div>
        </div>
<?php } ?>
<?php } else{
    echo "No Categories details are found";
} ?>
</div>
  


</body>

</html>





