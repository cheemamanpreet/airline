<?php
include 'connect.php';

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];

    // You should not use single quotes around table and column names in SQL queries
    $sql = "INSERT INTO buy (name, email, mobile, password) VALUES (?, ?, ?, ?)";
    
    // Prepare the SQL statement to avoid SQL injection
    $stmt = $con->prepare($sql);

    if ($stmt) {
        // Bind parameters to the prepared statement as strings
        $stmt->bind_param("ssss", $name, $email, $mobile, $password);
        
        // Execute the prepared statement
        $result = $stmt->execute();

        if($result){
            echo "Data inserted successfully";
        } else {
            die("Error: " . $stmt->error); // Display error if execution fails
        }
        
        
        $stmt->close();
    } else {
        die("Error: " . $con->error); 
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <title>crud operation</title>
</head>
<body>
    <div class="container my-5">
        <form method="post">
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" placeholder="Enter your name" name="name" autocomplete="off">
                <small id="emailHelp" class="form-text text-muted">We'll never share your information with anyone else.</small>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" placeholder="Enter your email" name="email">
            </div>
            <div class="form-group">
                <label>Mobile</label>
                <input type="text" class="form-control" placeholder="Enter your mobile" name="mobile">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" placeholder="Enter your password" name="password">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
</body>
</html>