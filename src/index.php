<?php
require_once 'HTMLTemplate.php';
require_once 'phporm\globals.php';
require_once 'model\Hotel.php';
require_once 'Http.php';

use model\Hotel;
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
        $_SESSION['room_form'] = $form;
        $_SESSION['stay_length'] =
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