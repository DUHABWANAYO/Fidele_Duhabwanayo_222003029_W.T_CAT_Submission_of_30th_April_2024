<?php
// Connection details
include('Database_connection.php');

// Check if Faculty_ID is set
if(isset($_REQUEST['Faculty_ID'])) {
    $Faculty_ID = $_REQUEST['Faculty_ID'];
    
    // Prepare and execute SELECT statement
    $stmt = $connection->prepare("SELECT * FROM Faculty WHERE Faculty_ID=?");
    $stmt->bind_param("i", $Faculty_ID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        // Fetch Faculty details
        $row = $result->fetch_assoc();
        $y = $row['Name'];
        $z = $row['Contact_Information'];
        $w = $row['course_id'];
        $x = $row['Lecturer_names'];
    } else {
        echo "Faculty not found.";
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
        <label for="Name">Name:</label>
        <input type="text" name="Name" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="Contact_Information">Contact Information:</label>
        <input type="text" name="Contact_Information" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="course_id">course_id:</label>
        <input type="number" name="course_id" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="Lecturer_names">Lecturer_names:</label>
        <input type="text" name="Lecturer_names" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $Name = $_POST['Name'];
    $Contact_Information = $_POST['Contact_Information'];
    $course_id = $_POST['course_id'];
    $Lecturer_names = $_POST['Lecturer_names'];
    
    // Update the Faculty in the database
    $stmt = $connection->prepare("UPDATE Faculty SET Name=?, Contact_Information=?, course_id=?, Lecturer_names=? WHERE Faculty_ID=?");
    $stmt->bind_param("ssdsi", $Name, $Contact_Information, $course_id, $Lecturer_names, $Faculty_ID); // Corrected "sssdi" to "ssdsi"
    $stmt->execute();
    
    // Redirect to Faculty.php
    header('Location: Faculty.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
