

<?php

require_once 'HTMLTemplate.php';

$template = new HTMLTemplate('Find Customer', 'template.php', array(
    'content' => 'views/getcustomerinfo.html.php'
));

$template->render();