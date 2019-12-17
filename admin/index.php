<?php
session_start();
$noNavbar='';
$noFooter='';
$pageTitle = 'Login';
if (isset($_SESSION['UserName'])) {
    header('Location:dashboard.php');
}
include 'init.php';

// check if uer coming from http post request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashedPass = sha1($password);

    $sql = $con->prepare("select User_ID,UserName,Password from users where UserName = ? and Password =? and Group_ID=1 ");
    $sql->execute(array($username, $hashedPass));
    $row = $sql->fetch();
    $count = $sql->rowCount();

    if ($count > 0) {
        $_SESSION['UserName'] = $username; //Register User Name
        $_SESSION['User_ID'] = $row['User_ID']; //Register User IDn
        header('location: dashboard.php');
        exit();
    } else {
        echo '  <div class="alert alert-danger" role="alert">
  You are not Admin
</div>';
    }
}
?>

<form class="login mt-5 mb-10 ml-auto mr-auto w-25" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
    <h3 class="text-center">Admin</h3>
    <input class="form-control mt-5 mb-3" type="text" name="username" placeholder="Username" autocomplete="off">
    <input class="form-control mb-3" type="password" name="password" placeholder="Password" autocomplete="new-password" />
    <input class="btn btn-primary btn-block" type="submit" value="Login">
</form>
<?php
if(!isset($noFooter))
include $tpl . 'footer.php';
?>