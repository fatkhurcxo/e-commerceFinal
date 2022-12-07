<?php
session_start();
session_destroy();

echo "<script> alert('Anda keluar');</script>";
exit();
