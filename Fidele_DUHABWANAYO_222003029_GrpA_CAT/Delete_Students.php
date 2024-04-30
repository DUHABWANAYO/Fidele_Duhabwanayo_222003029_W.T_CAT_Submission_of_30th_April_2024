<?php
// Connection details
include('Database_connection.php');

// Check if Student_ID is set and not empty
if(isset($_GET['Student_ID']) && !empty($_GET['Student_ID'])) {
    $Student_ID = $_GET['Student_ID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM Students WHERE Student_ID=?");
    $stmt->bind_param("i", $Student_ID); // Assuming Student_ID is an integer
    ?>

<!DOCTYPE html>
    <html>
    <head>
        <title>Delete Record</title>
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this record?");
            }
        </script>
    </head>
    <body>
        <form method="post" onsubmit="return confirmDelete();">
            <input type="hidden" name="attendance_id" value="<?php echo $attendance_id; ?>">
            <input type="submit" value="Delete">
        </form>
        <?php
 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
        // Redirect back to the students page after deletion
        header("Location: Students.php");
        exit(); // Exit to prevent further execution
    } else {
        echo "Error deleting data: " . $stmt->error;
    }

    }
?>
</body>
</html>
<?php

    $stmt->close();
} else {
    echo "Student_ID is not set or empty.";
}

$connection->close();
?>
