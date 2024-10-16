<?php
session_start();
session_unset();
session_destroy();
header("Location: /ACTIVIDAD_DESARROLLO_1/Views/Html/LoginForms/Login.php?message=logged_out");
exit();
