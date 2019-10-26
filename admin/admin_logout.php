<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/newproject/configuration/db_config.php';
unset($_SESSION['admin_id']);
header('Location: home');
?>