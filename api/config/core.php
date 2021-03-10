<?php
error_reporting(E_ALL);

// default time-zone
date_default_timezone_set('UTC');

// set variable used for jwt
$key = "klwtuihsadvager";
$issued_at = time();
$expiration_time = $issued_at + (60 * 60); // 1 hour
$issuer = "8185_project2";
