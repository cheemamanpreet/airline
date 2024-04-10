<?php
include 'connect.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process your form data here
    // For example, insert data into the database
    
    // Redirect to the same page to prevent form resubmission
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Users</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <button class="btn btn-primary my-5"><a href="user.php" class="text-light">sign in </a></button>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">name</th>
                    <th scope="col">email</th>
                    <th scope="col">mobile</th>
                    <th scope="col">password</th>
                    <th scope="col">operations</th>
                </tr>
            </thead>
            <tbody>

            <?php
            $sql = "SELECT * FROM buy";
            $result = mysqli_query($con, $sql);

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    $name = $row['name'];
                    $password = $row['password'];
                    $email = $row['email'];
                    $mobile = $row['mobile'];

                    echo '<tr>
                    <th scope="row">'.$id.'</th>
                    <td> '.$name.'</td>
                    <td> '.$email.'</td>
                    <td> '.$mobile.'</td>
                    <td> '.$password.'</td>
                    <td> 
                    <button class="btn btn-primary"><a href="update.php?updateid='.$id.'"
                    class="text-light">update</a></button>
                    <button class="btn btn-danger"><a href="delete.php?deleteid='.$id.'"
                    class="text-light">delete</a></button></td>
   
                   </tr>';
                }
            }
            ?>

            

            </tbody>
        </table>
    </div>
</body>
</html>