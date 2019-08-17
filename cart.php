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
  </head> 
  <body style="padding-top:100px;">
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
						<?php   session_start();
						        if(isset($_SESSION['user_id']))
                                {
                                echo '<li><a href="logout.php" class="nav-link">LOG OUT</a></li>' ;
                                }
                                else{
                                echo'<li><a href="login.php" class="nav-link">LOG IN</a></li>' ;
                                }
                                ?>
					</li>
		  <li class="nav-item">
						<a href="#0" class="nav-link" id="cd-cart-trigger">CART</a>
			</ul>
					</li>				
    		</ul>
			
			
		</div>
		</nav>
<div class="container-fluid" style="padding-top:75px">
<?php # DISPLAY SHOPPING CART PAGE.

# Access session.
//session_start() ;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

# Set page title and display header section.
$page_title = 'Cart' ;

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
  echo '<form action="cart.php" method="post"><h2>Items in your cart</h2><br>';
  while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC))
  {
    # Calculate sub-totals and grand total.
    $subtotal = $_SESSION['cart'][$row['item_id']]['quantity'] * $_SESSION['cart'][$row['item_id']]['price'];
    $total += $subtotal;

    # Display the row/s:
    echo "<div><div style=\"float:left;\"><img style=\"height:100px\" src=\"{$row['item_img']}\"></div><div style=\"padding-top:50px;\"><div style=\"float:left; padding-left:10px;\">{$row['item_name']}</div>
    <div style=\"float:left; padding-left:10px;\"><input type=\"text\" size=\"3\" name=\"qty[{$row['item_id']}]\" value=\"{$_SESSION['cart'][$row['item_id']]['quantity']}\"></div>
    <div style=\"padding-left:10px;\">@ &pound{$row['item_price']} = ".'&pound'.number_format ($subtotal, 2)."</div></div></div><br><br><br>";
  }
  
  //echo "<tr><td><img style=\"height:100px\" src=\"{$row['item_img']}\"></td> <td>{$row['item_name']}</td>
   // <td><input type=\"text\" size=\"3\" name=\"qty[{$row['item_id']}]\" value=\"{$_SESSION['cart'][$row['item_id']]['quantity']}\"></td>
   // <td>@ &pound{$row['item_price']} = </td> <td>".'&pound'.number_format ($subtotal, 2)."</td></tr>";
  
  # Close the database connection.
  mysqli_close($dbc); 
  
  # Display the total.
  echo ' <p style="padding-left:450px;">Total = &pound'.number_format($total,2).'</p><br><input style="width:150px; height:60px; text-align:center;" type="submit" name="submit" value="Update My Cart">';
  //echo '<input type="submit" name="submit" value="Checkout">';
  //echo '<a style="background:yellow;"class="checkout-btn" href="checkout.php?total='.$total.'">Checkout</a>';
  echo '<button style="margin-left:350px;" type="submit" formaction="checkout.php?total='.$total.'" class="btn btn-Default"><a style=\"color:black;\" href="checkout.php?total='.$total.'">Checkout</a></button></form>';
}
else
# Or display a message.
{ echo '<p>Your cart is currently empty.</p>' ; }

# Create navigation links.
//echo '<p><a href="shop.php">Shop</a> | <a href="checkout.php?total='.$total.'">Checkout</a> | <a href="forum.php">Forum</a> | <a href="home.php">Home</a> | <a href="goodbye.php">Logout</a></p>' ;

# Display footer section.

?></div></body>