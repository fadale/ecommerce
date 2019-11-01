<?php

/*
================================
=======Categorie Page============
================================
*/
ob_start();
session_start();
if (isset($_SESSION['UserName'])) { // if fine nay User to go in Categorie page
    $pageTitle = 'Categories';
    include 'init.php';
    $do = isset($_GET['do']) ? $_GET['do'] : 'manage';
    if ($do == 'manage') {

        $order = array("ASC", "DESC");
        $ord = "ASC";
        if (isset($_GET['order']) == 'ASC' && in_array($_GET['order'], $order)) {
            $ord = $_GET['order'];
        }
        $sql = $con->prepare("SELECT * FROM categories ORDER BY Ordering $ord");

        $sql->execute();
        $rows = $sql->fetchAll();

        ?>

        <h2 class="text-center mt-5 mb-5 font-weight-bold">Manage Categories</h2>
       
        <div class="container">
        <a href="?do=Add" class="btn btn-primary mb-1"><i class="fas fa-plus"></i> Add Categore</a>
            <ul class="list-group">
                <li class="button-hidden list-group-item bg-dark text-white position-relative">
                    Manage Categories
                    <div class=" links d-block mr-2 position-absolute">
                        Ordering:
                        <a href="?order=ASC" class="btn  <?php if ($ord == 'ASC') {
                                                                        echo 'text-danger font-weight-bold';
                                                                    }else{echo 'font-weight-bold text-white';} ?>"><i class="fa fa-sort-asc" aria-hidden="true"></i> ASC</a>|
                        <a href="?order=DESC" class="btn <?php if ($ord == 'DESC') {
                                                                        echo 'text-danger font-weight-bold';
                                                                    }else{echo 'font-weight-bold text-white';} ?>"><i class="fa fa-sort-desc" aria-hidden="true"></i> DESC</a>
                    </div>
                </li>
            </ul>
            <ul class="list-group ">
                <?php foreach ($rows as $row) { ?>
                    <li class="list-group-item catagorie">
    
                        <h3 class="header"><?= $row['Name'] ?></h3>
                       
                        <div class="info">
                            <p><?= ($row['Description']=='')?'No Description':'Description:'.$row['Description']?></p>
                            <?=($row['Ordering']==0)?'':'<span class="bg-success p-1 rounded">Ordering: '.$row['Ordering'].'</span>';?>
                            <?=($row['Visibility']==0)?'':'<span class="bg-danger p-1 rounded">Visibile</span>';?>
                            <?=($row['Allow_Comment']==0)?'':'<span class="bg-primary p-1 rounded">Allow Comment</span>';?>
                            <?=($row['Allow_Ads']==0)?'':'<span class="bg-warning p-1 rounded">Allow Ads</span>';?>

                        </div>
                        <div class="btn-sitting">
                    <a href="?do=Edit&cat_id=<?=$row['C_ID']?>" class="btn btn-success"><i class="fas fa-edit"></i> Edit</a>
    `               <a href="?do=Delete&cat_id=<?=$row['C_ID']?>" class="btn btn-danger confirm"><i class="fas fa-trash-alt"></i> Delete</a>                
                    </div>
                    </li>
                  
                <?php } ?>
            </ul>
        </div>
    <?php } elseif ($do == 'Add') { //Add Member Page
            ?>
        <h2 class="text-center mt-5 mb-5 font-weight-bold">Add Categories</h2>
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
                    <label for="inputPassword" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-4">
                        <input type="text" name="description" class="form-control" placeholder="Enter the Description">

                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Ordering</label>
                    <div class="col-sm-4">
                        <input type="text" name="ordering" class="form-control" placeholder="Enter the Order number" autocomplete="off">

                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <label for="inputFullName" class="col-sm-2 col-form-label">Visibility</label>
                    <div class="col-sm-4">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="Visibility" id="vis-yes" value="0" checked>
                            <label class="form-check-label" for="exampleRadios1">
                                Yes
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="Visibility" id="vis-no" value="1">
                            <label class="form-check-label" for="exampleRadios2">
                                No
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <label for="inputFullName" class="col-sm-2 col-form-label">Allow Comment</label>
                    <div class="col-sm-4">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="Comment" id="com-yes" value="0" checked>
                            <label class="form-check-label" for="exampleRadios2">
                                Yes
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="Comment" id="com-no" value="1">
                            <label class="form-check-label" for="exampleRadios2">
                                No
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <label for="inputFullName" class="col-sm-2 col-form-label">Allow Ads</label>
                    <div class="col-sm-4">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="Ads" id="ads-yes" value="0" checked>
                            <label class="form-check-label" for="exampleRadios2">
                                Yes
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="Ads" id="ads-no" value="1">
                            <label class="form-check-label" for="exampleRadios2">
                                No
                            </label>
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

<?php
    } else if ($do == 'Insert') { // Insert Categorie Page

        echo '<h1 class="text-center">Insert Categories</h1>';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            $name = $_POST['name'];
            $description = $_POST['description'];
            $order = $_POST['ordering'];
            $Visibility = $_POST['Visibility'];
            $Comment = $_POST['Comment'];
            $Ads = $_POST['Ads'];
            $error_Message = array();
            if (empty($name)) {
                $error_Message[] = '<div class="alert alert-danger col-md-6">You Shoud Enter The Name</div>';
            }
        }
        if (empty($error_Message)) { // Insert Data in DataBase

            // Check if the username is exist or not
            $checkuser = Check_item("Name", "categories", $name);
            if ($checkuser == 1) {

                $message = "The Categories Name is Exist";
                redirictHome($message, "Categories.php");
            } else {
                $sql = $con->prepare("
                insert into categories(
                    Name,Description,Ordering,Visibility,Allow_Comment,Allow_Ads
                    ) values(
                        :zName,:zDescription,:zordering,:zVisibility,:zAllow_Comment,:zAllow_Ads
                        )");

                $sql->execute(array(
                    'zName'              => $name,
                    'zDescription'       => $description,
                    'zordering'          => $order,
                    'zVisibility'        => $Visibility,
                    'zAllow_Comment'     => $Comment,
                    'zAllow_Ads'         => $Ads
                ));
                $message = '<div class="text-center mt-5"> <i class="fas fa-h1 h1 text-success">'
                    . $sql->rowCount() .
                    ' </i><i class="h3">Insert is successful!</li>
                 <i class="fas fa-thumbs-up text-primary h1" aria-hidden="true"></<i>';
                redirictHome($message, 'categories.php');
            }
        } else { // Pint All Error Message

            echo '<div class="container">';
            foreach ($error_Message as $error) {
                echo $error;
            }
            echo '</div>';
        }
    } else if ($do == 'Edit') { // Page Editing Profile

        
        $user_id= (isset($_GET['cat_id']) && is_numeric($_GET['cat_id']))? intval($_GET['cat_id']):'0';
        $sql = $con->prepare("select * from categories where C_ID = ?");
    $sql->execute(array($user_id));
    $row=$sql->fetch();
    $count = $sql->rowCount();

    if($count>0){//check if fined any users
   ?>
                        <!--  Form Editing Member-->
       <h2 class="text-center mt-5 mb-5 font-weight-bold">Edit Categories</h2>
       <div class="container">
       <form action="?do=Update" method="post">
       <input type="hidden" name="catid" value="<?=$row['C_ID']?>">
       <div class="form-group row justify-content-center">
                    <label for="inputUserName" class="col-sm-2 col-form-label">Name</label>

                    <div class="input-group col-sm-4">

                        <input type="text" value="<?=$row['Name']?>" name="name" class="form-control border-right-0" placeholder="Name" autocomplete="off" required="required">
                        <div class="input-group-prepend">
                            <div class="input-group-text text-danger font-weight-bold bg-white star border-left-0 rounded-right">*</div>
                        </div>

                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-4">
                        <input type="text" value="<?=$row['Description']?>" name="description" class="form-control" placeholder="Enter the Description">

                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Ordering</label>
                    <div class="col-sm-4">
                        <input type="text" value="<?=$row['Ordering']?>" name="ordering" class="form-control" placeholder="Enter the Order number" autocomplete="off">

                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <label for="inputFullName" class="col-sm-2 col-form-label">Visibility</label>
                    <div class="col-sm-4">
                    
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="Visibility" id="vis-yes" value="0"<?=($row['Visibility']==0)?'checked':''?> >
                            <label class="form-check-label" for="exampleRadios1">
                                Yes
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="Visibility" id="vis-no" value="1" <?=($row['Visibility']==1)?'checked':''?> >
                            <label class="form-check-label" for="exampleRadios2">
                                No
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <label for="inputFullName" class="col-sm-2 col-form-label">Allow Comment</label>
                    <div class="col-sm-4">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="Comment" id="com-yes" value="0" <?=($row['Allow_Comment']==1)?'checked':''?>>
                            <label class="form-check-label" for="exampleRadios2">
                                Yes
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="Comment" id="com-no" value="1" <?=($row['Allow_Comment']==1)?'checked':''?>>
                            <label class="form-check-label" for="exampleRadios2">
                                No
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <label for="inputFullName" class="col-sm-2 col-form-label">Allow Ads</label>
                    <div class="col-sm-4">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="Ads" id="ads-yes" value="0" <?=($row['Allow_Ads']==1)?'checked':''?> >
                            <label class="form-check-label" for="exampleRadios2">
                                Yes
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="Ads" id="ads-no" value="1" <?=($row['Allow_Ads']==1)?'checked':''?>>
                            <label class="form-check-label" for="exampleRadios2">
                                No
                            </label>
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
    <?php 

}
    } elseif ($do == 'Update') { // Page POST Update if can to update data or not

        echo '<h1 class="text-center">Update Menmber</h1>';
        if($_SERVER['REQUEST_METHOD']=='POST'){
    
            $cat_id=$_POST['catid'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $order = $_POST['ordering'];
            $Visibility = $_POST['Visibility'];
            $Comment = $_POST['Comment'];
            $Ads = $_POST['Ads'];
            $error_Message= array();
            if(empty($name)){
                $error_Message[] ='<div class="alert alert-danger">You Shoud Enter The Name</div>';
            }
            if(strlen($name)<4){
                $error_Message[] ='<div class="alert alert-danger">You Shoud Enter The Name more than 4 characters</div>';
            }
           
            if(count($error_Message) == 0 ){
            $sql = $con->prepare("Update categories set
             Name=?,Description=? ,Ordering=? ,Visibility=?,Allow_Comment=?,Allow_Ads=? 
             where C_ID=? ");
    
            $sql->execute(array($name,$description,$order,$Visibility,$Comment,$Ads,$cat_id));
            echo '<div class="text-center mt-5"> <i class="fas fa-h1 h1 text-success">'.$sql->rowCount().' </i><i class="h3">Update is successful!</li> <i class="fas fa-thumbs-up text-primary h1" aria-hidden="true"></<i>';
            redirictHome($message,"categories.php",5);
        }else{
    
                echo'<div class="container">';
                foreach($error_Message as $error){
                    echo $error;
                }
                echo '</div>';
                redirictHome($message,"categories.php");
            }
        }else{
            $message='You not can to go in this page dirictory';
            redirictHome($message,"dashboard.php");
        }
    } elseif ($do == 'Delete') { // Delete Categorie Page

        $cat_id = (isset($_GET['cat_id']) && is_numeric($_GET['cat_id'])) ? intval($_GET['cat_id']) : '0';
        $sql = $con->prepare("select * from categories where C_ID = ?");
        $sql->execute(array($cat_id));
        $row = $sql->fetch();
        $count = $sql->rowCount();

        if ($count > 0) {
            $sql = $con->prepare("Delete from categories where C_ID = :zdelete");
            $sql->bindParam(':zdelete', $cat_id);
            $sql->execute();
            $message= '<div class=" alert alert-success h1 font-weight-bold"> The User ID : ' . $cat_id . ' is Deleted</div>';
            redirictHome($message,"categories.php",5);
        } else {

            $message= '<div class="alert alert-danger h1 font-weight-bold"> The Categore is not exist!!</div>';
            redirictHome($message,"categories.php",5);
          
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
ob_end_flush();
?>