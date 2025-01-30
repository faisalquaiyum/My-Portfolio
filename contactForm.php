<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "lab_webtech";

//Creating Databse Connection
$conn = mysqli_connect($server, $username, $password, $database);
 if(!$conn){
     die("Connection failed: ".mysqli_connect_error());
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $Name = $_POST['name'];
    $Email = $_POST['email'];
    $Project = $_POST['project_name'];
    $Phone = $_POST['number'];
    $Message = $_POST['message'];
   
   //Insert Query For Contact Form
   $sql = "INSERT INTO `portfolio_form` (Name, Email, Project, Phone, Message) VALUES ('$Name', '$Email', '$Project', '$Phone', '$Message')";
   
   if(mysqli_query($conn,$sql)){
        // echo "Data inserted successfully";
       // header("location: http://localhost/web%20project/Responsive%20Personal%20Portfolio/#contact");
        echo '<script> alert("Form submitted successfully!") </script>';
        echo("<script>window.location = 'http://localhost/web%20project/Responsive%20Personal%20Portfolio/';</script>");
        
   }
   else{
        echo '<script> alert("Form submission failed, try again!") </script>';
        echo("<script>window.location = 'http://localhost/web%20project/Responsive%20Personal%20Portfolio/#contact';</script>");
   }
   }
   
   mysqli_close($conn);
?>