<?php
session_start();
$nick = null;
if (isset($_SESSION["nick"])) {
    $id = $_SESSION["nick"];
}
?>