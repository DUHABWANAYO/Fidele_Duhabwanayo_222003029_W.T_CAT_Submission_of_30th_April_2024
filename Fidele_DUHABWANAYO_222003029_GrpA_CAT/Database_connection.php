 <?php
    // Connection details
 
    $host = "localhost";
    $user = "root";
    $pass = "";
    $database = "automated_students_attendance_system";

    // Creating connection
    $connection = new mysqli($host, "root", "", "automated_students_attendance_system");

    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
