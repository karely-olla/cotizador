<?php
session_start();

if (!isset($_SESSION['user'])) { 
echo'<script>window.location.href = "/cotizador/views/login.php";</script>';
} ?>

 <?php if (array_key_exists('logout', $_GET)) { 
	session_unset();
	echo '<script>window.location.href = "/cotizador/views/login.php";</script>';
}
?>

