<?php
$con = new mysqli("172.31.22.43", "Vinnie200547583", "rieqMag-x1", "Vinnie200547583");
if ($con->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
