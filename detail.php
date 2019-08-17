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
		<div id="cd-shadow-layer"></div>
		<div id="cd-cart">
   <h2>Cart</h2>
<?php # DISPLAY SHOPPING CART PAGE.

# Access session.
//session_start() ;

# Redirect if not logged in.
//if ( !isset( $_SESSION[ 'user_id' ] ) ) { header ('Location: login.php'); }



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
    <td>@ {$row['item_price']} = </td> <td>".number_format ($subtotal)."</td></tr>";
  }
  
  # Close the database connection.
  mysqli_close($dbc); 
  
  # Display the total.
  echo '<tr><td colspan="5" style="text-align:right">Total = '.number_format($total,2).'</td></tr></table><input href"" type="submit" name="submit" value="Update My Cart"></form>';
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

</div>
</div>
<?php 
ob_start();
if (isset($_REQUEST['item_id']))
{
    
$theItemId = $_REQUEST['item_id'];

$dbc = mysqli_connect("jose.stca.herts.ac.uk", "rt16aam", "wfeDF379", "dbrt16aam")
OR die(mysqli_connect_error());

mysqli_set_charset($dbc, "utf-8");

$q = "SELECT * FROM shop WHERE item_id=$theItemId";
$r = mysqli_query($dbc, $q);

if ($r)
{
    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC))
    {
        $thisImage = $row['item_img'];
        $thisId = $row['item_id'];
        $thisName = $row['item_name'];
        $thisPrice = $row['item_price'];
        $thisDesc = $row['item_desc'];
        $thisLike = $row['likes'];
        
        
        //echo "<div class=\"product\"><br><span style=\"font-size:smaller\"></span>";
        //echo "<br>";
        echo "<div style=\"padding-top:200px;\"><div class=\"container-fluid\"><div class=\"row\">"; 
        echo "<div class=\"col-lg-2\"></div><div class=\"col-lg-4\"><img style=\"height:400px;\" src=\"$thisImage\"/></div>";
        echo "<div class=\"col-lg-4\"><h1 style=\"letter-spacing:1px;\"> $thisName </h1>";
        echo "<p style=\"padding-top:20px; letter-spacing:1px;\"> $thisDesc <p/>";
        echo "<p style=\"font-size:60px; letter-spacing:1px;\"> &pound$thisPrice <p/>";
        echo "<form method='post' action='added.php?id=".$row['item_id']."'><button type='submit' class='btn btn-Default' value='Add to cart'><a style='color:black;' href='added.php?id=".$row['item_id']."'>Add To Cart</a></button></form>";
        echo "<br><form method='post'><button type='submit' class='btn btn-success' name='like' value=\"Like\">LIKE</button></form>";
        echo "$thisLike LIKES!</div></div>";
        
        if ('POST' == $_SERVER['REQUEST_METHOD']) {
        if (isset($_POST["like"])){
            //header("Refresh:0");
			$query = "UPDATE shop SET likes = likes + 1 WHERE item_id = $theItemId";
            $result = mysqli_query($dbc, $query);
            //echo $_SERVER['PHP_SELF'];
            header("Refresh:0");
        }
        }
    }
    echo '';
    }
}




else
{
    echo "No Item ID";
}
?>

</div>
</body>
</html>