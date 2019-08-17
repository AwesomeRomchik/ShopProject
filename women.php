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
//session_start();

# Redirect if not logged in.
//if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }



# Check if form has been submitted for update.
if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
{
  if (isset($_POST['qty']))
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
    <td>@ &pound{$row['item_price']} = </td> <td>&pound".number_format ($subtotal)."</td></tr>";
  }
  
  # Close the database connection.
  mysqli_close($dbc); 
  
  # Display the total.
  echo '<tr><td colspan="5" style="text-align:right">Total = '.'&pound'.number_format($total,2).'</td></tr></table><br><input href"" class="checkout-btn" type="submit" name="submit" value="Update My Cart">';
  echo '<br>';
  echo '<a href= "cart.php" class="checkout-btn">Checkout</a></form>';
}
else
# Or display a message.
{ echo '<p>Your cart is currently empty.</p>' ; }
if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
{
    if (isset($_POST['qty']))
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
}
?>
	</div>

<div style="display: inline-block;">
<div class="sorting" style="padding-top:100px;padding-left:20px;">
<nav class="card" style="padding-left:5px;padding-right:5px;">
	<h3>Filter by...</h3>
	<h5>Colour:</h5>
	<form action="women.php" method="post">
	<input type="radio" name="colour" value="black"><label for="black">Black</label><br>
	<input type="radio" name="colour" value="yellow"><label for="yellow">Yellow</label><br>
	<input type="radio" name="colour" value="beige"><label for="beige">Beige</label><br>
	<input type="radio" name="colour" value="blue"><label for="red">Blue</label><br>
	<input type="radio" name="colour" value="red"><label for="red">Red</label><br>
	<input type="radio" name="colour" value="green"><label for="green">Green</label><br>
	<input type="radio" name="colour" value="mix"><label for="mix">Mix</label><br>
	<input type="radio" name="colour" value="grey"><label for="grey">Grey</label><br>
	<input type="radio" name="colour" value="purple"><label for="purple">Purple</label><br>
	<h5>Apparel type:</h5>
	<input type="radio" name="item_type" value="shoe"><label for="shoe">Shoes</label><br>
	<input type="radio" name="item_type" value="shorts"><label for="shorts">Shorts</label><br>
	<input type="radio" name="item_type" value="tee"><label for="tee">Tees</label><br>
	<input type="radio" name="item_type" value="jacket"><label for="jacket">Jackets</label><br>
	<input type="radio" name="item_type" value="windbreaker"><label for="windbreaker">Windbreakers</label><br>
	<input type="radio" name="item_type" value="tanktop"><label for="tanktop">Tanktops</label><br>
	<input type="radio" name="item_type" value="skirt"><label for="skirt">Skirts</label><br><br>
	<h3>Sort By:</h3>
	<input type="radio" name="price" value="mintomax"><label for="price">Price: Min to Max</label><br>
	<input type="radio" name="price" value="maxtomin"><label for="price">Price: Max to Min</label><br>
	<br>
	<button type="submit" class="btn btn-success" type="submit" value="Submit">FILTER</button>
	<a href="kids.php"></a><button type="submit" class="btn btn-danger" type="submit" value="Reset">RESET</button></a>
	
	</form>
	
	
</nav>
</div>

<div class="products">
<?php # DISPLAY COMPLETE PRODUCTS PAGE.

 # Access session.

 # Redirect if not logged in.
 //if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

 # Set page title and display header section.
 //$page_title = 'Shop' ;

 # Open database connection.
 require ( 'connect_db.php' ) ;

 # Retrieve items from 'shop' database table.
 $q = "SELECT * FROM shop WHERE gender='women'" ;
 if(isset($_POST['colour'])){
     if($_POST['colour'] == 'black'){
         //Run query
         $q = "SELECT * FROM shop WHERE colour = 'black' AND gender='women'";
     }elseif($_POST['colour'] == 'beige'){
         //Run query
         $q = "SELECT * FROM shop WHERE COLOUR = 'beige' AND gender='women'";
     }elseif($_POST['colour'] == 'blue'){
         //Run query
         $q = "SELECT * FROM shop WHERE COLOUR = 'blue' AND gender='women'";
     }elseif($_POST['colour'] == 'green'){
         //Run query
         $q = "SELECT * FROM shop WHERE COLOUR = 'green' AND gender='women'";
     }elseif($_POST['colour'] == 'mix'){
         //Run query
         $q = "SELECT * FROM shop WHERE COLOUR = 'mix' AND gender='women'";
     }elseif($_POST['colour'] == 'grey'){
         //Run query
         $q = "SELECT * FROM shop WHERE COLOUR = 'grey' AND gender='women'";
     }elseif($_POST['colour'] == 'purple'){
         //Run query
         $q = "SELECT * FROM shop WHERE COLOUR = 'purple' AND gender='women'";
     }elseif($_POST['colour'] == 'yellow'){
         //Run query
         $q = "SELECT * FROM shop WHERE COLOUR = 'yellow' AND gender='women'";
     }elseif($_POST['colour'] == 'red'){
         //Run query
         $q = "SELECT * FROM shop WHERE COLOUR = 'red' AND gender='men'";
     }
 }
 elseif(isset($_POST['item_type'])){
     if($_POST['item_type'] == 'shoe'){
         //Run query
         $q = "SELECT * FROM shop WHERE item_type='shoe' AND gender='women'";
     }elseif($_POST['item_type'] == 'shorts'){
         //Run query
         $q = "SELECT * FROM shop WHERE item_type='shorts' AND gender='women'";
     }elseif($_POST['item_type'] == 'tee'){
         //Run query
         $q = "SELECT * FROM shop WHERE item_type='tee' AND gender='women'";
     }elseif($_POST['item_type'] == 'jacket'){
         //Run query
         $q = "SELECT * FROM shop WHERE item_type='jacket' AND gender='women'";
     }elseif($_POST['item_type'] == 'windbreaker'){
         //Run query
         $q = "SELECT * FROM shop WHERE item_type='windbreaker' AND gender='women'";
     }elseif($_POST['item_type'] == 'tanktop'){
         //Run query
         $q = "SELECT * FROM shop WHERE item_type='tanktop' AND gender='women'";
     }elseif($_POST['item_type'] == 'skirt'){
         //Run query
         $q = "SELECT * FROM shop WHERE item_type='skirt' AND gender='women'";
     }else{
         $query = "SELECT * FROM shop WHERE gender='women'";
 }
 }
 elseif(isset($_POST['price'])){
     if($_POST['price'] == 'mintomax'){
         //Run query
         $q = "SELECT * FROM shop WHERE gender='women' ORDER BY item_price ASC";
     }elseif($_POST['price'] == 'maxtomin'){
         //Run query
         $q = "SELECT * FROM shop WHERE gender='women' ORDER BY item_price DESC";
     }
 }
 $r = mysqli_query( $dbc, $q ) ;
 if ( mysqli_num_rows( $r ) > 0 )
 {
  # Display body section.
     echo '';
     while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
     {
         $thisImage = $row['item_img'];
         $thisId = $row['item_id'];
         $thisName = $row['item_name'];
         $thisPrice = $row['item_price'];
         
         
         echo "<div class=\"product\"><br><span style=\"font-size:smaller\"></span>";
         echo "<br>";
         echo "<a href= 'detail.php?item_id=$thisId'>";
         echo "<img style=\"height:200px;\" src=\"$thisImage\"/><br>";
         echo '<div style="text-align: center;">' . $row['item_name'] .'<br>&pound' . $row['item_price'] . '<br>';
         echo '<form method="post" action="added.php?id='.$row['item_id'].'"><button type="submit" class="btn btn-dark" value="Add to cart" style=\"color:black;\" href="added.php?id='.$row['item_id'].'">Add To Cart</button></form></div></div>';
     }
     echo '';
  
  # Close database connection.
  mysqli_close( $dbc ) ; 
 }
 # Or display message.
 else { echo '<p style="text-align:center; padding-left:200px; padding-top:50px;">Sorry, no items match your request</p>' ; }
 ?>
</div>
</div>