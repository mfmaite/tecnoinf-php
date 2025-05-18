<?php
session_start();
session_destroy();
header("Location: /restaurant/login");
exit;
