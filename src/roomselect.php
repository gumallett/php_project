<?php

require_once 'HTMLTemplate.php';
require_once 'phporm\globals.php';
require_once 'model\Room.php';
require_once 'model\RoomType.php';
require_once 'model\Cart.php';
require_once 'model\Booking.php';
require_once 'Http.php';

use model\Room;
use model\RoomType;

session_start();
if(!isset($_SESSION['cart'])) {
    Http::sendRedirect('/index.php');
}

$cart = $_SESSION['cart'];

if(isset($_POST['room_type'])) {
    $room_type = RoomType::find('value=:type', array('type' => $_POST['room_type']));
    $room = Room::find('room_type_id=:id', array('id' => $room_type->getId()));
    $cart->getBooking()->setRoom($room);

    $booking = $cart->getBooking();
    $length = $cart->getStayLength();
    $rate = $booking->getRoom()->getNightlyRate();
    $numRooms = $cart->getNumRooms();
    $booking->setCost(number_format($length * $rate * $numRooms, 2));
    Http::sendRedirect('/confirmation.php');
}

$rooms = Room::findAll();

$template = new HTMLTemplate('Select a room type', 'template.php', array(
    'content' => 'views/roomselect.html.php',
    'rooms' => $rooms,
    'cart' => $cart,
    'scriptFile' => 'js/roomselect.js'
));

$template->render();