<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="dashboard.php"><?php echo lang('Admin');?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="dashboard.php"><?php echo lang('home');?><span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="categories.php"><?php echo lang('Categories');?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="item.php"><?php echo lang('item');?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="members.php"><?php echo lang('member');?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="comment.php"><?php echo lang('comment');?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"><?php echo lang('statistics');?></a>
      </li>
    </ul>
    <ul class="nav navbar-nav dropdown-menu-right">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo $_SESSION['UserName']?>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="members.php?do=Edit&u_id=<?php echo $_SESSION['User_ID']?>"><?php echo lang('ed-profile');?></a>
          <a class="dropdown-item" href="#"><?php echo lang('sitting');?></a>
          <a class="dropdown-item" href="logout.php"><?php echo lang('logout');?></a>
        </div>
    </ul>
  </div>
</nav>