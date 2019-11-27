<div class="upper-bar">
  <div class="upper-cont">
   test
  </div>
</div>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php">Magic Shopping</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="nav nav-justified navbar-nav collapse navbar-collapse" id="navbarSupportedContent">
  
    <form class="navbar-form navbar-search col-md-8 col-sm-6" method="post" action="category.php" role="search">
      <div class="input-group">
        <input type="text" name="searching" class="form-control">
        <div class="input-group-btn">
          <button type="submit" class="btn btn-search btn-default rounded-0">
          <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
    </form>
    <ul class="navbar-nav mr-auto ml-4 bg-secondary rounded">
      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navcat" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-bars"></i>
        </a>
        <div class="dropdown-menu" aria-labelledby="navcat">
          <?php foreach(Get_Category() as $cat){?>
          <a class="dropdown-item" 
          href="category.php?c_i=<?=$cat['C_ID']?>&p_n=<?=str_replace(' ','-',$cat['Name'])?>">
          <?=$cat['Name']?>
        </a>
          <?php }?>
        </div>
      </li>
    </ul>
  </div>
</nav>