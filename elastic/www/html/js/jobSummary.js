/**
 * Nikita Yaroshevich 24.08.2011
 */

var jobSummary =
{	
	init : function(){},	
        
        showLog: function(e){
		var val = $(e).parent().find('.tooltip-value').html().trim();
                $.ajax({
			type: "GET",
			url: '/jobSummary/'+val,
			dataType: "html",			
			success: function (r)
			{
				$(r).appendTo("body");
			}		
		});
	},
}