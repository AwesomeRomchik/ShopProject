<!DOCTYPE html>
  <html lang="en">
  <head>
  <title>HUMAN RACE</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
  <script type="text/javascript">var name = "<?php echo $row['item_name']; ?>";</script>
  <style>
  .hometxt{
    color:white;
  }
  
  .bg-1 { 
      background-color: black;
  }

  .bg-2{
    background-color:#808B96;
  }

  .bg-3{
    background-color:#85C1E9  ;
  }
  .overlay {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 10;
  right: 20;
  height: 100%;
  width: 100%;
  opacity: 0;
  transition: .5s ease;
  background-color: #CACFD2;
 }

 .container1:hover .overlay {
  opacity: 0.8;
 }

 .text1{
  color: black;
  font-weight:bold;
  font-size: 20px;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
 }

  </style>
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
  echo '<form sylte="display:block;" action="" method="post"><table><tr><th colspan="5">Items in your cart</th></tr><tr>';
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

<!--carasoul-->
 <div style="padding-top:83px;">
 <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner" role="listbox">
    <div class="carousel-item active">
      <img class="d-block img-fluid" src="Images/BANNER1.png" style="width:100%;" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block img-fluid" src="Images/BANNER2.png" style="width:100%;" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block img-fluid" src="Images/BANNER3.png" style="width:100%;" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
 </div>
 </div>
<!--CONTENT1-->

 <div class="container-fluid text-center bg-2" style="padding-top:20px; padding-bottom:20px;">    
  
  <div class="row">
    <div class="col-sm-4 container1">
      <img src="Images/button.png" class="img-responsive margin" style="width:100%" alt="Image">
      <a href="women.php"><div class="overlay">
        <div class="text1">SHOP WOMENS</div>
      </div></a>
    </div>
    <div class="col-sm-4  container1"> 
      <img src="Images/button2.png" class="img-responsive margin" style="width:100%" alt="Image">
      <a href="kids.php"><div class="overlay">
        <div class="text1">SHOP KIDS</div>
      </div></a>
    </div>
    <div class="col-sm-4 container1"> 
      <img src="Images/button3.png" class="img-responsive margin" style="width:100%" alt="Image">
      <a href="men.php"><div class="overlay">
        <div class="text1">SHOP MENS</div>
      </div></a>
    </div>
  </div>
 </div>

<!--CONTENT2-->
 
    
  <div style="padding-top:20px" class="bg-1 container-fluid text-center hometxt">
  <h3 class="margin">INTRODUCING</h3><br>
  <h3 class="margin"><strong>PHARRELL WILLIAMS HUMAN RACE</strong></h3><br>
  <div class="row">
    <div class="col-sm-4">
      <p>THE HUMAN RACE IS A RARE FIND FOR ANY COLLECTOR, DESIGNED AND RELEASED IN LIMITED NUMBERS BY PHARRELL WILLIAMS</p>
      <img src="Images/PWHumanRaceNMDpharrell1.png" class="img-responsive margin" style="width:100%" alt="Image">
    </div>
    <div class="col-sm-4"> 
      <img src="Images/PWHumanRaceNMDTRbillionaireboysclub1.png" class="img-responsive margin" style="width:100%" alt="Image">
      <p>FIND YOUR COLOR WITH OUR RANGE OF PRODUCTS ON THE SHOP PAGE</p>
      
    </div>
    <div class="col-sm-4"> 
      <p>JOIN THE HUMAN RACE AND REGISTER AN ACCOUNT ON THE SIGN UP PAGE, FOLLOW OUR SOCIALS FOR UPDATES</p>
      <img src="Images/PWHumanRaceNMDpharrellFRIENDSANDFAMILY1.png" class="img-responsive margin" style="width:100%" alt="Image">
    </div>
  </div>
  </div>
 </div>


<!--CONTENT 3-->
 <div class="container-fluid text-center bg-3" style="padding-top:20px; padding-bottom:20px;">    
  <div class="row">
    <div class="col-sm-6">
      <img src="Images/pic1.png" class="img-responsive margin" style="width:100%" alt="Image">
    </div>
    <div class="col-sm-6"> 
      <img src="Images/pic2.png" class="img-responsive margin" style="width:100%" alt="Image">
    </div>
    
  </div>
 </div>
 
<!--footer-->
 <div class="container-fluid text-center text-md-left" style="background-color:#848383">
    <div class="row">

        <!--First column-->
        <div style="padding-top:10px" class="col-md-6">
            <h5 class="text-uppercase">THE HUMAN RACE</h5>
            <p>THANK YOU FOR VISITING THE HUMAN RACE, BE SURE TO CHECKOUT AND SHARE OUR SOCIALS.</p>
            <p>IMAGE SRC:www.flightclub.com , www.adidas.co.uk/</p>
        </div>
        <!--/.First column-->

        <!--Second column-->
        <div style="padding-top:10px" class="col-md-6">
            <h5 class="text-uppercase">L I N K S</h5>
            <ul class="list-unstyled">
                <li>
                    <a href="#!">FACEBOOK</a>
                </li>
                <li>
                    <a href="#!">TWITTER</a>
                </li>
                <li>
                    <a href="#!">INSTERGRAM</a>
                </li>
                
            </ul>
        </div>
        <!--/.Second column-->
    </div>
 </div>
 <!--/.Footer Links-->

 <!--Copyright-->
 <div class="footer-copyright py-3 text-center" style="background-color:#515050;">
    © 2018 Copyright:
    <a href="home.php"> THEHUMANRACE.com </a>
 </div>
 <!--/.Copyright-->

</footer>

</body>
</html>