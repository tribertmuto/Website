<?php
// Database configuration
$servername = "127.0.0.1";  // Use 127.0.0.1 instead of localhost to avoid socket issues in some setups
$username = "root";
$password = "";  // Leave blank if root has no password (default in XAMPP)
$dbname = "registration_db";

// Create connection to MySQL (default port 3306, no need to specify)
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $pin_code = $_POST['pin_code'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $qualification = $_POST['qualification'];
    $courses_applied = $_POST['courses_applied'];
    $hobbies = isset($_POST['hobbies']) ? implode(", ", $_POST['hobbies']) : "";

    // Insert data using prepared statement
    $stmt = $conn->prepare("INSERT INTO student_tb 
        (first_name, last_name, email, mobile, gender, dob, address, city, pin_code, state, country, hobbies, qualification, courses_applied) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("ssssssssssssss", $first_name, $last_name, $email, $mobile, $gender, $dob, $address, $city, $pin_code, $state, $country, $hobbies, $qualification, $courses_applied);

    if ($stmt->execute()) {
        echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Registration Success</title>
            <style>
                body {
                    background-color: red;
                    color: white;
                    font-family: sans-serif;
                    margin: 0;
                    padding: 0;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    min-height: 100vh;
                }
                .success-message {
                    background-color: darkred;
                    padding: 30px;
                    border-radius: 15px;
                    text-align: center;
                    border: 1px dotted black;
                }
                .back-link {
                    background-color: white;
                    color: red;
                    padding: 10px 20px;
                    text-decoration: none;
                    border-radius: 5px;
                    margin-top: 20px;
                    display: inline-block;
                    font-weight: bold;
                }
                .back-link:hover {
                    background-color: #f5f5f5;
                }
            </style>
        </head>
        <body>
            <div class='success-message'>
                <h2>Registration Successful!</h2>
                <p>Thank you for registering. Your information has been saved successfully.</p>
                <a href='index.html' class='back-link'>Back to Registration Form</a>
            </div>
        </body>
        </html>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request method. Please use the registration form.";
}

$conn->close();
?>
<?php