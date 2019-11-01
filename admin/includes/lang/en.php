<?php

function lang( $phrase ) {
    static $lang = array(
        'MESSAGE' =>'Welcome',
        'Admin'=>'Administrator',
        'home'=>'Home',
        'Categories'=>'Categories',
        'item'=>'Items',
        'member'=>'Members',
        'statistics'=>'Statistics',
        'ed-profile'=>'Edit Profile',
        'sitting'=>'Sittings',
        'logout'=>'Logout',
       

    );
    return $lang[$phrase];
}
?>