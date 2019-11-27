<?php

function lang( $phrase ) {
    static $lang = array(
        'MESSAGE' =>'مرحبا',
        'Admin'=>'المدير',
        'comment'=>'التعليقات'
    );
    return $lang[$phrase];
}
?>