<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Attendance</title>
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
    section{
    padding:10px;
    }
    header{
  background-color:blue;
  padding: 20px;
}
    section{
    padding:82px;
    border-bottom: 1px solid #ddd;
}
footer{
    text-align: center;
    padding: 20px;
    background-color:blue;
}
.search-button {
    background-color: yellow;
}
  </style>
  <!-- JavaScript validation and content load for insert data-->
        <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>
</head>

<body bgcolor="pink">
<header>
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
</header>

<section>
  <h1>Attendance Form</h1>
   <form method="post" onsubmit="return confirmInsert();">
    <label for="attendance_id">Attendance Id:</label>
    <input type="number" id="attendance_id" name="attendance_id" required><br><br>

    <label for="student_id">Students Id:</label>
    <input type="number" id="student_id" name="student_id" required><br><br>

    <label for="course_id">Course Id:</label>
    <input type="number" id="course_id" name="course_id" required><br><br>

    <label for="attendance_date">Attendance date</label>
    <input type="DATE" id="attendance_date" name="attendance_date" required><br><br>

    <label for="status">STATUS:</label>
    <select name="status" id="status">
      <option>Present</option>
      <option>Absent</option>
    </select><br><br>

    <input type="submit" name="add" value="Insert"><br><br><br><br><br>
  </form>

  <?php
  // Connection details
  include('Database_connection.php');


  // Check if the form is submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Prepare and bind the parameters
      $stmt = $connection->prepare("INSERT INTO Attendance(attendance_id, student_id, course_id, attendance_date, status) VALUES (?, ?, ?, ?, ?)");
      $stmt->bind_param("sssss", $attendance_id, $student_id, $course_id, $attendance_date, $status);
      // Set parameters and execute
      $attendance_id = $_POST['attendance_id'];
      $student_id = $_POST['student_id'];
      $course_id = $_POST['course_id'];
      $attendance_date = $_POST['attendance_date'];
      $status = $_POST['status'];

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
  // SQL query to fetch data from the Attendance
  $sql = "SELECT * FROM Attendance";
  $result = $connection->query($sql);
  ?>

  <center>
    <h2>Table of Attendance</h2>
  <table border="5">
    <tr>
      <th>attendance_id</th>
      <th>student_id</th>
      <th>course_id</th>
      <th>attendance_date</th>
      <th>status</th>
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
    $sql = "SELECT * FROM Attendance";
    $result = $connection->query($sql);

    // Check if there are any Attendance
    if ($result->num_rows > 0) {
        // Output data for each row
        while ($row = $result->fetch_assoc()) {
            $attendance_id = $row['attendance_id']; // Fetch the  attendance_id
            echo "<tr>
              <td>" . $row['attendance_id'] . "</td>
              <td>" . $row['student_id'] . "</td>
              <td>" . $row['course_id'] . "</td>
              <td>" . $row['attendance_date'] . "</td>
              <td>" . $row['status'] . "</td>
              <td><a style='padding:4px' href='delete_Attendance.php?attendance_id=$attendance_id'>Delete</a></td> 
              <td><a style='padding:4px' href='update_Attendance.php?attendance_id=$attendance_id'>Update</a></td> 
            </tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No data found</td></tr>";
    }
    // Close the database connection
    $connection->close();
    ?>
  </table>
</center><br>
  <a href="./home.html">Go Back to Home</a><br>
</section>

<footer>
  <center> 
    <b><h2><marquee><i>UR CBE BIT &copy, 2024 &reg, Designed by: @Fidele DUHABWANAYO 222003029</i><marquee></h2></b>
  </center>
</footer>
</body>
</html>
