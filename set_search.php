<?php

//initialize sessions
session_start();

//set_search.php receives input from the user's search attempt, 
//assigns it to a session superglobal, and sends the user to search_results.php
//This page is NOT viewed by the user

require_once "includes/database.php";

//checks for data posted in the search form
if (isset($_GET['search'])) {

    $search = mysqli_real_escape_string($db, filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING));


    //assigns session superglobals to the user input.
    $_SESSION["search"] = $search;

    //let the user view results by redirecting them to search_results.php
    header("Location: search_results.php");
}
