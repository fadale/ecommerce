<?php
session_start();
if (isset($_SESSION['username'])) {
    header('Location:index.php');
}
$pageTitle = 'Login';
include 'init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashedPass = sha1($password);
    $sql = $con->prepare("select UserName,Password from users where UserName = ? and Password =?");
    $sql->execute(array($username, $hashedPass));
    $count = $sql->rowCount();


    if ($count > 0) {
        $_SESSION['username'] = $username; //Register User Name

        header('location:index.php');
        exit();
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signup'])) {
    $formError = array();
    $msgScsses;
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $password1 = sha1($_POST['password1']);
    $password2 = sha1($_POST['repass']);
    $email    = $_POST['email'];


    if (isset($username)) { //Check Username
        $filterUser = filter_var($username, FILTER_SANITIZE_STRING);
        if (strlen($filterUser) < 4) {
            $formError[] = 'The User anme must be lager than 4 ';
        }
    } //End Check Username
    if (isset($fullname)) { //Check full name
        $filterfullname = filter_var($fullname, FILTER_SANITIZE_STRING);
        if (strlen($filterfullname) < 8) {
            $formError[] = 'The User anme must be lager than 8 ';
        }
    } //End Check full name
    // Check Password
    if (isset($password1) && isset($password2)) {
        if (empty($password1)) {
            $formError[] = 'The Password is Empty';
        }
        if ($password1 !== $password2) {
            $formError[] = 'Sorry the password not Match';
        }
    } //End Check Password
    // Check Email
    if (isset($email)) {
        $filterEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
        if ($filterEmail != true) {
            $formError[] = 'This Email not valid!';
        }
    } // End Check Email

    if (empty($formError)) {

        $item = Check_item('UserName', 'users', $username);
        if ($item == 1) {
            $formError[] = 'This User Exists';
        } else {

            $sql = $con->prepare("
            insert into users(
                UserName,Password,Email,FullName,RegStatus,Date
                ) values(
                    :zName,:zPassword,:zEmail,:zFullName,0,now()
                    )");

            $sql->execute(array(
                'zName'              => $username,
                'zPassword'       => $password1,
                'zEmail'          => $email,
                'zFullName'         => $fullname
            ));
            $msgScsses = 'Success Insert New User';
        }
    }
}
?>
<div class="logreg-forms">
    <div class="container">
        <h1 class="text-center">
            <span class="selected" data-class="form-signin">Sign in</span> |
            <span data-class="form-signup">Sign Up</span>
        </h1>
        <form class="form-signin" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <input type="text" name="username" class="form-control mb-2" placeholder="User Name" required="" autofocus="">
            <input type="password" name="password" class="form-control mb-2" placeholder="Password" required="">

            <input class="btn btn-primary btn-block" name="login" type="submit">

            </button>
        </form>

        <form class="form-signup" action="" method="post">
            <input pattern=".{4,}" title="Username Must be 4 Chars" type="text" name="username" id="user-name" class="form-control mb-2" placeholder="User name" required="" autofocus="">
            <input pattern=".{8,}" title="Username Must be 8 Chars" type="text" name="fullname" id="user-name" class="form-control mb-2" placeholder="Full name" required="" autofocus="">
            <input type="email" name="email" id="user-email" class="form-control  mb-2" placeholder="Email address" required autofocus="">
            <input type="password" name="password1" id="user-pass" class="form-control  mb-2" placeholder="Password" required autofocus="">
            <input type="password" name="repass" id="user-repeatpass" class="form-control mb-2" placeholder="Repeat Password" required autofocus="">
            <input class="btn btn-success btn-block" name="signup" type="submit">
        </form>
    </div>

    <div class="the-error text-center">
        <?php
        if (!empty($formError)) {
            foreach ($formError as $error) {
                echo '<div class="msg error">' . $error . '</div>';
            }
        }
        if (isset($msgScsses)) {
            echo '<div class="msg success">' . $msgScsses . '</div>';
        }
        ?>
    </div>
</div>



<?php $NoFooter = '';
include 'includes/templeats/footer.php'; ?>