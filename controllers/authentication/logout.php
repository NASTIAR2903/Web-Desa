<?php
session_start();
session_destroy();
header("Location: ../../views/frontend_view/login.php");
