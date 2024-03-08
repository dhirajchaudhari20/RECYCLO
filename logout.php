<?php
session_start();

// Destroy the session
session_destroy();

// Redirect to the index.php page
header("Location: index.php");
exit();
?>
