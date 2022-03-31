<?php

/***************************************************************************************************
 * MAIN CONTROLLER
 * *************************************************************************************************/
// Create or access a Session
session_start();

// getting the database connection file.
require_once 'library/connections.php';
// getting thephphmotors model.
require_once 'model/main-model.php';
// Get the functions library
require_once 'library/functions.php';

// getting the array of classifications.
$classifications = getClassifications();

// var_dump($classifications);
// exit;

// building a navigation bar using the $classifications array
$navList  = createNavList();

// echo $navList;
// exit;


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}
// Check if the firstname cookie exists, get its value
if (isset($_COOKIE['firstname'])) {
    $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

switch ($action) {
    case 'template':
        include 'view/template.php';
        break;
    default:
        if (isset($_SESSION['loggedin'])) {
            include 'view/admin.php';
            exit();
        } else {
            include 'view/home.php';
            exit();
        }
        break;
}
