<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>enrollments page</title>
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
  <header>
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
    <h1>Enrollments Form</h1>
    <form method="post" action="Enrollments.php">
      <label for="enrollment_id">Enrollments Id:</label>
      <input type="number" id="enrollment_id" name="enrollment_id" required><br><br>

      <label for="student_id">Students Id</label>
      <input type="number" id="student_id" name="student_id" required><br><br>

      <label for="Contact_Information">Contact Information:</label>
      <input type="text" id="Contact_Information" name="Contact_Information" required><br><br>

      <label for="Lecturer_name">Lecturer Name</label>
      <input type="text" id="Lecturer_name" name="Lecturer_name" required><br><br>

      <input type="submit" name="add" value="Insert"><br><br><br><br><br>
    </form><br><br><br><br><br><br>

    <?php
    // Connection details
    include('Database_connection.php');

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare and bind the parameters
        $stmt = $connection->prepare("INSERT INTO enrollment(enrollment_id, student_id, Contact_Information, Lecturer_name) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $enrollment_id, $student_id, $Contact_Information, $Lecturer_name);
        // Set parameters and execute
        $enrollment_id = $_POST['enrollment_id'];
        $student_id = $_POST['student_id']; // Removed the extra comma here
        $Contact_Information = $_POST['Contact_Information'];
        $Lecturer_name = $_POST['Lecturer_name'];

        if ($stmt->execute() == TRUE) {
            echo "New record has been added successfully";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
    $connection->close();
    ?>

    <h2>Table of enrollment</h2>
    <table border="5">
      <tr>
        <th>enrollment_id</th>
        <th>student_id</th>
        <th>Contact_Information</th>
        <th>Lecturer_name</th>
        <th>Delete</th>
        <th>Update</th>
      </tr>
      <?php
      // Establish a new connection
      $connection = new mysqli($host, $user, $pass, $database);

      // Check if connection was successful
      if ($connection->connect_error) {
          die("Connection failed: " . $connection->connect_error);
      }

      // Prepare SQL query to retrieve all enrollment
      $sql = "SELECT * FROM enrollment";
      $result = $connection->query($sql);

      // Check if there are any enrollment
      if ($result->num_rows > 0) {
          // Output data for each row
          while ($row = $result->fetch_assoc()) {
              $enrollment_id = $row['enrollment_id']; // Fetch the enrollment_id
              echo "<tr>
                      <td>" . $row['enrollment_id'] . "</td>
                      <td>" . $row['student_id'] . "</td>
                      <td>" . $row['Contact_Information'] . "</td>
                      <td>" . $row['Lecturer_name'] . "</td>
                      <td><a style='padding:4px' href='delete_Enrollments.php?enrollment_id=$enrollment_id'>Delete</a></td> 
                      <td><a style='padding:4px' href='update_Enrollments.php?enrollment_id=$enrollment_id'>Update</a></td> 
                    </tr>";
          }
      } else {
          echo "<tr><td colspan='6'>No data found</td></tr>";
      }
      // Close the database connection
      $connection->close();
      ?>
    </table>
    <br><br><br>
    <a href="./home.html">Go Back to Home</a><br>
  </section>

  <footer>
    <center>
      <b><h2><marquee><i>UR CBE BIT &copy, 2024 &reg, Designed by: @Fidele DUHABWANAYO 222003029</i></marquee></h2></b>
    </center>
  </footer>
</body>
</html>
