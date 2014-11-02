<?php
require_once 'HTMLTemplate.php';
require_once 'phporm\globals.php';
require_once 'model\Hotel.php';

use model\Hotel;

$hotel = Hotel::find('id=1');

$template = new HTMLTemplate('Home', 'template.php', array(
    'content' => 'views/home.html.php',
    'hotel' => $hotel
));

$template->render();