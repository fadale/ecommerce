<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="<?php echo $css ?>bootstrap.min.css">
  <link rel="stylesheet" href="<?= $css ?>back.css">
  <link rel="stylesheet" href="<?php echo $css ?>all.css">
  <title><?php getTitle() ?></title>
</head>

<body>
  <div class="upper-bar text-right">
    <div class="upper-cont">
      <?php
      if (isset($_SESSION['username'])) {
        echo '
      <div class="dropdown">
      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Hello ' . $_SESSION['username'] . '
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="profile.php">Profile</a>
        <a class="dropdown-item" href="#">Another action</a>
        <a class="dropdown-item" href="logout.php">Logout</a>
      </div>
    </div>';
      } else {

        ?>
        <a href="login.php">
          <span class="">Login/Signup</span>
        </a>
      <?php } ?>
    </div>
  </div>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">Awsal</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="nav nav-justified navbar-nav collapse navbar-collapse" id="navbarSupportedContent">

      <ul class="navbar-nav mr-auto ml-4 bg-secondary rounded">

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navcat" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-bars"></i>
          </a>
          <div class="dropdown-menu" aria-labelledby="navcat">
            <?php foreach (Get_Category() as $cat) { ?>
              <a class="dropdown-item" href="category.php?c_i=<?= $cat['C_ID'] ?>&p_n=<?= str_replace(' ', '-', $cat['Name']) ?>">
                <?= $cat['Name'] ?>
              </a>
            <?php } ?>
          </div>
        </li>
      </ul>
    </div>
  </nav>