<?php
// Start the session
session_start();

// Include database connection
include('database.php');

// Check if the form is submitted to add a new post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if userId is set in the session
    if(isset($_SESSION['userId'])) {
        $userId = $_SESSION['userId']; 
        $content = $conn->real_escape_string($_POST['content']);

        // Check if the user_id exists in the users table
        $checkUserQuery = "SELECT * FROM users WHERE userId = '$userId'";
        $result = $conn->query($checkUserQuery);

        if ($result->num_rows > 0) {
            // User exists, proceed with inserting the post
            $sql = "INSERT INTO posts (user_id, content) VALUES ('$userId', '$content')";

            if ($conn->query($sql) === TRUE) {
                echo "New post created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "User with ID $userId not found.";
        }
    } else {
        echo "User is not logged in. Please log in to add a post.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Post</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Add New Post</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="userpage.php" class="btn btn-primary">Return</a>
        </form>
    </div>
</body>
</html>
