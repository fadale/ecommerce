<?php

/*
================================
=======Template Page============
================================
*/
session_start();
if(isset($_SESSION['UserName'])){// if fine nay User to go in Member page
    $pageTitle='';
    include 'init.php';
    
    

if($do == 'manage'){// Manage Page

}else if($do=='Add'){//Add Member Page

}else if($do=='Insert'){// Insert Member Page

}else if($do == 'Edit'){// Page Editing Profile

}elseif($do == 'Update'){// Page POST Update if can to update data or not

}elseif($do=='Delete'){// Delete Member Page

}elseif($do=='Activate'){ // Activate Member Page

}
else{
    $message= 'no users';
    redirictHome($message,"index.php");
}

    include $tpl.'footer.php';
}else{// else go to login page becouse the user is not admin
    header('Location:index.php');
    exit();
}
?>