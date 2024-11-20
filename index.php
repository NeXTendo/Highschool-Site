<?php
include("/Code/HighschoolSite/backend/config/db.php");

$page = isset($_GET['page']) ? $_GET['page'] : 'index';
include("./frontend/" . $page . ".html");
?>
