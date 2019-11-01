$(function(){

    'use strict';

    $('[placeholder]').focus(function(){

        $(this).attr('data-text',$(this).attr('placeholder'));
        $(this).attr('placeholder','');
    }).blur(function(){
        $(this).attr('placeholder',$(this).attr('data-text'));
    });

    $('.confirm').click(function(){

        return confirm('Are You Sure?');
    
    });

   $('.catagorie .header').click(function(){

    $(this).next('.catagorie .info').fadeToggel();

   });
/*
*option for view all data in catagories
*/
   /*$('.option span').click(function(){
       $(this).addclass('active').siblings('span').removeclass('active');
       if($(this).data('view')=='full'){
        $('.catagorie .list-group .info').fadeIn(500);
       }else{
        $('.catagorie .list-group .info').fadeOut(500);
       }
   });*/
});

