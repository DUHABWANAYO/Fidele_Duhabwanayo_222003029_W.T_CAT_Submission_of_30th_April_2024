<?php
include('Database_connection.php');
// Check if course_id is set
if(isset($_REQUEST['course_id'])) {
    $course_id = $_REQUEST['course_id'];
    
    // Prepare and execute SELECT statement
    $stmt = $connection->prepare("SELECT * FROM Courses WHERE course_id=?");
    $stmt->bind_param("i", $course_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        // Fetch Courses details
        $row = $result->fetch_assoc();
        $y = $row['course_id'];
        $z = $row['course_name'];
        $w = $row['course_code']; 
    } else {
        echo "Courses not found.";
    }
}
?>

<html>
<head>
    <title>Update Courses</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update Courses form -->
    <h2><u>Update Form of Courses</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
<html>
<body>
    <form method="POST">
        <label for="course_id">course_id:</label>
        <input type="text" name="course_id" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="course_name">course_name:</label>
        <input type="text" name="course_name" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="course_code">course_code:</label>
        <input type="text" name="course_code" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $course_id = $_POST['course_id'];
    $course_name = $_POST['course_name'];
    $course_code = $_POST['course_code'];
    
    // Update the Courses in the database
    $stmt = $connection->prepare("UPDATE Courses SET course_name=?, course_code=? WHERE course_id=?");
    $stmt->bind_param("ssi", $course_name, $course_code, $course_id);
    $stmt->execute();
    
    // Redirect to Courses.php
    header('Location: Courses.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
