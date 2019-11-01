<?php

function lang( $phrase ) {
    static $lang = array(
        'MESSAGE' =>'مرحبا',
        'Admin'=>'المدير'
    );
    return $lang[$phrase];
}
?>