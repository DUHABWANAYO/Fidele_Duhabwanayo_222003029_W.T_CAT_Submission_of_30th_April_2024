<?php
// Connection details
include('Database_connection.php');

// Check if Student_ID is set
if(isset($_REQUEST['Student_ID'])) {
    $Student_ID = $_REQUEST['Student_ID'];
    
    // Prepare and execute SELECT statement
    $stmt = $connection->prepare("SELECT * FROM Students WHERE Student_ID=?");
    $stmt->bind_param("i", $Student_ID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        // Fetch Student details
        $row = $result->fetch_assoc();
        $y = $row['Student_ID'];
        $z = $row['First_Name'];
        $w = $row['Last_Name'];
        $x = $row['Date_Of_Birth'];
        $e = $row['Email'];
    } else {
        echo "Student not found.";
    }
}
?>

<html>
<head>
    <title>Update Student</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update Student form -->
    <h2><u>Update Form of Student</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="Student_ID">Student_ID:</label>
        <input type="text" name="Student_ID" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="First_Name">First_Name:</label>
        <input type="text" name="First_Name" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="Last_Name">Last_Name:</label>
        <input type="text" name="Last_Name" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="Date_Of_Birth">Date_Of_Birth:</label>
        <input type="date" name="Date_Of_Birth" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <label for="Email">Email:</label>
        <input type="text" name="Email" value="<?php echo isset($e) ? $e : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $Student_ID = $_POST['Student_ID'];
    $First_Name = $_POST['First_Name'];
    $Last_Name = $_POST['Last_Name'];
    $Date_Of_Birth = $_POST['Date_Of_Birth'];
    $Email = $_POST['Email'];
    
    // Update the student in the database
    $stmt = $connection->prepare("UPDATE Students SET First_Name=?, Last_Name=?, Date_Of_Birth=?, Email=? WHERE Student_ID=?");
    $stmt->bind_param("ssssi", $First_Name, $Last_Name, $Date_Of_Birth, $Email, $Student_ID);
    $stmt->execute();
    
    // Redirect to Students.php
    header('Location: Students.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
