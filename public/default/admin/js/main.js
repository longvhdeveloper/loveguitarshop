$(function(){
    "use strict";

    $('.btn-delete').confirmation({
        'placement' : 'left',
        'popout' : true,
        'title' : 'Delete ?',
        'onConfirm' : function(){
            var url = $(this).attr('rel');
            location.href = url;
        }
    });

    if ($('.date-picker').length) {
        $('.date-picker').datepicker({
            format: 'yyyy-mm-dd',
        });
    }

    if ($("#" + menu + '-menu').length) {
        $("#" + menu + '-menu').addClass('active');
        $("#" + menu + '-menu').closest('.treeview').addClass('active');
        $("#" + menu + '-menu').closest('.treeview-menu').css('display','block');
        $("#" + menu + '-menu').closest('.treeview').find('.fa-angle-left').removeClass('fa-angle-left').addClass('fa-angle-down');
    }

});
