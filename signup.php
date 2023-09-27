<?php 

$showAlert = FALSE;
$showError = FALSE;

$nameerr = $emailerr = $pwderr = "";

$fullname = $email = $pwd = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){

  include "partials/dbconnect.php";

  $cpwd = $_POST["cpassword"];

  if(empty($_POST["full-name"])){
    $nameerr = " Name is Required";
  }else{
    $fullname = test_input($_POST["full-name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$fullname)){
      $nameerr = "Only letters and whitespace are required";
    }
  }

  if(empty($_POST["email"])){
        $emailerr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL )){
            $emailerr = "Invalid e-mail format";
        }
    }

  if(empty($_POST["password"])){
    $pwderr = "Password is Required";
  }else{
    $pwd = test_input($_POST["password"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/",$pwd)){
      $pwderr = " Minimum 8 characters, Atleast---One Uppercase, One Lowercase, One Digit, One Special Character.";
    }
  }



if($nameerr == "" && $emailerr == ""  && $pwderr ==""){
  $sqlExist = "SELECT * FROM users WHERE username = '$fullname' OR email = '$email'  ";
  $resExist = mysqli_query($conn,$sqlExist);
  $numRows =  mysqli_num_rows($resExist);

  // echo $numRows;
  // die;

  if($numRows>=1){

    $showError = "Username or Email already Exists... please try again";
  }else{
    if($pwd == $cpwd){
      $sql = "INSERT INTO users (username,email,password) VALUES ('$fullname','$email','$pwd')";
      $result = mysqli_query($conn, $sql);
      if($result){
        $showAlert = true;
      }
    }else{
      $showError = "Password did'nt match";
    }
  }
} else{
  $showError = "Please fill all details";
}
}

function test_input($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data; 
}

?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Sign-Up</title>



    <link   rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link  href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&family=Roboto&display=swap"  rel="stylesheet"/>
    <link rel="stylesheet" href="assets/css/sign-in-up-style.css">

    
    </head>
  <body>

  

  <?php if($showAlert){ ?>
      <div class="alert success " >
        <span class="closebtn"  onclick="this.parentElement.style.display='none';" > &times; </span> 
        <strong>Success!</strong> Your account has been created    
       
      </div>
<?php } ?>

<?php if($showError){ ?>
        <div class="alert error ">
          <span class="closebtn"  onclick="this.parentElement.style.display='none';" > &times; </span> 
          <strong> Error! </strong> <?php echo $showError; ?>
    
        </div>
<?php } ?>


    <div class="container">
      <h3>Sign Up Form</h3>
      <div class="google-box">
        <div class="icon-container">
          <i class="fab fa-google"></i>
        </div>
        <p class="p-sign">Sign Up with google</p>
      </div>
      <div class="line">
        <p class="or">Or Sign Up with email</p>
      </div>

    
    
    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
      <div class="inp">
      
      
        <label for="full-name" class="full-name"> NAME  <span class="red"> * <?php echo $nameerr; ?></span></label>
       
        <input type="text" id="full-name" name= "full-name" placeholder="Mohammad Rezai" />
        <label for="email"> Email Address <span class="red"> * <?php echo $emailerr; ?></span></label>
        
        <input type="email" id="email" name="email" placeholder="mhmmd.rezaei4@gmail.com"  />
        <label for="Password1" > Write Password <span class="red"> * <?php echo $pwderr; ?></span></label>
        
        <input type="password" name="password" id="Password1" placeholder="*********" >
        <label for="Password2" > Confirm Password <span class="red"> * <?php echo $pwderr; ?></span></label>
        
        <input type="password" name="cpassword" id="Password2" placeholder="**********" >
        
      </div>
    
      <div class="button">
        <button class="btn" type="submit">Get started</button>
      </div>

    </form>

      <div class="down">
        <p class="second-account">Already have an account?</p>
        <a href="signin.php"> Sign-In</a>
      </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>

  </body>
</html>
