<?php
// Mulai atau lanjutkan sesi yang ada
session_start();

// Hentikan sesi (logout)
session_destroy();

// Redirect ke halaman login atau halaman lain yang sesuai
header("Location: login.php");
exit;
