<?php

require_once 'HTMLTemplate.php';
require_once 'phporm\globals.php';
require_once 'model\Room.php';
require_once 'Http.php';

use model\Room;

session_start();
if(!isset($_SESSION['room_form'])) {
    Http::sendRedirect('/index.php');
}

$rooms = Room::findAll();

$alert = null;
$template = new HTMLTemplate('Select a room type', 'template.php', array(
    'content' => 'views/roomselect.html.php',
    'rooms' => $rooms,
    'alert' => $alert
));

$template->render();