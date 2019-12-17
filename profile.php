<?php

session_start();
$pageTitle = 'Awsal';
include 'init.php';
if (isset($_SESSION['username'])) {
    $getuser = $con->prepare("select * from users where Username=?");
    $getuser->execute(array($_SESSION['username']));
    $info = $getuser->fetch();
    ?>

    <div class="container">
        <h1 class="text-center text-secondary mt-3">My Profile</h1>

        <div class="row mt-5">

            <div class="col-4">
                <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Profile</a>
                    <a class="list-group-item list-group-item-action" id="list-ads-list" data-toggle="list" href="#list-ads" role="tab" aria-controls="ads">Ads</a>
                    <a class="list-group-item list-group-item-action" id="list-comments-list" data-toggle="list" href="#list-comments" role="tab" aria-controls="comments">Comments</a>

                </div>
            </div>
            <div class="col-8">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                        <ul class="list-group list-unstyled border-0 row">
                            <li class="list-group-item col-sm-6 col-md-8  justify-content-between align-items-center">
                                <i class="fa fa-unlock-alt"></i>
                                User Name:
                                <span class=" ml-3 badge-primary badge-pill"> 
                                    <?php echo $info['UserName'] ?></span>
                            </li>
                            <li class="list-group-item col-sm-6 col-md-8 justify-content-between align-items-center">
                                <i class="fa fa-user fa-fw" aria-hidden="true"></i>
                                     Full Name:
                                    <span class="badge-primary badge-pill"> 
                                         <?php echo $info['FullName'] ?></span>
                            </li>
                            <li class="list-group-item col-sm-6 col-md-8 justify-content-between align-items-center">
                                <i class="fa fa-envelope fa-fw"></i>
                                <span> Email:</span>

                                <span class=" badge-primary badge-pill"><?php echo '<span>' . $info['Email'] . '</span>' ?></span>
                            </li>
                            <li class="list-group-item col-sm-6 col-md-8 justify-content-between align-items-center">
                                <i class="far fa-calendar-alt fa-fw"></i>
                                <span>Registered Date:</span>
                                <span class="ml-3 badge-primary badge-pill"><?php echo '<span>' . $info['Date'] . '</span>' ?></span>
                            </li>
                            <li class="list-group-item col-sm-6 col-md-8 justify-content-between align-items-center">
                                <i class="fas fa-tag fa-fw"></i>
                                <span>Fav Category:</span>


                            </li>
                        </ul>






                      


                        



                        



                    </div>
                    <div class="tab-pane fade" id="list-ads" role="tabpanel" aria-labelledby="list-ads-list">
                    </div>
                    <div class="tab-pane fade" id="list-comments" role="tabpanel" aria-labelledby="list-comments-list">
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php
    include $tpl . 'footer.php';
} else {
    header('location:login.php');
} ?>