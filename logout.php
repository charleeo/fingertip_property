<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/newproject/configuration/db_config.php';
unset($_SESSION['user_id']);
header('Location: index.php');
?>