<?php
require_once 'HTMLTemplate.php';
require_once 'phporm\globals.php';
require_once 'model\Hotel.php';
require_once 'model\Cart.php';
require_once 'model\Booking.php';
require_once 'Http.php';

use model\Hotel;
use model\Cart;
use model\Booking;
use phporm\Logger;

function validate(&$form, &$alert) {
    $success = true;

    if (!isset($form['checkin']) || $form['checkin'] == '') {
        $alert['message'] = 'Checkin field should be set.';
        $success = false;
    }
    else {
        $checkin_date = $form['checkin'];

        try {
            $form['checkin'] = new DateTime($checkin_date);
        }
        catch(Exception $err) {
            $alert['message'] = 'Invalid checkin date: ' . $checkin_date.'. Enter date in format mm/dd/yyyy.';
            $success = false;
        }
    }

    if (!isset($form['checkout']) || $form['checkout'] == '') {
        $alert['message'] = 'Checkout field should be set.';
        $success = false;
    }
    else {
        $checkout_date = $form['checkout'];
        try {
            $form['checkout'] = new DateTime($checkout_date);
        }
        catch(Exception $err) {
            $alert['message'] = 'Invalid checkin date: ' . $checkout_date.'. Enter date in format mm/dd/yyyy.';
            $success = false;
        }
    }

    return $success;
}

Logger::log($_POST);
$alert = array();
if(isset($_POST['room_form'])) {
    $form = $_POST;
    $success = validate($form, $alert);
    Logger::log($form['checkin']);

    if ($success) {
        session_start();
        $diff = $form['checkin']->diff($form['checkout']);
        $diff = $diff->format('%a');
        $cart = new Cart();
        $cart->setStayLength($diff);
        $cart->setNumRooms($form['num_rooms']);
        $cart->setAdults($form['num_adults']);
        $cart->setChildren($form['num_kids']);

        $booking = new Booking();
        $booking->setStartDate($form['checkin']);
        $booking->setEndDate($form['checkout']);

        $cart->setBooking($booking);

        $_SESSION['cart'] = $cart;
        Http::sendRedirect('/roomselect.php');
    }
}

$hotel = Hotel::find('id=1');

$template = new HTMLTemplate('Home', 'template.php', array(
    'content' => 'views/home.html.php',
    'hotel' => $hotel,
    'alert' => $alert,
    'scriptFile' => 'js/index.js'
));

if (isset($_POST['room_form'])) {
    foreach ($_POST as $key => $val) {
        $template->$key = $val;
    }
}

$template->render();