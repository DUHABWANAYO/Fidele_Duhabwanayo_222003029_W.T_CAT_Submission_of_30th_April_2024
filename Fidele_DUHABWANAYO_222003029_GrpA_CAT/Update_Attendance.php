<?php
// Connection details
include('Database_connection.php');
// Check if attendance_id is set
if(isset($_REQUEST['attendance_id'])) {
    $attendance_id = $_REQUEST['attendance_id']; // Correct variable name
    
    // Prepare and execute SELECT statement
    $stmt = $connection->prepare("SELECT * FROM Attendance WHERE attendance_id=?");
    $stmt->bind_param("i", $attendance_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        // Fetch Attendance details
        $row = $result->fetch_assoc();
        $y = $row['attendance_id'];
        $z = $row['student_id'];
        $w = $row['course_id'];
        $x1 = $row['attendance_date']; // Correct variable name
        $x2 = $row['status']; // Correct variable name
    } else {
        echo "Attendance not found.";
    }
}
?>

<html>
<head>
    <title>Update Attendance</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update Attendance form -->
    <h2><u>Update Form of Attendance</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="attendance_id">attendance_id:</label>
        <input type="text" name="attendance_id" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="student_id">student_id:</label>
        <input type="text" name="student_id" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="course_id">course_id:</label>
        <input type="number" name="course_id" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="attendance_date">attendance_date:</label>
        <input type="date" name="attendance_date" value="<?php echo isset($x1) ? $x1 : ''; ?>"> <!-- Corrected input type to "date" -->
        <br><br>

         <label for="status">status:</label>
        <input type="text" name="status" value="<?php echo isset($x2) ? $x2 : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
include('Database_connection.php');
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $attendance_id = $_POST['attendance_id'];
    $student_id = $_POST['student_id'];
    $course_id = $_POST['course_id'];
    $attendance_date = $_POST['attendance_date'];
    $status = $_POST['status'];
    
    // Update the Attendance in the database
    $stmt = $connection->prepare("UPDATE Attendance SET student_id=?, course_id=?, attendance_date=?, status=? WHERE attendance_id=?");
    $stmt->bind_param("ssssi", $student_id, $course_id, $attendance_date, $status, $attendance_id); // Corrected "ssdsi" to "ssssi"
    $stmt->execute();
    
    // Redirect to Attendance.php
    header('Location: Attendance.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
