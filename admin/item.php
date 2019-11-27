<?php

/*
================================
=======Item Page============
================================
*/
session_start();
if (isset($_SESSION['UserName'])) { // if fine nay User to go in Member page
    $pageTitle = 'Item';
    include 'init.php';
    $do = isset($_GET['do']) ? $_GET['do'] : 'manage';

    if ($do == 'manage') { // Manage Page


        $sql = $con->prepare("select
                                 items.*,
                                 categories.Name AS category_name,
                                 users.UserName
                              from
                                items
                              inner join
                                 categories
                              on 
                                 categories.C_ID =items.Cat_ID
                              inner join
                                 users
                              on
                                 users.User_ID=items.Member_ID");

        $sql->execute();
        $rows = $sql->fetchAll();
        ?>

        <h1 class="text-center">Manage Items</h1>

        <div class="container-fluid">
            <a href="?do=Add" class="btn btn-primary mt-5 mb-3 float-right"><i class="fas fa-plus"></i> Add Item</a>
            <div class="table-responsive-md">
                <table class="table text-center">
                    <thead class="thead-dark">
                        <tr>

                            <th scope="col">#ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Statues</th>
                            <th scope="col">Date</th>
                            <th scope="col">Country</th>
                            <th scope="col">Categore</th>
                            <th scope="col">User Name</th>
                            <th scope="col">Control</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                foreach ($rows as $row) {
                                    echo '  <tr>
                            
                                 <td>' . $row['I_ID'] . '</td>
                                 <td>' . $row['Name'] . '</td>
                                  <td>' . $row['Description'] . '</td>
                                  <td>' . $row['Price'] . '</td>
                                  <td>' . $row['Quantity'] . '</td>
                                  <td>' . $row['Statues'] . '</td>
                                  <td>' . $row['Add_Date'] . '</td>
                                  <td>' . $row['Country_Made'] . '</td>
                                  <td>' . $row['category_name'] . '</td>
                                  <td>' . $row['UserName'] . '</td>
                                
                                  <td>
                                      <a href="?do=Edit&i_id=' . $row['I_ID'] . ' " class="btn btn-success"><i class="fas fa-edit"></i> Edit</a>
                                      <a href="?do=Delete&i_id=' . $row['I_ID'] . '" class="btn mt-1 btn-danger "><i class="fas fa-trash-alt"></i> Delete</a>
                                     ';
                                    if ($row['Acceptance'] == 0) {
                                        echo ' <a href="?do=Accept&i_id=' . $row['I_ID'] . '" class="btn btn-info mt-1 "><i class="fa fa-check"></i> Accept</a>';
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

        } else if ($do == 'Add') { //Add Item Page
            ?>
        <h2 class="text-center mt-5 mb-5 font-weight-bold">Add Item</h2>
        <div class="container">
            <form action="?do=Insert" method="post">
                <div class="form-group row justify-content-center">
                    <label for="inputUserName" class="col-sm-2 col-form-label">Name</label>

                    <div class="input-group col-sm-4">

                        <input type="text" name="name" class="form-control border-right-0" placeholder="Name" autocomplete="off" required="required">
                        <div class="input-group-prepend">
                            <div class="input-group-text text-danger font-weight-bold bg-white star border-left-0 rounded-right">*</div>
                        </div>

                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <label for="Description" class="col-sm-2 col-form-label">Description</label>
                    <div class="input-group col-sm-4">
                        <input type="text" name="description" class="form-control border-right-0" placeholder="Enter the Description" required="required">
                        <div class="input-group-prepend">
                            <div class="input-group-text text-danger font-weight-bold bg-white star border-left-0 rounded-right">*</div>
                        </div>
                    </div>
                </div>

                <div class="form-group row justify-content-center">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Price</label>
                    <div class="input-group col-sm-4">
                        <input type="text" name="price" class="form-control border-right-0" placeholder="Enter the Price" autocomplete="off" required="required">
                        <div class="input-group-prepend">
                            <div class="input-group-text text-danger font-weight-bold bg-white star border-left-0 rounded-right">*</div>
                        </div>
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Quantity</label>
                    <div class="input-group col-sm-4">
                        <input type="number" minlength="0" name="Quantity" class="form-control border-right-0" autocomplete="off" required="required">
                        <div class="input-group-prepend">
                            <div class="input-group-text text-danger font-weight-bold bg-white star border-left-0 rounded-right">*</div>
                        </div>
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Country</label>
                    <div class="input-group col-sm-4">
                        <input type="text" name="country" class="form-control border-right-0" placeholder="Enter the Country" autocomplete="off" required="required">
                        <div class="input-group-prepend">
                            <div class="input-group-text text-danger font-weight-bold bg-white star border-left-0 rounded-right">*</div>
                        </div>
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <label for="Statues" class="col-sm-2 col-form-label border-right-0">Statues</label>
                    <div class="col-sm-4">
                        <select class="form-control" name="statues">
                            <option value="0">...</option>
                            <option value="1">New</option>
                            <option value="2">Used</option>
                            <option value="3">Old</option>
                            <option value="4">new whitout tage</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <label for="member" class="col-sm-2 col-form-label border-right-0">Member</label>
                    <div class="col-sm-4">
                        <select class="form-control" name="member">
                            <option value="0">...</option>
                            <?php
                                    $users = Get_All("*", "users");
                                    foreach ($users as $user) {
                                        echo '<option value="' . $user['User_ID'] . '">' . $user['FullName'] . '</option>';
                                    }
                                    ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <label for="categore" class="col-sm-2 col-form-label border-right-0">categore</label>
                    <div class="col-sm-4">
                        <select class="form-control" name="categore">
                            <option value="0">...</option>
                            <?php
                                    $cats = Get_All("*", "categories");
                                    foreach ($cats as $cat) {
                                        echo '<option value="' . $cat['C_ID'] . '">' . $cat['Name'] . '</option>';
                                    }
                                    ?>
                        </select>
                    </div>
                </div>


                <div class="form-group row">
                    <div class="text-center col-sm-11">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>


        <?php } else if ($do == 'Insert') { // Insert Item Page

                echo '<h1 class="text-center">Insert Items</h1>';
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {


                    $name = $_POST['name'];
                    $description = $_POST['description'];
                    $price = $_POST['price'];
                    $Quantity = $_POST['Quantity'];
                    $country = $_POST['country'];
                    $statues = $_POST['statues'];
                    $member = $_POST['member'];
                    $categore = $_POST['categore'];

                    $error_Message = array();
                    if (empty($name)) {
                        $error_Message[] = '<div class="alert alert-danger col-md-6">You Shoud Enter <strong> The Name</strong></div>';
                    }
                    if (empty($description)) {
                        $error_Message[] = '<div class="alert alert-danger col-md-6">You Shoud Enter <strong> The Description</strong></div>';
                    }
                    if (empty($price)) {
                        $error_Message[] = '<div class="alert alert-danger col-md-6">You Shoud Enter <strong> The Price</strong></div>';
                    }
                    if (empty($Quantity)) {
                        $error_Message[] = '<div class="alert alert-danger col-md-6">You Shoud Enter <strong> The Quantity</strong></div>';
                    }
                    if (empty($country)) {
                        $error_Message[] = '<div class="alert alert-danger col-md-6">You Shoud Enter <strong> The Country</strong></div>';
                    }
                    if (empty($statues)) {
                        $error_Message[] = '<div class="alert alert-danger col-md-6">You Shoud Enter <strong> The States</strong></div>';
                    }
                    if (empty($member)) {
                        $error_Message[] = '<div class="alert alert-danger col-md-6">You Shoud Enter <strong> The Member</strong></div>';
                    }
                    if (empty($categore)) {
                        $error_Message[] = '<div class="alert alert-danger col-md-6">You Shoud Enter <strong> The Categories</strong></div>';
                    }
                }
                if (empty($error_Message)) { // if no error message then Insert Data in DataBase

                    $sql = $con->prepare("
        insert into items(
            Name,Description,Price,Quantity,Country_Made,Statues,Add_Date,Cat_ID,Member_ID
            ) values(
                :zName,:zDescription,:zprice,:zquantity,:zcountry,:zstatues,now(),:zcategore,:zmember)");

                    $sql->execute(array(
                        'zName'              => $name,
                        'zDescription'       => $description,
                        'zprice'             => $price,
                        'zquantity'          => $Quantity,
                        'zcountry'           => $country,
                        'zstatues'           => $statues,
                        'zcategore'          => $categore,
                        'zmember'            => $member


                    ));
                    $message = '<div class="text-center mt-5"> <i class="fas fa-h1 h1 text-success">'
                        . $sql->rowCount() .
                        ' </i><i class="h3">Insert is successful!</li>
                <i> ' . $name . $description . $price . $country . $statues . '

                </i>
         <i class="fas fa-thumbs-up text-primary h1" aria-hidden="true"></<i>';
                    redirictHome($message, 'item.php');
                } else { // Pint All Error Message

                    echo '<div class="container">';
                    foreach ($error_Message as $error) {
                        echo $error;
                    }
                    echo '</div>';
                }
            } else if ($do == 'Edit') { // Page Item

                $item_id = (isset($_GET['i_id']) && is_numeric($_GET['i_id'])) ? intval($_GET['i_id']) : '0';
                $sql = $con->prepare("select * from items where I_ID = ?");
                $sql->execute(array($item_id));
                $row = $sql->fetch();
                $count = $sql->rowCount();

                if ($count > 0) { //check if fined any users
                    ?>
            <!--  Form Editing Member-->
            <h2 class="text-center mt-5 mb-5 font-weight-bold">Edit Item</h2>
            <div class="container">
                <form action="?do=Update" method="post">
                    <input type="hidden" name="itemid" value="<?= $row['I_ID'] ?>">
                    <div class="form-group row justify-content-center">
                        <label for="inputUserName" class="col-sm-2 col-form-label">Name</label>

                        <div class="input-group col-sm-4">

                            <input type="text" name="name" class="form-control border-right-0" value="<?= $row["Name"] ?>" autocomplete="off" required="required">
                            <div class="input-group-prepend">
                                <div class="input-group-text text-danger font-weight-bold bg-white star border-left-0 rounded-right">*</div>
                            </div>

                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label for="Description" class="col-sm-2 col-form-label">Description</label>
                        <div class="input-group col-sm-4">
                            <input type="text" name="description" class="form-control border-right-0" value="<?= $row['Description'] ?>" required="required">
                            <div class="input-group-prepend">
                                <div class="input-group-text text-danger font-weight-bold bg-white star border-left-0 rounded-right">*</div>
                            </div>
                        </div>
                    </div>
                  
                    <div class="form-group row justify-content-center">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Price</label>
                        <div class="input-group col-sm-4">
                            <input type="text" name="price" class="form-control border-right-0" value="<?= $row['Price'] ?>" autocomplete="off" required="required">
                            <div class="input-group-prepend">
                                <div class="input-group-text text-danger font-weight-bold bg-white star border-left-0 rounded-right">*</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Quantity</label>
                        <div class="input-group col-sm-4">
                            <input type="number" name="Quantity" class="form-control border-right-0" value="<?= $row['Quantity'] ?>" autocomplete="off" required="required">
                            <div class="input-group-prepend">
                                <div class="input-group-text text-danger font-weight-bold bg-white star border-left-0 rounded-right">*</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Country</label>
                        <div class="input-group col-sm-4">
                            <input type="text" name="country" class="form-control border-right-0" value="<?= $row['Country_Made'] ?>" autocomplete="off" required="required">
                            <div class="input-group-prepend">
                                <div class="input-group-text text-danger font-weight-bold bg-white star border-left-0 rounded-right">*</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label for="Statues" class="col-sm-2 col-form-label border-right-0">Statues</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="statues">

                                <option value="0" <?php if ($row['Statues'] == 0) {
                                                                    echo 'selected';
                                                                } ?>>...</option>
                                <option value="1" <?php if ($row['Statues'] == 1) {
                                                                    echo 'selected';
                                                                } ?>>New</option>
                                <option value="2" <?php if ($row['Statues'] == 2) {
                                                                    echo 'selected';
                                                                } ?>>Used</option>
                                <option value="3" <?php if ($row['Statues'] == 3) {
                                                                    echo 'selected';
                                                                } ?>>Old</option>
                                <option value="4" <?php if ($row['Statues'] == 4) {
                                                                    echo 'selected';
                                                                } ?>>new whitout tage</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label for="member" class="col-sm-2 col-form-label border-right-0">Member</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="member">
                                <option value="0">...</option>
                                <?php
                                            $users = Get_All("*", "users");
                                            foreach ($users as $user) {
                                                if ($row['Member_ID'] == $user['User_ID']) {
                                                    echo '<option value="' . $user['User_ID'] . '"selected>' . $user['FullName'] . '</option>';
                                                }
                                                echo '<option value="' . $user['User_ID'] . '">' . $user['FullName'] . '</option>';
                                            }
                                            ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label for="categore" class="col-sm-2 col-form-label border-right-0">categore</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="categore">
                                <option value="0">...</option>
                                <?php
                                            $cats = Get_All("*", "categories");
                                            foreach ($cats as $cat) {
                                                if ($row['Cat_ID'] == $cat['C_ID']) {
                                                    echo '<option value="' . $cat['C_ID'] . '"selected>' . $cat['Name'] . '</option>';
                                                }
                                                echo '<option value="' . $cat['C_ID'] . '">' . $cat['Name'] . '</option>';
                                            }
                                            ?>
                            </select>
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
                        $stmt = $con->prepare("SELECT
                                 comments.*,users.UserName AS Member
                                FROM
                                    comments
                                INNER JOIN
                                    users
                                ON
                                    users.User_ID = comments.User_Id
                                    where Item_Id =?");


                        $stmt->execute(array($item_id));
                        $rows = $stmt->fetchAll();

                        if (!empty($rows)) {

                            ?>


                <div class="container pt-3">
                    <h1 class="text-center">Manage [<?= $row["Name"] ?>] Comment</h1>
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Comment</th>
                                    <th scope="col">Comment Date</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Control</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                                foreach ($rows as $row) {
                                                    echo '  <tr>
                            <td>' . $row['Comment'] . '</td>
                            <td>' . $row['Comment_Date'] . '</td>
                            <td>' . $row['Member'] . '</td>
                            <td>
                            <a href="comment.php?do=Edit&co_id=' . $row['CO_ID'] . ' " class="btn btn-success"><i class="fas fa-edit"></i> Edit</a>
                            <a href="comment.php?do=Delete&co_id=' . $row['CO_ID'] . '" class="btn btn-danger confirm"><i class="fas fa-trash-alt"></i> Delete</a>
                            ';

                                                    if ($row['Statues'] == 0) {
                                                        echo ' <a href="comment.php?do=Accept&co_id=' . $row['CO_ID'] . '" class="btn btn-info confirm"><i class="fa fa-check"></i>Accepted</a>';
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
            }
        }
    } elseif ($do == 'Update') { // Page POST Update if can to update data or not
        echo '<h1 class="text-center">Update Item</h1>';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $item_id = $_POST['itemid'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $Quantity=$_POST['Quantity'];
            $country = $_POST['country'];
            $statues = $_POST['statues'];
            $member = $_POST['member'];
            $categore = $_POST['categore'];

            $error_Message = array();
            if (empty($name)) {
                $error_Message[] = '<div class="alert alert-danger col-md-6">You Shoud Enter <strong> The Name</strong></div>';
            }
            if (empty($description)) {
                $error_Message[] = '<div class="alert alert-danger col-md-6">You Shoud Enter <strong> The Description</strong></div>';
            }
            if (empty($price)) {
                $error_Message[] = '<div class="alert alert-danger col-md-6">You Shoud Enter <strong> The Price</strong></div>';
            }
            if (empty($Quantity)) {
                $error_Message[] = '<div class="alert alert-danger col-md-6">You Shoud Enter <strong> The Quantity</strong></div>';
            }
            if (empty($country)) {
                $error_Message[] = '<div class="alert alert-danger col-md-6">You Shoud Enter <strong> The Country</strong></div>';
            }
            if (empty($statues)) {
                $error_Message[] = '<div class="alert alert-danger col-md-6">You Shoud Enter <strong> The States</strong></div>';
            }
            if (empty($member)) {
                $error_Message[] = '<div class="alert alert-danger col-md-6">You Shoud Enter <strong> The Member</strong></div>';
            }
            if (empty($categore)) {
                $error_Message[] = '<div class="alert alert-danger col-md-6">You Shoud Enter <strong> The Categories</strong></div>';
            }

            if (count($error_Message) == 0) {
                $sql = $con->prepare("Update
                                        items set  
                                            Name=?,
                                            Description=?,
                                            Price=?,
                                            Quantity=?,
                                            Country_Made=?,
                                            Statues=?,
                                            Cat_ID=?,
                                            Member_ID=?
                                        where I_ID=? ");

                $sql->execute(array($name, $description, $price,$Quantity, $country, $statues, $categore, $member, $item_id));
                $message = '<div class="text-center mt-5"> <i class="fas fa-h1 h1 text-success">' . $sql->rowCount() . ' </i><i class="h3">Update is successful!</li> <i class="fas fa-thumbs-up text-primary h1" aria-hidden="true"></<i>';
                redirictHome($message, 'item.php');
            } else {

                echo '<div class="container">';
                foreach ($error_Message as $error) {
                    echo $error;
                }
                echo '</div>';
            }
        } else {
            $message = 'You not can to go in this page dirictory';
            redirictHome($message, "item.php");
        }
    } elseif ($do == 'Delete') { // Delete Item Page
        $item_id = (isset($_GET['i_id']) && is_numeric($_GET['i_id'])) ? intval($_GET['i_id']) : '0';
        $sql = $con->prepare("select * from items where I_ID = ?");
        $sql->execute(array($item_id));
        $row = $sql->fetch();
        $count = $sql->rowCount();

        if ($count > 0) {
            $sql = $con->prepare("Delete from items where I_ID = :zdelete");
            $sql->bindParam(':zdelete', $item_id);
            $sql->execute();
            $message = '<div class=" alert alert-success h1 font-weight-bold"> The Item ID : ' . $item_id . ' is Deleted</div>';
            redirictHome($message, 'item.php');
        } else {

            $message = '<div class="alert alert-danger h1 font-weight-bold"> The item is not exist!!</div>';
            redirictHome($message, 'item.php');
        }
    } elseif ($do == 'Accept') { // Activate Item Page

        $item_id = (isset($_GET['i_id']) && is_numeric($_GET['i_id'])) ? intval($_GET['i_id']) : '0';
        $sql = Check_item('I_ID', 'items', $item_id);



        if ($sql > 0) {
            $sql = $con->prepare("Update items SET Acceptance=1 where I_ID = ?");
            $sql->execute(array($item_id));
            $message = '<div class=" alert alert-success h1 font-weight-bold"> The User ID : ' . $item_id . ' is Accept</div>';
            redirictHome($message, 'item.php');
        } else {

            $message = '<div class="alert alert-danger h1 font-weight-bold"> The Item is not exist!!</div>';
            redirictHome($message, 'item.php');
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