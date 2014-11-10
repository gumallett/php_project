<?php

require_once 'HTMLTemplate.php';

$template = new HTMLTemplate('About gregmalletthotel', 'template.php', array(
    'content' => 'views/about.html.php'
));

$template->render();