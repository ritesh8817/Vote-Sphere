<?php
session_start();
if (isset($_SESSION['admin'])) {
    header('location: admin/home.php');
}

if (isset($_SESSION['voter'])) {
    header('location: home.php');
}
?>
<?php include 'includes/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voter Login - Online Voting System</title>
    <link rel="stylesheet" href="voter_login.css"> <!-- Link to the external CSS file -->
	<link rel="stylesheet" href="dist/css/style.css">
</head>
<body class="login-page">
    <div class="login-box">
        <div class="login-logo">
            <b>Online Voting System</b>
        </div>
        <div class="login-box-body">
            <p class="login-box-msg"><b>VOTER'S SESSION</b></p>
            <form action="login.php" method="POST">
                <div class="form-group">
                    <input type="text" class="form-control" name="voter" placeholder="Voter's ID" required>
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
            <div class="admin-login-link">
                <p>Are you an admin? <a href="admin/index.php">Login here</a></p>
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
