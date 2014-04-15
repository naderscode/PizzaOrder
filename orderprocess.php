<?php

/**
 * Created by Nader K
 * Date: 3/4/14
 */

echo '<h1>Thank You For Your Order</h1>';


//Today's Date

print("Today is ".Date("F d Y,"));

print '<br />';

$name = $_POST['name'];
$address = $_POST['street'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$size = $_POST['size'];

$crust = $_POST['crust'];

$quantity = $_POST['quantity'];
$ordertype = $_POST['ordertype'];
$coupon = $_POST['coupon'];

$instructions = $_POST['instructions'];

//creating response page in html
echo "<h3>Customer Information</h3>";

echo 'Name: ' . $name .'<br />';
echo 'Address: ' . $address .'<br />';
echo 'City: ' . $city .'<br />';
echo 'State: '. $state .'<br />';
echo 'Zip: '. $zip .'<br />';
echo 'Phone: '. $phone .'<br />';
echo 'Email: '. $email .'<br />';

echo "<h4>Here Are Your Order Details: </h4>";



echo 'Size: ' . $size . '<br />';
if($size=='small')
{
    $baseprice = 10;
    echo " Base price: ". "$" . $baseprice . '<br />';
}
elseif($size=='medium')
{
    $baseprice = 13;
    echo " Base price: ". "$" . $baseprice . '<br />';
}
elseif($size=='large')
{
    $baseprice = 15;
    echo " Base price: ". "$" . $baseprice . '<br />';
}

echo 'Crust: ' . $crust . '<br>';
echo "Toppings: ";
$toppings = $_POST['topping'];
foreach($toppings as $item) echo  "$item" . ", ";
echo "<br />";

$counttop =count($toppings);
echo "Number of toppings: " . $counttop . '<br />';

$extratopprice = 0;
if($counttop> 3)
{
    $extratop = $counttop - 3;
    echo 'Extra toppings: ' . $extratop .'<br />';

    $extratopprice = ($extratop * 1.25);

    echo ' Extra topping total: $' . $extratopprice . '<br />';

}

$pizzaprice = $baseprice + $extratopprice;

echo 'Quantity: ' .$quantity . '<br />';

$totalprice = ($pizzaprice * $quantity);

echo 'Order Type: '. $ordertype . '<br />';

$delivery=0;
if($ordertype == 'delivery')
{

$delivery = 3;
}
else $delivery = 0;

echo 'Delivery: $'. $delivery .'<br />';

$couponvalue = 0;
if($coupon)
{
    $couponvalue = 2;
    echo 'Coupon: ' . "Coupon Available". '<br />';

    echo 'Coupon value: $' . $couponvalue .'<br />';
}
else{

    $couponvalue = 0;
    echo 'Coupon: ' . "No Coupons ". '<br />';
}

$balance = ($totalprice + $delivery - $couponvalue);

echo '<p><em><strong>Your Total Balance is:</strong></em></p> ' .'$'. $balance . '<br />';

echo ' Your Special Instructions: [ ' . $instructions . '], have been taken into consideration. ' .'<br />';

echo '<p><strong>Thank You For Your Order!</strong></p>';



// saving data to a text file
$filename = "orders.txt";
$file = fopen( $filename, "a" );
if( $file == false )
{
    echo ( "Error in opening new file" );
    exit();
}
fwrite($file,  $name . ", ");
fwrite($file,  $address. ", ");
fwrite($file,  $city. ", ");
fwrite($file,  $state. ", ");
fwrite($file,  $zip. ", ");
fwrite($file,  $phone. ", ");
fwrite($file,  $email. ", ");
fwrite($file,  $size. ", ");
fwrite($file,  $crust. ", ");
foreach($toppings as $item)
{
    fwrite($file,  $item. " ");
}
fwrite($file, ", ". $quantity. ", ");
fwrite($file,  $ordertype. ", ");
fwrite($file,  $coupon. ", ");
fwrite($file, $instructions. ", ");
fwrite($file,  $balance. "\n");


fclose( $file );

//mail data


$to = 'myname@gmail.com';
$subject = 'Your Pizza Order';
$message =
    'Name:' . $name . '\r\n' .
    ' Address: ' . $address . '\r\n' .
    ' City: ' . $city . '\r\n' .
    ' State: '. $state . '\r\n' .
    ' Zip: '. $zip . '\r\n' .
    ' Phone: '. $phone . '\r\n' .
    ' Email: '. $email .'\r\n';
mail($to, $subject, $message);

?>
