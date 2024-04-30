<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Courses page</title>
  <style>
    /* Normal link */
    a {
      padding: 10px;
      color: white;
      background-color: yellow;
      text-decoration: none;
      margin-right: 15px;
    }

    /* Visited link */
    a:visited {
      color: purple;
    }
    /* Unvisited link */
    a:link {
      color: brown; /* Changed to lowercase */
    }
    /* Hover effect */
    a:hover {
      background-color: white;
    }

    /* Active link */
    a:active {
      background-color: red;
    }

    /* Extend margin left for search button */
    button.btn {
      margin-left: 15px; /* Adjust this value as needed */
      margin-top: 4px;
    }
    /* Extend margin left for search button */
    input.form-control {
      margin-left: 1300px; /* Adjust this value as needed */
      padding: 8px;
    }
  </style>



<!-- JavaScript validation and content load for insert data-->
        <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>




</head>

<body style="background-color: pink;">
  <form class="d-flex" role="search" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
      <button class="btn btn-outline-success" type="submit">Search</button>
  </form>

  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
      <img src="./image/logo.JPG" width="90" height="60" alt="Logo">
    </li>
    <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./Students.php">STUDENTS</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./Courses.php">COURSES</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./Attendance.php">ATTENDANCE</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./Faculty.php">FACULTY</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./Enrollments.php">ENROLLMENTS</a></li>

    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>
        <a href="logout.php">Logout</a>
      </div>
    </li>
  </ul>

  <section>
    <h1>Courses Form</h1>
    <form method="post" action="Courses.php">
      <label for="course_id">Course Id:</label>
      <input type="number" id="course_id" name="course_id" required><br><br>

      <label for="course_name">Course Name:</label>
      <input type="text" id="course_name" name="course_name" required><br><br>

      <label for="course_code">Course code:</label>
      <input type="text" id="course_code" name="course_code" required><br><br>

      <input type="submit" name="add" value="Insert"><br><br><br><br><br>
    </form><br><br><br>

    <?php
    // Connection details
    include('Database_connection.php');

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare and bind the parameters
        $stmt = $connection->prepare("INSERT INTO Courses(course_id,course_name, course_code) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $course_id, $course_name, $course_code);

        // Set parameters and execute
        $course_id = $_POST['course_id'];
        $course_name = $_POST['course_name'];
        $course_code = $_POST['course_code'];

        if ($stmt->execute() == TRUE) {
            echo "New record has been added successfully";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
    $connection->close();
    ?>

    <?php
    // Connection details
    include('Database_connection.php');
    $host = "localhost";
    $user = "root";
    $pass = "";
    $database = "automated_students_attendance_system";

    // Creating connection
    $connection = new mysqli($host, $user, $pass, $database);

    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    // SQL query to fetch data from the Courses
    $sql = "SELECT * FROM Courses";
    $result = $connection->query($sql);
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Detail information Of Courses</title>
        <style>
            table {
                width: 50%;
                border-collapse: collapse;
            }

            th, td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }

            th {
                background-color: #f2f2f2;
            }
        </style><center>
    </head>
    <body>
        <center><h2>Table of Courses</h2></center>
        <table border="10">
            <tr>
                <th>course_id</th>
                <th>course_name</th>
                <th>course_code</th>
                <th>Delete</th>
                <th>Update</th>
            </tr>
            <?php
            // Define connection parameters
            $host = "localhost";
            $user = "root";
            $pass = "";
            $database = "automated_students_attendance_system";

            // Establish a new connection
            $connection = new mysqli($host, $user, $pass, $database);

            // Check if connection was successful
            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }

            // Prepare SQL query to retrieve all Attendance
            $sql = "SELECT * FROM Courses";
            $result = $connection->query($sql);

            // Check if there are any Courses
            if ($result->num_rows > 0) {
                // Output data for each row
                while ($row = $result->fetch_assoc()) {
                    $course_id = $row['course_id']; // Fetch the  course_id
                    echo "<tr>
                        <td>" . $row['course_id'] . "</td>
                        <td>" . $row['course_name'] . "</td>
                        <td>" . $row['course_code'] . "</td>
                        <td><a style='padding:4px' href='delete_Courses.php?course_id=$course_id'>Delete</a></td> 
                        <td><a style='padding:4px' href='update_Courses.php?course_id=$course_id'>Update</a></td> 
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No data found</td></tr>";
            }
            // Close the database connection
            $connection->close();
            ?>
        </table></center><br><br><br>
        <a href="./home.html">Go Back to Home</a><br>
    </body>
    </html>
  </section>

  <footer>
    <center> 
      <b><h2><marquee><i>UR CBE BIT &copy, 2024 &reg, Designed by: @Fidele DUHABWANAYO 222003029</i><marquee></h2></b>
    </center>
  </footer>
</body>
</html>
