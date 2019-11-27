<?php
session_start();
if (isset($_SESSION['UserName'])) { // if fine nay User to go in Member page
    $pageTitle = 'Member';
    include 'init.php';

    $do = isset($_GET['do']) ? $_GET['do'] : 'manage';


    if ($do == 'manage') {

        $reg = '';
        if (isset($_GET['page']) && $_GET['page'] == 'panding') {
            $reg = 'AND RegStatus =0';
        }

        $sql = $con->prepare("select * from users where  Group_ID != 1 $reg");

        $sql->execute();
        $rows = $sql->fetchAll();
        ?>

        <h1 class="text-center">Manage Member</h1>

        <div class="container">
            <a href="?do=Add" class="btn btn-primary mt-5 mb-3 float-right"><i class="fas fa-plus"></i> Add Member</a>
            <div class="table-responsive">
                <table class="table text-center">
                    <thead class="thead-dark">
                        <tr>

                            <th scope="col">#ID</th>
                            <th scope="col">User Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">Registered Date</th>
                            <th scope="col">Control</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                foreach ($rows as $row) {
                                    echo '  <tr>
                            
                                    <td>' . $row['User_ID'] . '</td>
                                    <td>' . $row['UserName'] . '</td>
                                    <td>' . $row['Email'] . '</td>
                                    <td>' . $row['FullName'] . '</td>
                                    <td>' . $row['Date'] . '</td>
                                    <td>
                                    <a href="?do=Edit&u_id=' . $row['User_ID'] . ' " class="btn btn-success"><i class="fas fa-edit"></i> Edit</a>
                                    <a href="?do=Delete&u_id=' . $row['User_ID'] . '" class="btn btn-danger confirm"><i class="fas fa-trash-alt"></i> Delete</a>
                                    ';

                                    if ($row['RegStatus'] == 0) {
                                        echo ' <a href="?do=Activate&u_id=' . $row['User_ID'] . '" class="btn btn-info confirm"><i class=""></i>Activate</a>';
                                    }
                                    echo '  </td>
                                </tr> ';
                                }
                                ?>

                    </tbody>
                </table>
            </div>
        </div>

    <?php
        } else if ($do == 'Add') { //Add Member Page
            ?>
        <h2 class="text-center mt-5 mb-5 font-weight-bold">Add Member</h2>
        <div class="container">
            <form action="?do=Insert" method="post">
                <div class="form-group row justify-content-center">
                    <label for="inputUserName" class="col-sm-2 col-form-label">User Name</label>
                    <div class="input-group col-sm-4">
                        <input type="text" name="username" class="form-control border-right-0" id="inputUserName" placeholder="User Name" autocomplete="off" required="required">
                        <div class="input-group-prepend">
                            <div class="input-group-text text-danger font-weight-bold bg-white star border-left-0 rounded-right">*</div>
                        </div>
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                    <div class="input-group col-sm-4">
                        <input type="password" name="newpassword" class="form-control border-right-0" id="inputPassword" placeholder="Password" autocomplete="new-password">
                        <div class="input-group-prepend">
                            <div class="input-group-text text-danger font-weight-bold bg-white star border-left-0 rounded-right">*</div>
                        </div>
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="input-group col-sm-4">
                        <input type="email" name="email" class="form-control border-right-0" id="inputEmail" placeholder="Email" autocomplete="off" required="required">
                        <div class="input-group-prepend">
                            <div class="input-group-text text-danger font-weight-bold bg-white star border-left-0 rounded-right">*</div>
                        </div>
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <label for="inputFullName" class="col-sm-2 col-form-label">Full User Name</label>
                    <div class="input-group col-sm-4">
                        <input type="text" name="fullname" class="form-control border-right-0" id="inputFullName" placeholder="Full Name" autocomplete="off" required="required">
                        <div class="input-group-prepend">
                            <div class="input-group-text text-danger font-weight-bold bg-white star border-left-0 rounded-right">*</div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="text-center col-sm-11">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
        <?php } else if ($do == 'Insert') { // Insert Member Page

                echo '<h1 class="text-center">Update Menmber</h1>';
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {


                    $username = $_POST['username'];
                    $pass = sha1($_POST['newpassword']);
                    $email = $_POST['email'];
                    $fullname = $_POST['fullname'];
                    $error_Message = array();
                    if (empty($username)) {
                        $error_Message[] = '<div class="alert alert-danger col-md-6">You Shoud Enter The User Name</div>';
                    }
                    if (strlen($username) < 4) {
                        $error_Message[] = '<div class="alert alert-danger col-md-6">You Shoud Enter The User Name more than 4 characters</div>';
                    }
                    if (strlen($username) > 20) {
                        $error_Message[] = '<div class="alert alert-danger col-md-6">You Shoud Enter The User Name less than 20 characters</div>';
                    }
                    if (empty($pass)) {
                        $error_Message[] = '<div class="alert alert-danger col-md-6">You Shoud Enter The Password</div>';
                    }
                    if (empty($email)) {
                        $error_Message[] = '<div class="alert alert-danger col-md-6">You Shoud Enter The Email</div>';
                    }
                    if (empty($fullname)) {
                        $error_Message[] = '<div class="alert alert-danger col-md-6">You Shoud Enter The Full User Name</div>';
                    }
                }
                if (empty($error_Message)) { // Insert Data in DataBase

                    // Check if the username is exist or not
                    $checkuser = Check_item("UserName", "users", $username);
                    if ($checkuser == 1) {

                        $message = "The UserName is Exist";
                        redirictHome($message, "members.php");
                    } else {
                        $sql = $con->prepare("insert into users(UserName,Password,Email,FullName,Date) values(:zuser,:zpass,:zemail,:zfull,now())");

                        $sql->execute(array(
                            'zuser'     => $username,
                            'zpass'     => $pass,
                            'zemail'    => $email,
                            'zfull'     => $fullname
                        ));
                        echo '<div class="text-center mt-5"> <i class="fas fa-h1 h1 text-success">' . $sql->rowCount() . ' </i><i class="h3">Update is successful!</li> <i class="fas fa-thumbs-up text-primary h1" aria-hidden="true"></<i>';
                    }
                } else { // Pint All Error Message

                    echo '<div class="container">';
                    foreach ($error_Message as $error) {
                        echo $error;
                    }
                    echo '</div>';
                }
            } else if ($do == 'Edit') { // Page Editing Profile

                $user_id = (isset($_GET['u_id']) && is_numeric($_GET['u_id'])) ? intval($_GET['u_id']) : '0';
                $sql = $con->prepare("select * from users where User_ID = ?");
                $sql->execute(array($user_id));
                $row = $sql->fetch();
                $count = $sql->rowCount();

                if ($count > 0) { //check if fined any users
                    ?>
            <!--  Form Editing Member-->
            <h2 class="text-center mt-5 mb-5 font-weight-bold">Edit Member</h2>
            <div class="container">
                <form action="?do=Update" method="post">
                    <input type="hidden" name="userid" value="<?= $row['User_ID'] ?>">
                    <div class="form-group row justify-content-center">
                        <label for="inputUserName" class="col-sm-2 col-form-label">User Name</label>
                        <div class="input-group col-sm-4">
                            <input type="text" name="username" class="form-control border-right-0" value="<?= $row['UserName'] ?>" id="inputUserName" placeholder="User Name" autocomplete="off" required="required">
                            <div class="input-group-prepend">
                                <div class="input-group-text text-danger font-weight-bold bg-white star border-left-0 rounded-right">*</div>
                            </div>

                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-4">
                            <input type="hidden" name="oldpassword" class="form-control" value="<?= $row['Password'] ?>" id="inputoldPassword" placeholder="Password" autocomplete="new-password">
                            <input type="password" name="newpassword" class="form-control" value="" id="inputnewPassword" placeholder="Password" autocomplete="new-password">
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-4">
                            <input type="email" name="email" class="form-control" value="<?= $row['Email'] ?>" id="inputEmail" placeholder="Email" autocomplete="off" required="required">
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label for="inputFullName" class="col-sm-2 col-form-label">Full User Name</label>
                        <div class="col-sm-4">
                            <input type="text" name="fullname" class="form-control" value="<?= $row['FullName'] ?>" id="inputFullName" placeholder="Full Name" autocomplete="off" required="required">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="text-center col-sm-11">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
<?php

        }
    } elseif ($do == 'Update') { // Page POST Update if can to update data or not

        echo '<h1 class="text-center">Update Menmber</h1>';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $userid = $_POST['userid'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $fullname = $_POST['fullname'];
            $error_Message = array();
            if (empty($username)) {
                $error_Message[] = '<div class="alert alert-danger">You Shoud Enter The User Name</div>';
            }
            if (strlen($username) < 4) {
                $error_Message[] = '<div class="alert alert-danger">You Shoud Enter The User Name more than 4 characters</div>';
            }
            if (strlen($username) > 20) {
                $error_Message[] = '<div class="alert alert-danger">You Shoud Enter The User Name less than 20 characters</div>';
            }
            if (empty($email)) {
                $error_Message[] = '<div class="alert alert-danger">You Shoud Enter The Email</div>';
            }
            if (empty($fullname)) {
                $error_Message[] = '<div class="alert alert-danger">You Shoud Enter The Full User Name</div>';
            }
            $pass = '';
            if (empty($_POST['newpassword'])) {
                $pass = $_POST['oldpassword'];
            } else {
                $pass = sha1($_POST['newpassword']);
            }
            if (count($error_Message) == 0) {
                $sql = $con->prepare("Update users set UserName=?,Password=? ,Email=? ,FullName=? where User_ID=? ");

                $sql->execute(array($username, $pass, $email, $fullname, $userid));
                echo '<div class="text-center mt-5"> <i class="fas fa-h1 h1 text-success">' . $sql->rowCount() . ' </i><i class="h3">Update is successful!</li> <i class="fas fa-thumbs-up text-primary h1" aria-hidden="true"></<i>';
            } else {

                echo '<div class="container">';
                foreach ($error_Message as $error) {
                    echo $error;
                }
                echo '</div>';
            }
        } else {
            $message = 'You not can to go in this page dirictory';
            redirictHome($message, "members.php");
        }
    } elseif ($do == 'Delete') { // Delete Member Page
        $user_id = (isset($_GET['u_id']) && is_numeric($_GET['u_id'])) ? intval($_GET['u_id']) : '0';
        $sql = $con->prepare("select * from users where User_ID = ?");
        $sql->execute(array($user_id));
        $row = $sql->fetch();
        $count = $sql->rowCount();

        if ($count > 0) {
            $sql = $con->prepare("Delete from users where User_ID = :zdelete");
            $sql->bindParam(':zdelete', $user_id);
            $sql->execute();
            echo '<div class=" alert alert-success h1 font-weight-bold"> The User ID : ' . $user_id . ' is Deleted</div>';
        } else {

            echo '<div class="alert alert-danger h1 font-weight-bold"> The User is not exist!!</div>';
        }
    } elseif ($do == 'Activate') { // Activate Member Page
        $user_id = (isset($_GET['u_id']) && is_numeric($_GET['u_id'])) ? intval($_GET['u_id']) : '0';
        $sql = Check_item('User_ID', 'users', $user_id);



        if ($sql > 0) {
            $sql = $con->prepare("Update users SET RegStatus=1 where User_ID = ?");
            $sql->execute(array($user_id));
            $message = '<div class=" alert alert-success h1 font-weight-bold"> The User ID : ' . $user_id . ' is Activate</div>';
            redirictHome($message, 'members.php');
        } else {

            $message = '<div class="alert alert-danger h1 font-weight-bold"> The User is not exist!!</div>';
            redirictHome($message, 'members.php');
        }
    } else {
        $message = 'no users';
        redirictHome($message, "index.php");
    }

    include $tpl . 'footer.php';
} else { // else go to login page becouse the user is not admin
    header('Location:index.php');
    exit();
}
?>