<?php
// Connection details
include('Database_connection.php');

// Check if enrollment_id is set
if(isset($_REQUEST['enrollment_id'])) {
    $enrollment_id = $_REQUEST['enrollment_id']; // Correct variable name
    
    // Prepare and execute SELECT statement
    $stmt = $connection->prepare("SELECT * FROM enrollment WHERE enrollment_id=?");
    $stmt->bind_param("i", $enrollment_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        // Fetch Enrollment details
        $row = $result->fetch_assoc();
        $y = $row['enrollment_id'];
        $z = $row['student_id'];
        $w = $row['Contact_Information'];
        $x = $row['Lecturer_name']; // Correct variable name
    } else {
        echo "enrollment not found.";
    }
}
?>

<html>
<body>
    <form method="POST">
        <label for="enrollment_id">Name:</label>
        <input type="text" name="enrollment_id" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="student_id">student_id:</label>
        <input type="text" name="student_id" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="Contact_Information">Contact_Information:</label>
        <input type="text" name="Contact_Information" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="Lecturer_name">Lecturer_name:</label>
        <input type="text" name="Lecturer_name" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $enrollment_id = $_POST['enrollment_id'];
    $student_id = $_POST['student_id'];
    $Contact_Information = $_POST['Contact_Information'];
    $Lecturer_name = $_POST['Lecturer_name'];
    
    // Update the enrollment in the database
    $stmt = $connection->prepare("UPDATE enrollment SET student_id=?, Contact_Information=?, Lecturer_name=? WHERE enrollment_id=?");
    $stmt->bind_param("sssi", $student_id, $Contact_Information, $Lecturer_name, $enrollment_id); // Corrected "sssdi" to "sssi"
    $stmt->execute();
    
    // Redirect to Enrollments.php
    header('Location: Enrollments.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
