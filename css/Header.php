<?php
session_start();
header("Content-type: text/css");
$GLOBALS['XMLReader'] = simplexml_load_string($_SESSION['XMLReader-String']);
$GLOBALS['CredConfig'] = simplexml_load_string($_SESSION['CredConfig-String']);
$HeaderPhoto = $GLOBALS['XMLReader']->HeaderImage;
?>

/* The hero image */

.header {
    /* Use "linear-gradient" to add a darken background effect to the image (photographer.jpg). This will make the text easier to read */
    background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("..<?=$HeaderPhoto?>");
    /* Set a specific height */
    height: 50%;
    /* Position and center the image to scale nicely on all screens */
    background-position: center;
    background-repeat: no-repeat;
    background-size: 100% 100%;
    position: relative;
}


/* Place text in the middle of the image */

.hero-text {
    text-align: end;
    position: absolute;
    top: 90%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
}

a.button {
    -webkit-appearance: button;
    -moz-appearance: button;
    appearance: button;
    text-decoration: none;
    color: initial;
    border: none;
    outline: 0;
    display: inline-block;
    padding: 10px 25px;
    color: black;
    background-color: #ddd;
    text-align: center;
    cursor: pointer;
}

a.button:hover {
    background-color: #555;
    color: white;
}