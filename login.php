<?php
    // Template for new VMS pages. Base your new page on this one

    // Make session information accessible, allowing us to associate
    // data with the logged-in user.
    session_cache_expire(30);
    session_start();
    
    ini_set("display_errors",1);
    error_reporting(E_ALL);

    // redirect to index if already logged in
    if (isset($_SESSION['_id'])) {
        if($SESSION['access_level'] > 1){
            header('Location: centralMenu.php');
        } else if ($_SESSION['access_level'] == 1) {
            header('Location:vms_index.php');
        }
        die();
    }
    $badLogin = false;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once('include/input-validation.php');
        $ignoreList = array('password');
        $args = sanitize($_POST, $ignoreList);
        $required = array('username', 'password');
        if (wereRequiredFieldsSubmitted($args, $required)) {
            require_once('domain/Person.php');
            require_once('database/dbPersons.php');
            require_once('database/dbMessages.php');
            dateChecker();
            $username = strtolower($args['username']);
            $password = $args['password'];
            $user = retrieve_person($username);
            if (!$user) {
                $badLogin = true;
            } else if (password_verify($password, $user->get_password())) {
                $changePassword = false;
                if ($user->is_password_change_required()) {
                    $changePassword = true;
                    $_SESSION['logged_in'] = false;
                } else {
                    $_SESSION['logged_in'] = true;
                }
                $types = $user->get_type();
                if (in_array('main', $types)) {
                    $_SESSION['access_level'] = 3;
                    header('Location:centralMenu.php');
                } else if (in_array('admin', $types)) {
                    $_SESSION['access_level'] = 2;
                    header('Location:centralMenu.php');
                } else {
                    $_SESSION['access_level'] = 1;
                    header('Location:vms_index.php');
                }
                $_SESSION['f_name'] = $user->get_first_name();
                $_SESSION['l_name'] = $user->get_last_name();
                $_SESSION['venue'] = $user->get_venue();
                $_SESSION['type'] = $user->get_type();
                $_SESSION['_id'] = $user->get_id();
                // hard code root privileges
                if ($user->get_id() == 'vmsroot') {
                    $_SESSION['access_level'] = 3;
                    header('Location:centralMenu.php');
                }
                if ($changePassword) {
                    $_SESSION['access_level'] = 0;
                    $_SESSION['change-password'] = true;
                    header('Location: changePassword.php');
                    die();
                } 
                die();
            } else {
                $badLogin = true;
            }
        }
    }
    //<p>Or <a href="register.php">register as a new volunteer</a>!</p>
    //Had this line under login button, took user to register page
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require_once('universal.inc') ?>
        <title>ODHS Medicine Tracker | Log In</title>
    </head>
    <body>
        <?php require_once('header.php') ?>
        <main class="login">
            <h1>ODHS MedTracker Login</h1>
            <?php if (isset($_GET['registerSuccess'])): ?>
                <div class="happy-toast">
                    Your registration was successful! Please log in below.
                    echo $_SESSION['access_level']
                </div>
            <?php else: ?>
            <p>Welcome! Please log in below.</p>
            
            <?php endif ?>
            <form method="post">
                <?php
                    if ($badLogin) {
                        echo '<span class="error">No login with that e-mail and password combination currently exists.</span>';
                    }
                ?>
                <label for="username">Username</label>
        		<input type="text" name="username" placeholder="Enter your e-mail address" required>
        		<label for="password">Password</label>
                <input type="password" name="password" placeholder="Enter your password" required>
                <input type="submit" name="login" value="Log in">
            </form>
            <p></p>
            <p>Looking for <a href="https://www.olddominionhumanesociety.org">Old Dominion Humane Society</a>?</p>
            <p><a href="#" onclick="showMessage()">Forgot username or password?</a></p>
            <div id="forgotMessage" style="display: none;">
                <p>Please contact your administrator for assistance with your username or password.</p>
            </div>
        </main>
        <script>
        function showMessage() {
            document.getElementById('forgotMessage').style.display = 'block';
        }
        </script>
    </body>
</html>