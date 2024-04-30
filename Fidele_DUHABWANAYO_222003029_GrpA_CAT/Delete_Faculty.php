<?php
// Connection details
include('Database_connection.php');

// Check if Faculty_ID is set
if(isset($_REQUEST['Faculty_ID'])) {
    $Faculty_ID = $_REQUEST['Faculty_ID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM Faculty WHERE Faculty_ID=?");
    $stmt->bind_param("i", $Faculty_ID); // Assuming Faculty_ID is an integer
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
    echo "Faculty_ID is not set.";
}

$connection->close();
?>
