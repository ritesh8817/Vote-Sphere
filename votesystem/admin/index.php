<?php
session_start();
if (isset($_SESSION['admin'])) {
    header('location:home.php');
}
?>
<?php include 'includes/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Online Voting System</title>
    <link rel="stylesheet" href="../dist/css/style.css"> <!-- Link to the external CSS file -->
</head>
<body class="login-page">
    <div class="login-box">
        <div class="login-logo">
            <b>VOTES PHERE</b>
        </div>
        <div class="login-box-body">
            <p class="login-box-msg"><b>ADMIN SESSION</b></p>
            <form action="login.php" method="POST">
                <div class="form-group">
                    <input type="text" class="form-control" name="username" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" class="btn" name="login">
                            <i class="fa fa-sign-in"></i> Sign In
                        </button>
                    </div>
                </div>
            </form>
            <!-- Link to Voter's Login Page -->
            <div class="voter-login-link">
                <p>Are you a voter? <a href="http://localhost/votesystem/">Login here</a></p>
            </div>
        </div>
        <?php
        if (isset($_SESSION['error'])) {
            echo "
                <div class='alert'>
                    <p>" . $_SESSION['error'] . "</p>
                </div>
            ";
            unset($_SESSION['error']);
        }
        ?>
    </div>
    
    <?php include 'includes/scripts.php'; ?>
</body>
</html>
