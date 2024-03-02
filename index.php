<?php
// Include database connection
include('database.php');

// Start session
session_start();

// Check if the form is submitted for authentication
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if admin login
    $sql = "SELECT * FROM admin WHERE email=? AND password=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Admin authentication successful
        $admin = $result->fetch_assoc();
        $_SESSION['adminId'] = $admin['adminId'];
        $_SESSION['adminEmail'] = $admin['email'];
        // Redirect to admin page
        header("Location: admin.php");
        exit();
    } else {
        // User login
        $sql = "SELECT * FROM users WHERE email=? AND password=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // User authentication successful
            $user = $result->fetch_assoc();
            $_SESSION['userId'] = $user['userId'];
            $_SESSION['userEmail'] = $user['email'];
            // Redirect to user page
            header("Location: userpage.php");
            exit();
        } else {
            echo "Authentication failed. Please check your credentials.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .admin-fields {
            display: none;
        }
    </style>
</head>

<body>
    <div class="container" style="margin-top:12px">
        <h1 style="display: flex;margin-top: 60px;color:green; justify-content: center;">Home page</h1>



        <div class="row justify-content-center mt-3" >
            <div class="col-md-6">
                <button class="btn btn-primary btn-block" id="adminBtn">Admin Login</button>
            </div>
        </div>
        <div class="row justify-content-center mt-3">
            <div class="col-md-6">
                <button class="btn btn-primary btn-block" id="userBtn">User Login</button>
            </div>
        </div>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="loginForm">
            <div id="emailPasswordFields" style="display: none;">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="btn-group" role="group">
                    <button type="submit" class="btn btn-primary" name="userLogin" style="display: none;background-color:black;color:white;">Login</button>
                    <button type="button" id="backBtn" class="btn btn-primary" style="display: none;margin-left:10px;background-color:green;">Back</button>
                </div>
            </div>
            <div class="form-group admin-fields" style="display: none;">
                <!-- Admin specific fields here if needed -->
            </div>
        </form>

        <script>
            document.getElementById('adminBtn').addEventListener('click', function() {
                document.getElementById('userBtn').style.display = 'none';
                document.getElementById('adminBtn').style.display = 'none';
                document.getElementById('backBtn').style.display = 'inline-block';
                document.getElementById('emailPasswordFields').style.display = 'block';
                document.getElementById('loginForm').setAttribute('action', '<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?admin=1');
                document.getElementsByClassName('admin-fields')[0].style.display = 'block';
                document.querySelector('button[name="userLogin"]').style.display = 'block';
            });

            document.getElementById('userBtn').addEventListener('click', function() {
                document.getElementById('userBtn').style.display = 'none';
                document.getElementById('adminBtn').style.display = 'none';
                document.getElementById('backBtn').style.display = 'inline-block';
                document.getElementById('emailPasswordFields').style.display = 'block';
                document.getElementById('loginForm').setAttribute('action', '<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>');
                document.querySelector('button[name="userLogin"]').style.display = 'block';
            });

            document.getElementById('backBtn').addEventListener('click', function() {
                document.getElementById('userBtn').style.display = 'inline-block';
                document.getElementById('adminBtn').style.display = 'inline-block';
                document.getElementById('backBtn').style.display = 'none';
                document.getElementById('emailPasswordFields').style.display = 'none';
                document.querySelector('button[name="userLogin"]').style.display = 'none';
            });
        </script>
</body>

</html>