<?php 
$server = "localhost";
$username = "root";
$password = "";
$database = "lab_webtech";

// Create Database Connection
$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Name = $_POST['name'];
    $Email = $_POST['email'];
    $Project = $_POST['project_name'];
    $Phone = $_POST['number'];
    $Message = $_POST['message'];

    // Validate 10-digit phone number (only digits)
    if (!preg_match("/^[0-9]{10}$/", $Phone)) {
        echo '<script>alert("Phone number must be exactly 10 digits.")</script>';
        echo("<script>window.location = 'http://localhost/My%20Personal%20Portfolio/#contact';</script>");
        exit;
    }

    // Check if email already exists
    $stmt = $conn->prepare("SELECT * FROM portfolio_form WHERE Email = ?");
    $stmt->bind_param("s", $Email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo '<script>alert("This email has already submitted the form.")</script>';
        echo("<script>window.location = 'http://localhost/My%20Personal%20Portfolio/#contact';</script>");
    } else {
        // Use prepared statement to insert safely
        $insert = $conn->prepare("INSERT INTO portfolio_form (Name, Email, Project, Phone, Message) VALUES (?, ?, ?, ?, ?)");
        $insert->bind_param("sssss", $Name, $Email, $Project, $Phone, $Message);

        if ($insert->execute()) {
            echo '<script>alert("Form submitted successfully!")</script>';
            echo("<script>window.location = 'http://localhost/My%20Personal%20Portfolio/';</script>");
        } else {
            echo '<script>alert("Form submission failed, try again!")</script>';
            echo("MySQL Error: " . $conn->error); // Optional: debugging
            echo("<script>window.location = 'http://localhost/My%20Personal%20Portfolio/#contact';</script>");
        }
        $insert->close();
    }
    $stmt->close();
}

mysqli_close($conn);
?>