<!DOCTYPE html>
  <html lang="en">
  <head>
  <title>HUMAN RACE</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <style>
  .bg2{
    background:url('Images/home1.png') ;
    padding-top:100px;
    padding-bottom:50px;
    color:white;
    background-size: 100% 100%;
  }
  </style>
  </head> 
  
<!-- NAV BAR START -->
 <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
		<div class="container-fluid">
			<img src="Images/NavLogo1.png" href="home.php">
			<button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarCollapse">
				<ul class="navbar-nav">
				
				<!-- BUTTONS START -->
				
                <li class="nav-item">
						<a href="home.php" class="nav-link">HOME</a>
					</li>
					<li class="nav-item">
						<a href="men.php" class="nav-link">MEN</a>
					</li>
          <li class="nav-item">
						<a href="women.php" class="nav-link">WOMEN</a>
					</li>
          <li class="nav-item">
						<a href="kids.php" class="nav-link">KIDS</a>
					</li>
		  <li class="nav-item">
						<a href="forum.php" class="nav-link">FORUM</a>
					</li>
				  </ul>
			</div>
			<ul class="navbar-nav">
			 <li class="nav-item">
						<a href="login.php" class="nav-link">LOGIN</a>
					</li>
		  <li class="nav-item">
						<a href="#0" class="nav-link" id="cd-cart-trigger">CART</a>
			</ul>
					</li>				
    		</ul>
			
			
		</div>
		</nav>
	
         
<?php # DISPLAY COMPLETE REGISTRATION PAGE.

 # Set page title and display header section.
 $page_title = 'register' ;


 # Check form submitted.
 if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
 {
  # Connect to the database.
  require ('connect_db.php'); 
  
  # Initialize an error array.
  $errors = array();

  # Check for a first name.
  if ( empty( $_POST[ 'first_name' ] ) )
  { $errors[] = 'Enter your first name.' ; }
  else
  { $fn = mysqli_real_escape_string( $dbc, trim( $_POST[ 'first_name' ] ) ) ; }

  # Check for a last name.
  if (empty( $_POST[ 'last_name' ] ) )
  { $errors[] = 'Enter your last name.' ; }
  else
  { $ln = mysqli_real_escape_string( $dbc, trim( $_POST[ 'last_name' ] ) ) ; }

  # Check for a birthday.
  if (empty( $_POST[ 'birthday' ] ) )
  { $errors[] = 'Enter your birthday.' ; }
  else
  { $birthday = mysqli_real_escape_string( $dbc, trim( $_POST[ 'birthday' ] ) ) ; }

  # Check for an email address:
  if ( empty( $_POST[ 'email' ] ) )
  { $errors[] = 'Enter your email address.'; }
  else
  { $e = mysqli_real_escape_string( $dbc, trim( $_POST[ 'email' ] ) ) ; }

  # Check for an phone number:
  if ( empty( $_POST[ 'phone' ] ) )
  { $errors[] = 'Enter your phone number.'; }
  else
  { $phone = mysqli_real_escape_string( $dbc, trim( $_POST[ 'phone' ] ) ) ; }

  # Check for a gender.
  if (empty( $_POST[ 'gender' ] ) )
  { $errors[] = 'Select your gender.' ; }
  else
  { $gender = mysqli_real_escape_string( $dbc, trim( $_POST[ 'gender' ] ) ) ; }

  # Check for a password and matching input passwords.
  if ( !empty($_POST[ 'pass1' ] ) )
  {
    if ( $_POST[ 'pass1' ] != $_POST[ 'pass2' ] )
    { $errors[] = 'Passwords do not match.' ; }
    else
    { $p = mysqli_real_escape_string( $dbc, trim( $_POST[ 'pass1' ] ) ) ; }
  }
  else { $errors[] = 'Enter your password.' ; }
  
  # Check if email address already registered.
  if ( empty( $errors ) )
  {
    $q = "SELECT user_id FROM users WHERE email='$e'" ;
    $r = @mysqli_query ( $dbc, $q ) ;
    if ( mysqli_num_rows( $r ) != 0 ) $errors[] = 'Email address already registered. <a href="login.php">Login</a>' ;
  }
  
  # On success register user inserting into 'users' database table.
  if ( empty( $errors ) ) 
  {
    $q = "INSERT INTO users (first_name, last_name, birthday, email, phone, gender, pass, reg_date) VALUES ('$fn', '$ln', '$birthday', '$e', '$phone', '$gender',  SHA1('$p'), NOW() )";
    $r = @mysqli_query ( $dbc, $q ) ;
    if ($r) 
    
    {header('refresh:3; url=login.php');
  
    # Close database connection.
    mysqli_close($dbc); 

    # Display footer section and quit script:
    echo '<div class="container-fluid" style="padding-top:400px; font-size:45px; text-align:center;"><h1>Registered!</h1><p>You are now registered.</p></div>';
    
    }
   
    exit();
  }
 }
  # Or report errors.

 ?>

<!-- FORM START -->
  <div class="container-fluid text-center hometxt bg2">
 <div class="container">
 <h3 class="margin"> JOIN <strong>THE HUMAN RACE</strong></h3><br>
 <div class="row">
 <div class="col"></div>
 <div class="col-md-6">
 <div class="card">
 <form action="register.php" method="post">

 <p>First Name:<br>
	<input type="text" name="first_name" size="30" value=""<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>></p>
	
 <p>Last Name:<br>
	<input type="text" name="last_name" size="30" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>"></p>
	
 <p>Birthday:<br>
	<input type="date" name="birthday" size="30"><?php if (isset($_POST['birthday'])); ?></p>
	
 <p>Email Address:<br>
	<input type="email" name="email" size="30" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"></p>
	
 <p>Phone Number:<br>
	  <input type="number" name="phone" size="60" minlength="11" maxlength="11"><?php if (isset($_POST['phone'])); ?></p>

 <p>Gender:<br>
	<input type="radio" name="gender" value="male" checked> Male<br>
	<input type="radio" name="gender" value="female"> Female<br>
	<input type="radio" name="gender" value="other"> Other
	<?php if (isset($_POST['gender'])) echo $_POST['gender']; ?></p>
	
 <p>Password:<br>
	<input type="password" name="pass1" size="30" value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>" ></p>
	
 <p>Confirm Password:<br>
	<input type="password" name="pass2" size="30" value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>"></p>
	
 <p>	<br>
	<button type="submit" class="btn btn-Default" value="Register">REGISTER</button><br><br>
	<button type="reset" class="btn btn-Default" value="Reset">RESET</button>
 </p>

 </form>
 </div>
</div>
<div class="col"></div>
</div>
</div>
</div>


