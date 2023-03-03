<?php
$dbHost = "localhost";
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'brazza';
$mysqli = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($mysqli->connect_errno) {
    echo "Conect failed: " . $mysqli->connect_error;
    exit();
}

function prepararaspas($t)
{
    $j = explode('\'', $t);
    $te = '\\\'';
    $je = '';
    for ($h = 0; $h < sizeof($j); $h++) {
        if ($h == 0) {
            $je = $j[$h];
        } else {
            $je = $je . $te . $j[$h];
        }
    }

    $j = explode("\"", $je);
    $te = "\\\"";
    $je = '';
    for ($h = 0; $h < sizeof($j); $h++) {
        if ($h == 0) {
            $je = $j[$h];
        } else {
            $je = $je . $te . $j[$h];
        }
    }

    $j = explode("\n", $je);
    $te = "<br>";
    $je = '';
    for ($h = 0; $h < sizeof($j); $h++) {
        if ($h == 0) {
            $je = $j[$h];
        } else {
            $je = $je . $te . $j[$h];
        }
    }

    return $je;
}
