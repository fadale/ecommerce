<?php
session_start();

include 'init.php';
?>
<div class="container">
    <div class="text-center">
        <h1><?= str_replace('-', ' ', $_GET['p_n']) ?></h1>
    </div>

    <div class="row">
        <?php foreach (Get_Items($_GET['c_i']) as $item) { ?>
            <div class="col-md-3 col-sm-6">
                <div class="card-deck">
                    <div class="card">
                        <img class="card-img-top" src="layout/image/note.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h6 class="card-title"><?=$item['Name']?></h6>
                            <p class="card-text">
                                <strong><?=$item['Price']?>$</strong>
                            </p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Last updated <?=$item['Add_Date']?></small>
                        </div>
                    </div>
                </div>
            </div>

        <?php } ?>
    </div>



</div>';

<?php include $tpl . 'footer.php'; ?>