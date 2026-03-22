<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Listing</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px auto;
            max-width: 1200px;
            padding: 20px;
            background-color: #f5f5f5;
        }
        h1 {
            color: #333;
            text-align: center;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        th {
            background-color: #4CAF50;
            color: white;
            padding: 12px;
            text-align: left;
        }
        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .nav-links {
            margin-top: 30px;
            text-align: center;
        }
        .nav-links a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin: 0 5px;
        }
    </style>
</head>
<body>
    <h1>Student Listing</h1>
    
    <?php
    /**
     * Author: [Your Name]
     * Date: 16th March 2026
     * Unit: IS312 Web Application Development
     */
    
    // Database connection
    $conn = new mysqli("localhost", "root", "", "FRU10");
    
    // Check connection
    if ($conn->connect_error) {
        die("<p style='color: red;'>Connection failed: " . $conn->connect_error . "</p>");
    }
    
    // Query to get all students with program info
    $sql = "SELECT s.*, p.programName 
            FROM Student s
            LEFT JOIN Program p ON s.programCode = p.programCode";
    
    $result = $conn->query($sql);
    ?>
    
    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Student No</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Gender</th>
                    <th>Contact No</th>
                    <th>Program Code</th>
                    <th>Program Name</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['studentNo']; ?></td>
                        <td><?php echo $row['firstname']; ?></td>
                        <td><?php echo $row['lastname']; ?></td>
                        <td><?php echo $row['gender']; ?></td>
                        <td><?php echo $row['contactNo']; ?></td>
                        <td><?php echo $row['programCode']; ?></td>
                        <td><?php echo $row['programName']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        
        <p style="text-align: right;">
            Total students: <?php echo $result->num_rows; ?>
        </p>
        
    <?php else: ?>
        <p style="text-align: center; padding: 30px; color: #999;">
            No students found in the database.
        </p>
    <?php endif; ?>
    
    <div class="nav-links">
        <a href="new-program.html">Add Program</a>
        <a href="index.html">Back to Home</a>
    </div>
    
    <?php $conn->close(); ?>
</body>
</html>