<?php

require_once 'HTMLTemplate.php';
require_once 'phporm\globals.php';
require_once 'model\Room.php';
require_once 'model\RoomType.php';
require_once 'model\Cart.php';
require_once 'model\Customer.php';
require_once 'model\Booking.php';
require_once 'Http.php';

use model\Customer;

session_start();
if(!isset($_SESSION['cart'])) {
    Http::sendRedirect('/index.php');
}

$cart = $_SESSION['cart'];
$alert = null;

if(isset($_POST['name'])) {
    $customer = new Customer();
    $customer->setName($_POST['name']);
    $customer->setAddress($_POST['address']);
    $customer->setCity($_POST['city']);
    $customer->setState($_POST['state']);
    $customer->setZip($_POST['zip']);
    $customer->setPhone($_POST['phone']);
    $customer->setEmail($_POST['email']);
    $cart->getBooking()->setCustomer($customer);

    $alert = $cart->saveCart();

    if($alert['type'] == 'alert-success') {
        unset($_SESSION['cart']);
    }
}

$template = new HTMLTemplate('Confirm your selections', 'template.php', array(
    'content' => 'views/confirmation.html.php',
    'alert' => $alert,
    'cart' => $cart,
    'scriptFile' => 'js/index.js'
));

$template->render();