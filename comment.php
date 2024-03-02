<?php
// Start the session
session_start();

// Include database connection
include('database.php');

// Initialize alert message variable
$alertMessage = '';

// Check if the session variable $_SESSION['userId'] is set
if (!isset($_SESSION['userId'])) {
    $alertMessage = '<div class="alert alert-danger" role="alert">You are not logged in. Please log in to view and add comments.</div>';
} else {
    $userId = $_SESSION['userId']; // Adjust this based on your authentication method

    // Fetch posts for the user
    $checkPostQuery = "SELECT id, content FROM posts WHERE user_id = '$userId'";
    
    // Execute the query
    $resultPost = $conn->query($checkPostQuery);

    // Check for errors
    if (!$resultPost) {
        // Handle query execution error
        $alertMessage = '<div class="alert alert-danger" role="alert">Error fetching posts: ' . $conn->error . '</div>';
    } else {
        // Check if the user has any posts
        if ($resultPost->num_rows == 0) {
            $alertMessage = '<div class="alert alert-warning" role="alert">You have no posts. Please add a post first.</div>';
        } else {
            // Display comment form
            $commentForm = '
                <div class="mb-3">
                    <form method="post">
                        <div class="mb-3">
                            <label for="post" class="form-label">Select Post</label>
                            <select class="form-select" id="post" name="post" required>
                                <option value="">Select Post</option>';

            // Populate dropdown with post content
            while ($row = $resultPost->fetch_assoc()) {
                $postId = $row['id'];
                $postContent = $row['content'];
                // You can adjust this if you want to display a portion of the content
                $postContentSnippet = substr($postContent, 0, 50); // Display first 50 characters
                $commentForm .= "<option value='$postId'>$postContentSnippet...</option>";
            }

            $commentForm .= '
                            </select>
                        </div>
                        <div id="commentsContainer" class="mb-3">
                            <!-- Comments will be loaded here dynamically -->
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Your Comment</label>
                            <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Send It</button>
                    </form>
                </div>';
        }
    }

    // Check if the form is submitted and insert the comment into the database
    if (isset($_POST['submit'])) {
        $postId = $_POST['post'];
        $content = $_POST['content'];

        // Insert the comment into the database
        $insertCommentQuery = "INSERT INTO comments (userId, postId, content) VALUES ('$userId', '$postId', '$content')";
        if ($conn->query($insertCommentQuery) === TRUE) {
            // Comment added successfully
            $alertMessage = '<div class="alert alert-success" role="alert">Comment added successfully</div>';
        } else {
            // Error inserting comment
            $alertMessage = '<div class="alert alert-danger" role="alert">Error adding comment: ' . $conn->error . '</div>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Comment</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Add Comment</h2>
        
        <?php
        // Output alert message or comment form
        if ($alertMessage) {
            echo $alertMessage;
        } elseif ($commentForm) {
            echo $commentForm;
        }
        ?>
    </div>

    <!-- Bootstrap JS (optional, if needed) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Return Home Button -->
    <div class="container mt-3 d-flex justify-content-end">
        <a href="userpage.php" class="btn btn-secondary">Return Home</a>
    </div>

    <!-- JavaScript for handling AJAX request -->
    <script>
        document.getElementById('post').addEventListener('change', function() {
            var postId = this.value; // Get the selected post ID

            // Send AJA X request to fetch comments for the selected post
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Update comments container with fetched comments
                        var commentsContainer = document.getElementById('commentsContainer');
                        commentsContainer.innerHTML = xhr.responseText;
                        
                        // Style the comments
                        var comments = commentsContainer.getElementsByClassName('comment');
                        for (var i = 0; i < comments.length; i++) {
                            comments[i].style.border = '2px solid black'; // Add border
                            comments[i].style.fontWeight = 'bold'; // Make text bold
                            comments[i].style.fontSize = '20px'; // Set font size to 20px
                        }
                    } else {
                        // Handle error
                        console.error('Error fetching comments: ' + xhr.status);
                    }
                }
            };
            xhr.open('POST', 'fetch_comments.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('postId=' + postId);
        });
    </script>
</body>
</html>
