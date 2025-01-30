<?php

require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/databaseconnect.php');
require_once(__DIR__ . '/functions.php');

echo calculateMonthsRoundedUp('2022-01-01','2023-01-01');