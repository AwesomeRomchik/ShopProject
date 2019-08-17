<!DOCTYPE html>
  <html lang="en">
  <head>
  <title>HUMAN RACE</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
  </head> 
  <body>
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
		<div class="container">
			<img src="Images/NavLogo1.png" href="home.php">
			<button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarCollapse">
				<ul class="navbar-nav ml-auto">
				
				<!-- BUTTONS START -->
	</ul>
	</div>
	</div>
	</nav>
   <strong>         
  <div class="container-fluid" style="padding-top:400px; font-size:45px; text-align:center;">
<?php # DISPLAY SHOPPING CART ADDITIONS PAGE.

# Access session.
session_start() ;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { header ('Location: login.php'); }

# Set page title and display header section.
$page_title = 'Cart Addition' ;

# Get passed product id and assign it to a variable.
if ( isset( $_GET['id'] ) ) $id = $_GET['id'] ; 

# Open database connection.
require ( 'connect_db.php' ) ;

# Retrieve selective item data from 'shop' database table. 
$q = "SELECT * FROM shop WHERE item_id = $id" ;
$r = mysqli_query( $dbc, $q ) ;
if ( mysqli_num_rows( $r ) == 1 )
{
  $row = mysqli_fetch_array( $r, MYSQLI_ASSOC );

  # Check if cart already contains one of this product id.
  if ( isset( $_SESSION['cart'][$id] ) )
  { 
    # Add one more of this product.
    $_SESSION['cart'][$id]['quantity']++; 
    echo '<p class="container-fluid">Another '.$row["item_name"].' has been added to your cart</p>';
  } 
  else
  {
    # Or add one of this product to the cart.
    $_SESSION['cart'][$id]= array ( 'quantity' => 1, 'price' => $row['item_price'] ) ;
    echo '<p  class="container-fluid">A '.$row["item_name"].' has been added to your cart</p>' ;
  }
}

# Close database connection.
mysqli_close($dbc);


?>

</strong>   
</div>
<div class="container-fluid" style="padding-top:50px; font-size:20px; text-align:center;">
The page will refresh in 3 seconds!
</div>
<?php
header('refresh:3; url=home.php');
?>
</body>