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
    background:url('Images/home1.png') no-repeat;
    padding-top:100px;
    padding-bottom:50px;
    color:black;
  }
  </style>
  </head> 
  <body>
 <!-- NAV BAR START -->
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
		<div class="container">
			<img src="Images/NavLogo1.png" href="home.php">
			<button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarCollapse">
				<ul class="navbar-nav ml-auto">
				
				<!-- BUTTONS START -->
				
                <li class="nav-item">
						<a href="home.php" class="nav-link">HOME</a>
					</li>
					<li class="nav-item">
						<a href="about.php" class="nav-link">ABOUT</a>
					</li>
					<li class="nav-item">
						<a href="shop.php" class="nav-link">SHOP</a>
					</li>
					<li class="nav-item">
						<a href="team.php" class="nav-link">TEAM</a>
					</li>
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">MY ACCOUNT
                            <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="register.php">SIGN UP</a></li>
                                <?php if (isset ($_SESSION['user_id']))
                                {
                                echo '<li><a href="login.php">LOG IN</a></li>' ;
                                }
                                else{
                                echo'<li><a href="login.php">LOG OUT</a></li>' ;
                                }
                                ?>
                                <li><a href="cart.php"><strong>CART</strong></a></li>
                            </ul>
                    </div>
					</ul>
			</div>
		</div>
        </nav>
        

<div class="bg2"
<?php # DISPLAY COMPLETE PRODUCTS PAGE.

 # Access session.
 session_start() ;

 # Redirect if not logged in.
 if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

 # Set page title and display header section.
 $page_title = 'Shop' ;
 include ( 'includes/header.html' ) ;

 # Open database connection.
 require ( 'connect_db.php' ) ;

 # Retrieve items from 'shop' database table.
 $q = "SELECT * FROM shop" ;
 $r = mysqli_query( $dbc, $q ) ;
 if ( mysqli_num_rows( $r ) > 0 )
 {
  # Display body section.
  echo '';
  while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
  {
      echo '<div class="product"> <strong>' . $row['item_name'] .'</strong><br><span style="font-size:smaller">'. $row['item_desc'] . '</span><br><img class="thumb" src='. $row['item_img'].'><br>$' . $row['item_price'] . '<br><a href="added.php?id='.$row['item_id'].'">Add To Cart</a></div>'; 
  }
 
  echo '';
  
  # Close database connection.
  mysqli_close( $dbc ) ; 
 }
 # Or display message.
 else { echo '<p>There are currently no items in this shop.</p>' ; }

 # Create navigation links.
 echo '<p><a href="cart.php">View Cart</a> | <a href="forum.php">Forum</a> | <a href="home.php">Home</a> | <a href="goodbye.php">Logout</a></p>' ;

 # Display footer section.
 include ( 'includes/footer.html' ) ;

 ?>
 </div>