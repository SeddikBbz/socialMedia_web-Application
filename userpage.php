<?php
// Include database connection
include('database.php');

// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
    exit();
}

// Fetch user's information from the database
$userId = $_SESSION['userId'];
$sql = "SELECT * FROM users WHERE userId = '$userId'";
$result = $conn->query($sql);

// Check if user data is found
if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();
} else {
    echo "User data not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">User Page</h1>
        
        <!-- Display user's information in a table -->
        <div class="mt-3">
            <h3>User Information</h3>
            <table class="table">
                <tbody>
                    <tr>
                        <th>Username</th>
                        <td><?php echo $userData['username']; ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?php echo $userData['email']; ?></td>
                    </tr>
                    <tr>
                        <th>Full Name</th>
                        <td><?php echo $userData['fullName']; ?></td>
                    </tr>
                    <tr>
                        <th>Birthdate</th>
                        <td><?php echo $userData['birthdate']; ?></td>
                    </tr>
                    <tr>
                        <th>Location</th>
                        <td><?php echo $userData['location']; ?></td>
                    </tr>
                    <tr>
                        <th>Bio</th>
                        <td><?php echo $userData['bio']; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <!-- Button to add a new post -->
        <a href="post.php" class="btn btn-primary mt-3">Add Post</a>
        
        <!-- Button to add a new comment -->
        <a href="comment.php" class="btn btn-primary mt-3">Add Comment</a>
        
        <!-- Button to add a new like -->
        <a href="like.php" class="btn btn-primary mt-3">Add Like</a>
        <a href="index.php" class="btn btn-primary mt-3">Home</a>
    </div>
</body>
</html>
