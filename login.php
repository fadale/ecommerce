<?php
$noNavbar = '';
include 'init.php';
?>
<div class="logreg-forms">
    <div class="container">
        <h1 class="text-center">
            <span class="selected" data-class="form-signin">Sign in</span> | 
            <span data-class="form-signup">Sign Up</span>
        </h1>
        <form class="form-signin" action="">
            <input class="form-control mb-2" placeholder="Email address" required="" autofocus="" type="email" name="email">
            <input class="form-control" type="password" name="password" placeholder="Password" required="">

            <button class="btn btn-success btn-block" type="submit">
            <i class="fas fa-sign-in-alt"></i> Sign in
        </button>
        </form>
        <form class="form-signin" action="">
            <input class="form-control mb-2" placeholder="Email address" required="" autofocus="" type="email" name="email">
            <input class="form-control" type="password" name="password" placeholder="Password" required="">

            <button class="btn btn-success btn-block" type="submit">
            <i class="fas fa-sign-in-alt"></i> Sign in
        </button>
        </form>

        <form class="form-signup" action="" method="post">
        <input type="text" id="user-name" class="form-control mb-2" placeholder="Full name" required="" autofocus="">
        <input type="email" id="user-email" class="form-control  mb-2" placeholder="Email address" required autofocus="">
        <input type="password" id="user-pass" class="form-control  mb-2" placeholder="Password" required autofocus="">
        <input type="password" id="user-repeatpass" class="form-control" placeholder="Repeat Password" required autofocus="">
        <button class="btn btn-primary btn-block" type="submit"><i class="fas fa-user-plus"></i> Sign Up</button>
        </form>
    </div>
</div>

<?php $NoFooter='';
 include 'includes/templeats/footer.php';?>