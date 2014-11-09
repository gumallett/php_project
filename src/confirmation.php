<?php

require_once 'HTMLTemplate.php';
require_once 'phporm\globals.php';
require_once 'model\Room.php';
require_once 'model\RoomType.php';
require_once 'model\Cart.php';
require_once 'model\Booking.php';
require_once 'Http.php';

session_start();
if(!isset($_SESSION['cart'])) {
    Http::sendRedirect('/index.php');
}

$cart = $_SESSION['cart'];

$alert = null;
$template = new HTMLTemplate('Confirm your selections', 'template.php', array(
    'content' => 'views/confirmation.html.php',
    'alert' => $alert,
    'cart' => $cart
));

$template->render();