<?php


/**
 * Create get Title Function v:1.0
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
 * Get Items function v1.0
 * $table: The table to select from[EX: users]
 * $Car_id: get items by Cat_id
 */

function Get_Items($Cat_id){
    global$con;
    $stat=$con->prepare("SELECT * FROM items where Cat_ID=?   ORDER BY I_ID DESC");
   $stat->execute(array($Cat_id));
  $rows= $stat->fetchAll();
   return $rows;
}

/**
 * Get categories function v1.0
 */

function Get_Category(){
    global$con;
    $stat=$con->prepare("SELECT * FROM categories ORDER BY C_ID ASC");
   $stat->execute();
  $rows= $stat->fetchAll();
   return $rows;
}
/**
 * Get categories function v1.0
 */

function CheckUserStates($user){
    global$con;
    $stat=$con->prepare("SELECT UserName,RegStatus FROM users where UserName=? and RegStatus=1");
   $stat->execute(array($user));
  $rows= $stat->fetchAll();
   return $rows;
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


?>