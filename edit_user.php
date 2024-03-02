<?php
// Establish database connection
include('database.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process form data
    $userId = $_POST["userId"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $fullName = $_POST["fullName"];
    $birthdate = $_POST["birthdate"];
    $location = $_POST["location"];
    $bio = $_POST["bio"];

    // Update user information in the database
    $sql = "UPDATE users SET username=?, email=?, fullName=?, birthdate=?, location=?, bio=? WHERE userId=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $username, $email, $fullName, $birthdate, $location, $bio, $userId);

    if ($stmt->execute()) {
        echo "User information updated successfully";
        // Redirect to a page to view updated information or any other appropriate action
        header("Location: admin.php");
        exit;
    } else {
        echo "Error updating user information: " . $conn->error;
    }
}

// Fetch user data based on userId from the query parameter
if(isset($_GET['id'])) {
    $userId = $_GET['id'];
    $sql = "SELECT * FROM users WHERE userId=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows > 0) {
        // Get user data
        $user = $result->fetch_assoc();
    } else {
        echo "User not found";
        exit; // Exit script if user not found
    }
} else {
    echo "User ID not provided";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Information</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Your custom CSS if needed -->
    <style>
        /* Your custom styles here */
    </style>
</head>

<body>
    <div class="container">
        <!-- Edit user form -->
        <h1 class="mt-5">Edit User Information</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="userId" value="<?php echo $user['userId']; ?>">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>">
            </div>
            <div class="form-group">
                <label for="fullName">Full Name:</label>
                <input type="text" class="form-control" id="fullName" name="fullName" value="<?php echo htmlspecialchars($user['fullName']); ?>">
            </div>
            <div class="form-group">
                <label for="birthdate">Birthdate:</label>
                <input type="date" class="form-control" id="birthdate" name="birthdate" value="<?php echo $user['birthdate']; ?>">
            </div>
            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" class="form-control" id="location" name="location" value="<?php echo htmlspecialchars($user['location']); ?>">
            </div>
            <div class="form-group">
                <label for="bio">Bio:</label>
                <textarea class="form-control" id="bio" name="bio"><?php echo htmlspecialchars($user['bio']); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>

</html>

<?php
// Close database connection
$conn->close();
?>
