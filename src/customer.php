<?php

require_once 'HTMLTemplate.php';
require_once 'phporm\globals.php';
require_once 'model\Room.php';
require_once 'model\RoomType.php';
require_once 'model\Customer.php';
require_once 'model\Booking.php';
require_once 'Http.php';

use model\Customer;
use model\Booking;

$alert = null;
$customer = null;
$bookings = null;

if(isset($_GET['id'])) {
    $customer = Customer::find('id=:id', array('id' => $_GET['id']));
    $bookings = Booking::findAll('customer_id=:id', array('id' => $_GET['id']));
}

if($customer == null) {
    $alert = array(
        'message' => 'Customer not found.'
    );
}

$template = new HTMLTemplate('Customer Info', 'template.php', array(
    'content' => 'views/customerinfo.html.php',
    'alert' => $alert,
    'customer' => $customer,
    'bookings' => $bookings
));

$template->render();