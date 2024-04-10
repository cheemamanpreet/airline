<?php
include 'connect.php';
$id = $_GET['updateid'];
$sql = "SELECT * FROM buy WHERE id=$id"; // Corrected SQL query

$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

$name = $row['name'];
$email = $row['email'];
$mobile = $row['mobile'];
$password = $row['password'];

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];

    $sql = "UPDATE buy SET name=?, email=?, mobile=?, password=? WHERE id=?"; // Corrected SQL query

    $stmt = $con->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssssi", $name, $email, $mobile, $password, $id);
        $result = $stmt->execute();

        if($result){
            // echo "Update successfully";
            header('location:display.php');
        } else {
            die("Error: " . $stmt->error);
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
    <link rel="stylesheet" href="styles.css">
    <title>crud operation</title>
</head>
<body>
    <div class="container my-5">
        <form method="post">
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" placeholder="Enter your name" name="name" autocomplete="off" value="<?php echo $name; ?>">
                <small id="emailHelp" class="form-text text-muted">We'll never share your information with anyone else.</small>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" placeholder="Enter your email" name="email" value="<?php echo $email; ?>">
            </div>
            <div class="form-group">
                <label>Mobile</label>
                <input type="text" class="form-control" placeholder="Enter your mobile" name="mobile" value="<?php echo $mobile; ?>">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" placeholder="Enter your password" name="password" value="<?php echo $password; ?>">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Update</button>
        </form>
    </div>
</body>
</html>