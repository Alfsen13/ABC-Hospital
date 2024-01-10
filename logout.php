<?php
// Memulai session
session_start();

// Hapus semua data session
session_unset();

// Hancurkan session
session_destroy();

// Redirect ke halaman login
header("Location: login.html");
exit();
?>
