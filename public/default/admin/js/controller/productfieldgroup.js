$(document).ready(function(){
	loadajax();


    $(document).on('click', '#addgroup', function(){
        var template_row = $('#fieldlist .template_row');
        var count_row = $('#fieldlist tbody tr .fpfgnamenew').length;
        template_row.find('input[name*="fpgfdisplayordernew[]"]').attr('name', 'fpgfdisplayordernew['+count_row+']');
        template_row.find('input[name*="fpfgnamenew[]"]').attr('name', 'fpfgnamenew['+count_row+']');
        template_row.find('input[name*="fpfdisplayordernew[][]"]').attr('name', 'fpfdisplayordernew['+count_row+'][]');
        template_row.find('input[name*="fpfnamenew[][]"]').attr('name', 'fpfnamenew['+count_row+'][]');
        template_row.find('input[name*="fpfdatatypenew[][]"]').attr('name', 'fpfdatatypenew['+count_row+'][]');
        template_row.find('input[name*="fpfunitnew[][]"]').attr('name', 'fpfunitnew['+count_row+'][]');
        template_row.find('.addfield').attr('rel', count_row);
        $('#fieldlist tbody').append('<tr>' + template_row.html() + '</tr>');

        $('.delgroupfieldnew').confirmation({
            'placement' : 'bottom',
            'popout' : true,
            'title' : 'Delete ?',
            'onConfirm' : function(){
                $(this).parent().parent().parent().parent().remove();
            }
        });

        //reset template row
        template_row.find('input[name*="fpgfdisplayordernew['+count_row+']"]').attr('name', 'fpgfdisplayordernew[]');
        template_row.find('input[name*="fpfgnamenew['+count_row+']"]').attr('name', 'fpfgnamenew[]');
        template_row.find('input[name*="fpfdisplayordernew['+count_row+'][]"]').attr('name', 'fpfdisplayordernew[][]');
        template_row.find('input[name*="fpfnamenew['+count_row+'][]"]').attr('name', 'fpfnamenew[][]');
        template_row.find('select[name*="fpfdatatypenew['+count_row+'][]"]').attr('name', 'fpfdatatypenew[][]');
        template_row.find('input[name*="fpfunitnew['+count_row+'][]"]').attr('name', 'fpfunitnew[][]');
        template_row.find('.addfield').removeAttr('rel');
    });

    $(document).on('click', '.addfield', function(){
        var template_row = $('#fieldlist .template_row .pf');
        var id = $(this).attr('rel');

        template_row.find('input[name*="fpfdisplayordernew[][]"]').attr('name', 'fpfdisplayordernew['+id+'][]');
        template_row.find('input[name*="fpfnamenew[][]"]').attr('name', 'fpfnamenew['+id+'][]');
        template_row.find('select[name*="fpfdatatypenew[][]"]').attr('name', 'fpfdatatypenew['+id+'][]');
        template_row.find('input[name*="fpfunitnew[][]"]').attr('name', 'fpfunitnew['+id+'][]');

        $(this).before('<div class="row pf" style="margin-top:10px;">' + template_row.html() + '</div>');

        $('.delfieldnew').confirmation({
            'placement' : 'bottom',
            'popout' : true,
            'title' : 'Delete ?',
            'onConfirm' : function(){
                $(this).parent().parent().remove();
            }
        });

        //reset template row
        template_row.find('input[name*="fpfdisplayordernew['+id+'][]"]').attr('name', 'fpfdisplayordernew[][]');
        template_row.find('input[name*="fpfnamenew['+id+'][]"]').attr('name', 'fpfnamenew[][]');
        template_row.find('select[name*="fpfdatatypenew['+id+'][]"]').attr('name', 'fpfdatatypenew[][]');
        template_row.find('input[name*="fpfunitnew['+id+'][]"]').attr('name', 'fpfunitnew[][]');
    });

    $(document).on('click', '.addfieldg', function(){
        var template_row = $('#fieldlist .template_row .pf');
        var id = $(this).attr('rel');

        template_row.find('input[name*="fpfdisplayordernew[][]"]').attr('name', 'fpfdisplayorderg['+id+'][]');
        template_row.find('input[name*="fpfnamenew[][]"]').attr('name', 'fpfnameg['+id+'][]');
        template_row.find('select[name*="fpfdatatypenew[][]"]').attr('name', 'fpfdatatypeg['+id+'][]');
        template_row.find('input[name*="fpfunitnew[][]"]').attr('name', 'fpfunitg['+id+'][]');

        $(this).before('<div class="row pf" style="margin-top:10px;">' + template_row.html() + '</div>');

        $('.delfieldnew').confirmation({
            'placement' : 'bottom',
            'popout' : true,
            'title' : 'Delete ?',
            'onConfirm' : function(){
                $(this).parent().parent().remove();
            }
        });

        //reset template row
        template_row.find('input[name*="fpfdisplayorderg['+id+'][]"]').attr('name', 'fpfdisplayordernew[][]');
        template_row.find('input[name*="fpfnameg['+id+'][]"]').attr('name', 'fpfnamenew[][]');
        template_row.find('select[name*="fpfdatatypeg['+id+'][]"]').attr('name', 'fpfdatatypenew[][]');
        template_row.find('input[name*="fpfunitg['+id+'][]"]').attr('name', 'fpfunitnew[][]');
    });

    $('#my_form').submit(function(event){
        event.preventDefault();
        var pcid = $("#fpcid").val();
        var dataString = $('#my_form').serialize().replace(/%5B%5D/g, '[]');

        $.ajax({
            type: 'post',
            dataType: 'json',
            url : baseUrl + 'admin/productfieldgroup/detailjson/' + pcid,
            data: dataString,
            success: function(jsondata){
                if (jsondata.error !== '') {
                    $('.error').html('<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+jsondata.error+'</div>');
                }

                if (jsondata.success == '1') {
                    location.href = baseUrl + 'admin/productcategory';
                }
            }
        });
    });
});

function loadajax()
{
	var pcid = $('#fpcid').val();

	$('#content-data').load(baseUrl + 'admin/productfieldgroup/loadajax/'+pcid, function(){

		$('.delgroupfield').confirmation({
	        'placement' : 'bottom',
	        'popout' : true,
	        'title' : 'Delete ?',
	        'onConfirm' : function(){
	            var pfgid = $(this).attr('rel');

	            $.ajax({
	                type: 'post',
	                dataType: 'json',
	                url : baseUrl + 'admin/productfieldgroup/deletefieldgroupajax/' + pfgid,
	                success: function(jsondata){
	                    if (jsondata.success == '1') {
	                    	loadajax();
	                        setTimeout(function() {
	                            $.bootstrapGrowl("Delete field group success.", { type: 'success' });
	                        }, 100);
	                    } else {
	                        setTimeout(function() {
	                            $.bootstrapGrowl("Delete field group error.", { type: 'error' });
	                        }, 100);
	                    }
	                }
	            });
	        }
	    });

		$('.delfield').confirmation({
	    	'placement' : 'bottom',
	        'popout' : true,
	        'title' : 'Delete ?',
	        'onConfirm' : function(){
	        	var pfid = $(this).attr('rel');
	        	$.ajax({
	                type: 'post',
	                dataType: 'json',
	                url : baseUrl + 'admin/productfieldgroup/deletefieldajax/' + pfid,
	                success: function(jsondata){
	                    if (jsondata.success == '1') {
	                    	loadajax();
	                        setTimeout(function() {
	                            $.bootstrapGrowl("Delete field success.", { type: 'success' });
	                        }, 100);
	                    } else {
	                        setTimeout(function() {
	                            $.bootstrapGrowl("Delete field error.", { type: 'error' });
	                        }, 100);
	                    }
	                }
	            });
	        }
	    });

	});
}