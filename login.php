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
  <body class="bg2">
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
		
		<div id="cd-shadow-layer"></div>
		<div id="cd-cart">
   <h2>Cart</h2>
<?php # DISPLAY SHOPPING CART PAGE.

# Access session.
session_start() ;

# Redirect if not logged in.
//if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }



# Check if form has been submitted for update.
if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
{
  # Update changed quantity field values.
  foreach ( $_POST['qty'] as $item_id => $item_qty )
  {
    # Ensure values are integers.
    $id = (int) $item_id;
    $qty = (int) $item_qty;

    # Change quantity or delete if zero.
    if ( $qty == 0 ) { unset ($_SESSION['cart'][$id]); } 
    elseif ( $qty > 0 ) { $_SESSION['cart'][$id]['quantity'] = $qty; }
  }
}

# Initialize grand total variable.
$total = 0; 

# Display the cart if not empty.
if (!empty($_SESSION['cart']))
{
  # Connect to the database.
  require ('connect_db.php');
  
  # Retrieve all items in the cart from the 'shop' database table.
  $q = "SELECT * FROM shop WHERE item_id IN (";
  foreach ($_SESSION['cart'] as $id => $value) { $q .= $id . ','; }
  $q = substr( $q, 0, -1 ) . ') ORDER BY item_id ASC';
  $r = mysqli_query ($dbc, $q);

  # Display body section with a form and a table.
  echo '<form style="width:100%;" action="" method="post"><table><tr><th colspan="5">Items in your cart</th></tr><tr>';
  while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC))
  {
    # Calculate sub-totals and grand total.
    $subtotal = $_SESSION['cart'][$row['item_id']]['quantity'] * $_SESSION['cart'][$row['item_id']]['price'];
    $total += $subtotal;

    # Display the row/s:
    echo "<td>{$row['item_name']}</td>
    <td><input type=\"text\" size=\"3\" name=\"qty[{$row['item_id']}]\" value=\"{$_SESSION['cart'][$row['item_id']]['quantity']}\"></td>
    <td>@ {$row['item_price']} = </td> <td>".number_format ($subtotal, 2)."</td></tr>";
  }
  
  # Close the database connection.
  mysqli_close($dbc); 
  
  # Display the total.
  echo '<tr><td colspan="5" style="text-align:right">Total = '.number_format($total,2).'</td></tr></table><input href"" class="checkout-btn" type="submit" name="submit" value="Update My Cart"></form>';
}
else
# Or display a message.
{ echo '<p>Your cart is currently empty.</p>' ; }
if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
{
    # Update changed quantity field values.
    foreach ( $_POST['qty'] as $item_id => $item_qty )
    {
        # Ensure values are integers.
        $id = (int) $item_id;
        $qty = (int) $item_qty;
        
        # Change quantity or delete if zero.
        if ( $qty == 0 ) { unset ($_SESSION['cart'][$id]); }
        elseif ( $qty > 0 ) { $_SESSION['cart'][$id]['quantity'] = $qty; }
    }
}

?>


   <a href="cart.php" class="checkout-btn">Checkout</a>
   </div>		

<?php # DISPLAY COMPLETE LOGIN PAGE.

 # Set page title and display header section.
 $page_title = 'Login' ;
 if ( isset( $_SESSION[ 'user_id' ] ) ) { echo 'You are already logged in'; }
 # Display any error messages if present.
 if ( isset( $errors ) && !empty( $errors ) )
 {
 echo '<p id="err_msg">Oops! There was a problem:<br>' ;
 foreach ( $errors as $msg ) { echo " - $msg<br>" ; }
 echo 'Please try again or <a href="register.php">Register</a></p>' ;
 }
 ?>


<!--CARD-->

<div class="container-fluid text-center hometxt">
<h1>Login</h1>
<div class="container">
				<div class="row">
        <div class="col"></div>
					<div style="padding-top:20px">
          <div class="col">
	
					<div class="card.bg-primary text-center card-form card">

 <!-- Display body section. -->
 <form action="login_action.php" method="post">
 <p>Email Address: <br>
	<input type="text" name="email"> </p>
	
 <p>Password: <br>
	<input type="password" name="pass"></p>

<div class="btn">
 <p>	<button type="submit" class="btn btn-Default" value="Login" >LOGIN</button><br><br>
	<button type="reset" class="btn btn-Default" value="Reset">RESET</button></p>
</div><br>
<a href="register.php" style"">
CREATE AN ACCOUNT!
</a>
 </form>

 </div></div></div><div class="col"></div></div></div></div>
</body>