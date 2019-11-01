<?php
ob_start("ob_gzhandler");
session_start();
if(isset($_SESSION['UserName'])){
    $pageTitle='Dashboard';
    include 'init.php';
    
   
    ?>
    <div class="container home-stats text-center">
        <h1 class="text-secondary mt-4 mb-5">Dashboard</h1>
        <div class="row">
            <div class="col-md-3 mb-3">
                <a href="members.php">
                <div class="stat s-member text-white p-2 fa-1x border border-secondary rounded">
                    Total Member 
                    <span class="d-block fa-5x"><?php echo Count_Item("User_ID","users");?></span>
                </div>
                </a>
            </div>
            <div class="col-md-3 mb-3">
                     <a href="members.php?do=manage&page=panding">
                <div class="stat s-panding text-white p-2 fa-1x border border-secondary rounded">
                    Panding Member <span class="d-block fa-5x"><?php echo Check_item('RegStatus','users',0)?></span>
                </div>
                    </a>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stat s-item text-white p-2 fa-1x border border-secondary rounded">
                    Total Items <span class="d-block fa-5x">958</span>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stat s-comment text-white p-2 fa-1x border border-secondary rounded">
                    Total Comments <span class="d-block fa-5x">1500</span>
                </div>
            </div>
        </div>
    </div>

    <div class="container latst mt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?php $limits=10;?>
                        <i class="fa fa-users" aria-hidden="true"></i> Latest <?=$limits?> Registerd Users
                    </div>
                    <div class="panel-body">
                       <?php
                        $rows=Get_Items("*","users","User_ID",$limits);
                        foreach($rows as $row){
                            echo $row['FullName'].'<br>';
                        }
                       ?>
                    </div>

                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-tag" aria-hidden="true"></i> Latest Items
                    </div>
                    <div class="panel-body">
                     
                    </div>

                </div>
            </div>
        </div>
    </div>

   <?php include $tpl.'footer.php';
}else{
    header('Location:index.php');
    exit();
}

ob_end_flush();
?>