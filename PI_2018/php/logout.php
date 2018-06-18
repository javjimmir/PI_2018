<?php
session_start();
session_unset(); // remove all session variables
session_destroy();  // destroy the session
header('location: ../index.php?status=logout');