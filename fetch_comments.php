<?php
// Include database connection
include('database.php');

// Check if the postId is provided
if(isset($_POST['postId'])) {
    $postId = $_POST['postId'];

    // Fetch comments for the selected post
    $fetchCommentsQuery = "SELECT * FROM comments WHERE postId = $postId";
    $result = $conn->query($fetchCommentsQuery);

    if($result->num_rows > 0) {
        // Comments found, display them
        while($row = $result->fetch_assoc()) {
            echo '<div class="comment">';
            echo '<p>'.$row['content'].'</p>';
            echo '</div>';
        }
    } else {
        // No comments found for this post
        echo 'No comments found for this post.';
    }
}
?>
