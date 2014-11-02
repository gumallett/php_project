<?php
require_once 'HTMLTemplate.php';
require_once 'phporm\globals.php';
require_once 'model\Hotel.php';
require_once 'Http.php';

use model\Hotel;
use phporm\Logger;

function validate($form, &$alert) {
    if (!isset($form['checkin']) || $form['checkin'] == '' || !isset($form['checkout']) || $form['checkout'] == '') {
        $alert = 'Both checkin and checkout fields should be set.';
        return false;
    }

    return true;
}

Logger::log($_POST);
$alert = null;
if(isset($_POST['room_form'])) {
    $success = validate($_POST, $alert);

    if ($success) {
        session_start();
        $_SESSION['room_form'] = $_POST['room_form'];
        Http::sendRedirect('/roomselect.php');
    }
}

$hotel = Hotel::find('id=1');

$template = new HTMLTemplate('Home', 'template.php', array(
    'content' => 'views/home.html.php',
    'hotel' => $hotel,
    'alert' => $alert
));

$template->render();