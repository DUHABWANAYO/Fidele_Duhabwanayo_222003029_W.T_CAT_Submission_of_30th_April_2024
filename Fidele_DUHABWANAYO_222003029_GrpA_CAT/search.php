<?php
// Check if the 'query' GET parameter is set and not empty
if (isset($_GET['query']) && !empty($_GET['query'])) {
    // Include database connection
    include('Database_connection.php');

    // Sanitize input to prevent SQL injection
    $searchTerm = "%" . $_GET['query'] . "%";

    // Queries for different tables
    $queries = [
        'Students' => "SELECT First_Name FROM Students WHERE First_Name LIKE ?",
        'Faculty' => "SELECT Name FROM Faculty WHERE Name LIKE ?",
        'enrollment' => "SELECT enrollment_id FROM enrollment WHERE enrollment_id LIKE ?",
        'Courses' => "SELECT course_name FROM Courses WHERE course_name LIKE ?",
        'Attendance' => "SELECT attendance_id FROM Attendance WHERE attendance_id LIKE ?",
    ];

    // Output search results
    echo "<h2><u>Search Results:</u></h2>";

    // Creating connection
    $connection = new mysqli($host, $user, $pass, $database);

    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    foreach ($queries as $table => $sql) {
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("s", $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result) {
            echo "<h3>Table of $table:</h3>";
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<p>" . htmlspecialchars($row[array_keys($row)[0]]) . "</p>"; // Dynamic field extraction from result
                }
            } else {
                echo "<p>No results found in $table matching the search term: '" . htmlspecialchars($_GET['query']) . "'</p>";
            }
        } else {
            echo "<p>Error executing query for $table: " . $connection->error . "</p>";
        }
    }

    // Close the connection
    $connection->close();
} else {
    echo "<p>No search term was provided.</p>";
}
?>
