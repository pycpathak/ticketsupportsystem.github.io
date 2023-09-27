


<?php 

$showError = FALSE;
if($_SERVER["REQUEST_METHOD"] == "POST") {
  include "partials/dbconnect.php";

  $email = $_POST["email"];
  $fullname = $_POST["full-name"];
  $pwd = $_POST["password"];

  $sql = "SELECT * FROM users WHERE password = '$pwd' AND (email = '$email' OR username = '$fullname')   ";
  $result = mysqli_query($conn,$sql);
  $num = mysqli_num_rows($result);
  $row = mysqli_fetch_assoc($result);
  if ($num == 1){
    session_start();
    $_SESSION["loggedin"] = true;
    $_SESSION["email"] = $email;
    $_SESSION["full-name"] = $fullname;
    $_SESSION["id"] = $row['userid'];
    
    header("location: index.php");
  }else{
    $showError = "Invalid Credentials ... please try again with correct details";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Sign-In </title>

    <link   rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link  href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&family=Roboto&display=swap"  rel="stylesheet"/>
    <link rel="stylesheet" href="assets/css/sign-in-up-style.css">

    </head>
    
<body>

    <?php if($showError){ ?>
            <div class="alert">
              
            <span class="closebtn"  onclick="this.parentElement.style.display='none';"> &times; </span> 
            <!-- above this is an entity button of close(X)  -->
            <strong> Error! </strong> <?php echo $showError; ?>
            </div>
    <?php } ?>

    <div class="container">
      <h3>Sign In Form </h3>
      <div class="google-box">
        <div class="icon-container">
          <i class="fab fa-google"></i>
        </div>
        <p class="p-sign">Sign In with google</p>
      </div>
      <div class="line">
        <p class="or">Or Sign In with email</p>
      </div>
   
    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
      <div class="inp">
      
        <label for="full-name" class="full-name"> NAME  </label>
        <input type="text" id="full-name" name= "full-name" placeholder="Mohammad Rezai" />
        <p> OR </p>

        <label for="email"> Email Address </label>
        <input type="email" id="email" name="email" placeholder="mhmmd.rezaei4@gmail.com"  />

        <label for="Password1" > Write Password </label>
        <input type="password" name="password" id="Password1" placeholder="*********" >
  
      </div>
    
      <div class="button">
        <button class="btn" type="submit">Get started</button>
      </div>

    </form>

      <div class="down">
        <p class="second-account">Don't have an account?</p>
        <a href="signup.php"> Sign-Up </a>
      </div>
    </div>

 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>

</body>
</html>

