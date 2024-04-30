<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Students table page</title>
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
  <h1>Students</h1>
  <form method="post" onsubmit="return confirmInsert();">
    <label for="Student_ID">Student ID</label>
    <input type="number" id="Student_ID" name="Student_ID"><br><br>

    <label for="First_Name">First Name</label>
    <input type="text" id="First_Name" name="fname" required><br><br>

    <label for="Last_Name">Last Name</label>
    <input type="text" id="Last_Name" name="lname" required><br><br>

    <label for="Date_Of_Birth">Date Of Birth</label>
    <input type="date" id="Date_Of_Birth" name="dob" required><br><br>

    <label for="Email">Email</label>
    <input type="email" id="Email" name="email" required><br><br>

    <input type="submit" name="add" value="Insert"><br><br><br><br>
  </form>

<?php
include('Database_connection.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connection details
    include('Database_connection.php');

    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO Students(Student_ID, First_Name, Last_Name, Date_Of_Birth, Email) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $Student_ID, $First_Name, $Last_Name, $Date_Of_Birth, $Email);

    // Set parameters and execute
    $Student_ID = $_POST['Student_ID'];
    $First_Name = $_POST['fname'];
    $Last_Name = $_POST['lname'];
    $Date_Of_Birth = $_POST['dob'];
    $Email = $_POST['email'];
  
    if ($stmt->execute()) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $connection->close();
}
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
// SQL query to fetch data from the Students
$sql = "SELECT * FROM Students";
$result = $connection->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of Students</title>
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
    </style>
</head>
<body><center>
    <center><h1><u>Table of Students</u></h1></center>
    <table border="5">
        <tr>
            <th>Student_ID</th>
            <th>First_Name</th>
            <th>Last_Name</th>
            <th>Date_Of_Birth</th>
            <th>Email</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        // Check if connection was successful
        if ($result === false) {
            echo "Error: " . $connection->error;
        } else {
            // Check if there are any Students
            if ($result->num_rows > 0) {
                // Output data for each row
                while ($row = $result->fetch_assoc()) {
                    $Student_ID = $row['Student_ID']; // Fetch the student_id
                    echo "<tr>
                        <td>" . $row['Student_ID'] . "</td>
                        <td>" . $row['First_Name'] . "</td>
                        <td>" . $row['Last_Name'] . "</td>
                        <td>" . $row['Date_Of_Birth'] . "</td>
                        <td>" . $row['Email'] . "</td>
                        <td><a style='padding:4px' href='delete_Students.php?Student_ID=$Student_ID'>Delete</a></td> 
                        <td><a style='padding:4px' href='update_Students.php?Student_ID=$Student_ID'>Update</a></td> 
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No data found</td></tr>";
            }
        }
        // Close the database connection
        $connection->close();
        ?>
    </table><br><br><br>
    <a href="./home.html">Go Back to Home</a><br></center>
</body>
</section>

<footer>
  <center> 
    <b><h2><marquee><i>UR CBE BIT &copy, 2024 &reg, Designed by: @Fidele DUHABWANAYO 222003029</i></marquee></h2></b>
  </center>
</footer>
</body>
</html>
