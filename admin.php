<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Your custom CSS if needed -->
    <style>
        /* Your custom styles here */
    </style>
</head>

<body>
    <div class="container">
        <!-- Admin content -->
        <h1 class="mt-5">Welcome Admin!</h1>
        <p>What would you like to do?</p>
        <ul class="list-group">
            <li class="list-group-item"><a href="add.php">Add User</a></li>
            <li class="list-group-item"><a href="delete.php">Delete User</a></li>
            <li class="list-group-item"><a href="info.php">Edit User Information</a></li> <!-- Link to update.php -->
        </ul>
        <a href="index.php" class="btn btn-primary mt-3">Logout</a>
    </div>
</body>

</html>
