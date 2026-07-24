<?php
declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('APP_NAME', 'AC Sneaker');
define('BASE_URL', '/3340project'); // Folder directly under public_html
define('CURRENCY_SYMBOL', '$');

date_default_timezone_set('America/Toronto');
