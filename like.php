<?php
// Include database connection
include('database.php');

// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['userId'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Check if the form is submitted to add a new like
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION['userId'];
    $postId = $_POST['postId'];

    // Check if the user has already liked the post
    $checkQuery = "SELECT * FROM likes WHERE userId='$userId' AND postId='$postId'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        // If user has already liked the post, redirect with message
        header("Location: like.php?error=already_liked");
        exit();
    }

    // SQL query to insert a new like
    $sql = "INSERT INTO likes (userId, postId) VALUES ('$userId', '$postId')";

    if ($conn->query($sql) === TRUE) {
        // If like added successfully, redirect with success message
        header("Location: like.php?success=like_added");
        exit();
    } else {
        // If error occurred during insertion, redirect with error message
        header("Location: like.php?error=" . urlencode($conn->error));
        exit();
    }
}
?>
<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Like Posts</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Like Posts</h2>
        <?php
        // Display success message if like added successfully
        if (isset($_GET['success'])) {
            echo '<div class="alert alert-success" role="alert">';
            echo 'Like added successfully';
            echo '</div>';
        }

        // Display error message if post is already liked or other errors
        if (isset($_GET['error'])) {
            if ($_GET['error'] == 'already_liked') {
                echo '<div class="alert alert-warning" role="alert">';
                echo 'You have already liked this post';
                echo '</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">';
                echo 'An error occurred: ' . htmlspecialchars($_GET['error']);
                echo '</div>';
            }
        }
        ?>
        <div class="row">
            <?php
            // Query to get all posts
            $query = "SELECT * FROM posts";
            $result = $conn->query($query);

            // Check if there are any posts
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='col-md-4 mb-4'>";
                    echo "<div class='card'>";
                    echo "<div class='card-body'>";
                    echo "<p class='card-text' style='color: green; font-size: 22px;text-transform:uppercase;'>" . $row['content'] . "</p>";
                    echo "<form method='post'>";
                    echo "<input type='hidden' name='postId' value='" . $row['id'] . "'>";
                    // Like button with onclick event to change color and disable button
                    echo "<button type='submit' class='btn btn-primary' onclick='likeButtonClicked(this)'>Like</button>";
                    echo "</form>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                // If there are no posts, display a message
                echo '<div class="alert alert-warning" role="alert">';
                echo 'There are no posts available to like.';
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <!-- Bootstrap JS (optional, if needed) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript to handle like button click -->
    <script>
        function likeButtonClicked(button) {
            // Change button color to gray
            button.classList.add('btn-secondary');
            // Disable the button after clicking
            button.disabled = true;
        }
    </script>

    <!-- Return Home Button -->
    <div class="container mt-3 d-flex justify-content-end">
        <a href="userpage.php" class="btn btn-secondary">Return Home</a>
    </div>
</body>

</html>
