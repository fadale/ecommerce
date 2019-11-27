<?php
/*

    Create Function to get title page
*/
function  getTitle() {

    global $pageTitle;
    if(isset($pageTitle)){
        echo $pageTitle;
    }else{
        echo "Default";
    }
    
}

/**
 * Redirected Function Home Page V1.0
 * $titleMsg Div echo message
 * $second this is time to refresh to index.php
 */
function redirictHome($titleMsg,$url='index.php',$second = 3){
    echo '<div class="alert alert-danger">'.$titleMsg.'</div>';
    echo '<div class="alert alert-danger"> You Will do Rediricted in '.$second.'</div>';
    header("refresh:$second;url=$url");
    exit();
}


/**
 * Check item function v1.0
 * Check item in Database 
 * $select : The item to select [EX: user,email]
 * $from : The Table to select from [EX: Users,Category,Products]
 * $value : The item to select in Database[EX: "Ali","cat","any value"]
*/

function Check_item($select,$from,$value){
    global $con;
    $stat=$con->prepare("SELECT $select FROM $from WHERE $select = ?");
    $stat->execute(array($value));
    $count = $stat->rowCount();
    //Return 1 or 0 , if $count is 1 then the user is exist else the user is not exist
    return $count;
}

/**
 * Count item function v1.0
 * $item: The item to select [EX: user,email]
 * $table: The table to select from[EX: users]
 */

 function Count_Item($item,$table){
     global$con;
     $stat=$con->prepare("SELECT count($item) FROM $table");
    $stat->execute();
    $count = $stat->fetchColumn();
    return $count;
 }

 /**
 * Get Items function v1.0
 * $item: The item to select [EX: user,email]
 * $table: The table to select from[EX: users]
 * $order : how to order [EX: User_ID or Name or..]
 * $limit : get Date by limit number
 */

function Get_Items($item,$table,$order,$limit=5){
    global$con;
    $stat=$con->prepare("SELECT $item FROM $table  ORDER BY $order DESC LIMIT $limit ");
   $stat->execute();
  $rows= $stat->fetchAll();
   return $rows;
}

/**
 * Get All Data function v1.0
 * $select : The item to select [EX: * ]
 * $from : The Table to select from [EX: Users,Category,Products]
 */
function Get_All($select, $table){ 
    global$con;
    $stat=$con->prepare("SELECT $select FROM $table");
    $stat->execute();
    $rows=$stat->fetchAll();
    return $rows;
}


?>