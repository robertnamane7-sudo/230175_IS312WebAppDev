<?php
/**
 * Author: Robert Namane
 * Date: 16th March 2026
 * Unit: IS312 Web Application Development
 */

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get form data
    $programCode = trim($_POST['programCode']);
    $programName = trim($_POST['programName']);
    $duration = trim($_POST['duration']);
    
    // Validate (in case JavaScript fails)
    $errors = [];
    if (empty($programCode)) $errors[] = "Program Code is required";
    if (empty($programName)) $errors[] = "Program Name is required";
    if (empty($duration)) $errors[] = "Duration is required";
    
    // If no errors, insert into database
    if (empty($errors)) {
        
        // Database connection
        $conn = new mysqli("localhost", "root", "", "FRU10");
        
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        // Insert data
        $sql = "INSERT INTO Program (programCode, programName, duration) 
                VALUES ('$programCode', '$programName', '$duration')";
        
        if ($conn->query($sql) === TRUE) {
            echo "<div style='background-color: #d4edda; color: #155724; padding: 20px; margin: 20px; border-radius: 5px;'>";
            echo "<h2>✅ Success!</h2>";
            echo "<p>Program added successfully.</p>";
            echo "<a href='new-program.html'>Add Another</a> | ";
            echo "<a href='student-listing.php'>View Students</a> | ";
            echo "<a href='index.html'>Home</a>";
            echo "</div>";
        } else {
            echo "<div style='background-color: #f8d7da; color: #721c24; padding: 20px; margin: 20px; border-radius: 5px;'>";
            echo "<h2>❌ Error</h2>";
            echo "<p>" . $conn->error . "</p>";
            echo "<a href='new-program.html'>Go Back</a>";
            echo "</div>";
        }
        
        $conn->close();
        
    } else {
        // Show validation errors
        echo "<div style='background-color: #f8d7da; color: #721c24; padding: 20px; margin: 20px; border-radius: 5px;'>";
        echo "<h2>❌ Validation Errors</h2>";
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
        echo "<a href='new-program.html'>Go Back</a>";
        echo "</div>";
    }
    
} else {
    // Direct access without POST
    echo "<div style='background-color: #f8d7da; color: #721c24; padding: 20px; margin: 20px; border-radius: 5px;'>";
    echo "<h2>❌ Access Denied</h2>";
    echo "<p>This script must be accessed via the form.</p>";
    echo "<a href='new-program.html'>Go to Form</a>";
    echo "</div>";
}
?>