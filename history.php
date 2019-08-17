
<?php
require ('connect_db.php');
session_start();
# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

# Set page title and display header section.
$page_title = 'History' ;
$q = "SELECT * FROM orders WHERE user_id = '".$_SESSION['user_id']."'";
$r = mysqli_query ($dbc, $q);
while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC))
{
    $query = "SELECT * FROM orders WHERE user_id = '".$_SESSION['user_id']."'";
    $result = mysqli_query($dbc,$query);
    echo "<div><div style=\"float:left;\"><img style=\"height:100px\" src=\"{$row['item_img']}\"></div><div style=\"padding-top:50px;\"><div style=\"float:left; padding-left:10px;\">{$row['item_name']}</div>
    <div style=\"float:left; padding-left:10px;\"><input type=\"text\" size=\"3\" name=\"qty[{$row['item_id']}]\" value=\"{$_SESSION['cart'][$row['item_id']]['quantity']}\"></div>
    <div style=\"padding-left:10px;\">@ &pound{$row['item_price']} = ".'&pound'.number_format ($subtotal, 2)."</div></div></div><br><br><br>";
};

# Close database connection.
mysqli_close($dbc);?>
