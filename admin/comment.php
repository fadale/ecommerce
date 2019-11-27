<?php

/*
================================
=======Comments Page============
================================
*/
session_start();
if (isset($_SESSION['UserName'])) { // if fine nay User to go in Member page
    $pageTitle = 'Comments';
    include 'init.php';


    $do = isset($_GET['do']) ? $_GET['do'] : 'manage';
    if ($do == 'manage') { // Manage Page

        $stmt = $con->prepare("SELECT
                            comments.*,items.Name AS Item_Name,users.UserName AS Member
                        FROM
                        comments
                            INNER JOIN
                                items
                                ON
                                items.I_ID = comments.Item_Id
                                INNER JOIN
                                users
                                ON
                                users.User_ID = comments.User_Id");
                              

        $stmt->execute();
        $rows = $stmt->fetchAll();


        ?>

        <h1 class="text-center">Manage Comment</h1>

        <div class="container">
        <a href="?do=Add" class="btn btn-primary mt-5 mb-3 float-right"><i class="fas fa-plus"></i> Add Comment</a>
            <div class="table-responsive">
                <table class="table text-center">
                    <thead class="thead-dark">
                        <tr>

                            <th scope="col">#ID</th>
                            <th scope="col">Comment</th>
                            <th scope="col">Comment Date</th>
                            <th scope="col">Item</th>
                            <th scope="col">User Name</th>
                            <th scope="col">Control</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                foreach ($rows as $row) {
                                    echo '  <tr>
                    
                            <td>' . $row['CO_ID'] . '</td>
                            <td>' . $row['Comment'] . '</td>
                            <td>'.$row['Comment_Date'].'</td>
                            <td>' . $row['Item_Name'] . '</td>
                            <td>' . $row['Member'] . '</td>
                            <td>
                            <a href="?do=Edit&co_id=' . $row['CO_ID'] . ' " class="btn btn-success"><i class="fas fa-edit"></i> Edit</a>
                            <a href="?do=Delete&co_id=' . $row['CO_ID'] . '" class="btn btn-danger confirm"><i class="fas fa-trash-alt"></i> Delete</a>
                            ';

                            if ($row['Statues'] == 0) {
                                echo ' <a href="?do=Accept&co_id=' . $row['CO_ID'] . '" class="btn btn-info confirm"><i class="fa fa-check"></i>Accepted</a>';
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
    }else if($do == 'Edit'){// Page Editing Comment
        $co_id = (isset($_GET['co_id']) && is_numeric($_GET['co_id'])) ? intval($_GET['co_id']) : '0';
        $sql = $con->prepare("select * from comments where CO_ID = ?");
        $sql->execute(array($co_id));
        $row = $sql->fetch();
        $count = $sql->rowCount();

        if ($count > 0) { //check if fined any comment
            ?>
    <!--  Form Editing Member-->
    <h2 class="text-center mt-5 mb-5 font-weight-bold">Edit Comment</h2>
    <div class="container">
        <form action="?do=Update" method="post">
            <input type="hidden" name="co_id" value="<?= $row['CO_ID'] ?>">
            <div class="form-group row justify-content-center">
                <label for="inputUserName" class="col-sm-2 col-form-label"><strong>Comment</strong></label>
                <div class="form-group col-sm-4">
                    <textarea class="form-control" name="comment"  id="" row="5"><?=$row['Comment']?></textarea>
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

    }elseif($do == 'Update'){// Page POST Update if can to update data or not
        echo '<h1 class="text-center">Update Comment</h1>';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $coid = $_POST['co_id'];
            $comment = $_POST['comment'];
            $error_Message = array();
            if (empty($comment)) {
                $error_Message[] = '<div class="alert alert-danger">You Shoud Enter The Comment</div>';
            }
            if (count($error_Message) == 0) {
                $sql = $con->prepare("Update comments set Comment=? where CO_ID=? ");

                $sql->execute(array($comment,$coid));
                $message = '<div class="text-center mt-5"> <i class="fas fa-h1 h1 text-success">' . $sql->rowCount() . ' </i><i class="h3">Update is successful!</li> <i class="fas fa-thumbs-up text-primary h1" aria-hidden="true"></<i>';
                redirictHome($message, "comment.php");
             } else {

                echo '<div class="container">';
                foreach ($error_Message as $error) {
                    echo $error;
                }
                echo '</div>';
            }
        } else {
            $message = 'You not can to go in this page dirictory';
            redirictHome($message, "index.php");
        }
    
    }elseif($do=='Delete'){// Delete Comments Page
        $co_id = (isset($_GET['co_id']) && is_numeric($_GET['co_id'])) ? intval($_GET['co_id']) : '0';
        $sql = $con->prepare("select * from comments where CO_ID = ?");
        $sql->execute(array($co_id));
        $row = $sql->fetch();
        $count = $sql->rowCount();

        if ($count > 0) {
            $sql = $con->prepare("Delete from comments where CO_ID = :zdelete");
            $sql->bindParam(':zdelete', $co_id);
            $sql->execute();
            $message= '<div class=" alert alert-success h1 font-weight-bold"> The ID : ' . $co_id . ' is Deleted</div>';
            redirictHome($message, "comment.php");
        } else {

            $message='<div class="alert alert-danger h1 font-weight-bold"> The Comment is not exist!!</div>';
            redirictHome($message, "comment.php");
        }
    
    }elseif($do=='Accept'){ // Activate Member Page
        $co_id = (isset($_GET['co_id']) && is_numeric($_GET['co_id'])) ? intval($_GET['co_id']) : '0';
        $sql = Check_item('CO_ID', 'comments', $co_id);

        if ($sql > 0) {
            $sql = $con->prepare("Update comments SET Statues=1 where CO_ID = ?");
            $sql->execute(array($co_id));
            $message = '<div class=" alert alert-success h1 font-weight-bold"> The  ID : ' . $co_id . ' is Activate</div>';
            redirictHome($message, 'comment.php');
        } else {

            $message = '<div class="alert alert-danger h1 font-weight-bold"> The comment is not exist!!</div>';
            redirictHome($message, 'comment.php');
        }
    }
     else {
        $message = 'no users';
        redirictHome($message, "index.php");
    }

    include $tpl . 'footer.php';
} else { // else go to login page becouse the user is not admin
    header('Location:index.php');
    exit();
}
?>