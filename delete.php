<?php
session_start();

// Include database connection
include('database.php');

// Check if admin is logged in, if not, redirect to index.php
if (!isset($_SESSION['adminId'])) {
    header("Location: index.php");
    exit();
}

// Check if the user ID is provided in the POST data
if(isset($_POST['userId']) && !empty($_POST['userId'])) {
    $userId = $_POST['userId'];

    // Delete associated records from the comments table
    $deleteCommentsQuery = "DELETE FROM comments WHERE userId = $userId";

    if ($conn->query($deleteCommentsQuery) === TRUE) {
        // Delete associated records from the likes table
        $deleteLikesQuery = "DELETE FROM likes WHERE userId = $userId";
        $conn->query($deleteLikesQuery);

        // Delete associated records from the posts table
        $deletePostsQuery = "DELETE FROM posts WHERE user_id = $userId";
        $conn->query($deletePostsQuery);

        // Finally, delete the user from the users table
        $deleteUserQuery = "DELETE FROM users WHERE userId = $userId";

        if ($conn->query($deleteUserQuery) === TRUE) {
            // Redirect to admin.php after successful deletion
            header("Location: admin.php");
            exit();
        } else {
            echo "Error deleting user: " . $conn->error;
        }
    } else {
        echo "Error deleting associated comments: " . $conn->error;
    }
} else {
    // Fetch all users
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);

    // Check if there are users
    if ($result->num_rows > 0) {
        // Output table with user information
        echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Delete User</title>
            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        </head>
        <body>
            <div class="container">
                <h1 class="mt-5">Delete User</h1>
                <p>Select a user to delete:</p>
                <table class="table">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Full Name</th>
                            <th>Birthdate</th>
                            <th>Location</th>
                            <th>Bio</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
        while ($row = $result->fetch_assoc()) {
            echo '
                        <tr>
                            <td>' . $row['userId'] . '</td>
                            <td>' . $row['username'] . '</td>
                            <td>' . $row['email'] . '</td>
                            <td>' . $row['fullName'] . '</td>
                            <td>' . $row['birthdate'] . '</td>
                            <td>' . $row['location'] . '</td>
                            <td>' . $row['bio'] . '</td>
                            <td>
                                <form method="post" action="delete.php">
                                    <input type="hidden" name="userId" value="' . $row['userId'] . '">
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>';
        }
        echo '
                    </tbody>
                </table>
                <a href="admin.php" class="btn btn-primary mt-3">Back to Admin Page</a>
            </div>
        </body>
        </html>';
    } else {
        // No users found
        echo "No users found.";
    }
}
?>
