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

?>