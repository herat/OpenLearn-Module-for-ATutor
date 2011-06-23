$(document).ready(function() {
	var cur_stus;
	
	//close all on default
	$('#accordion dd').hide();
	$('#accordion dt').attr('stus', '');
	       
	//open default data
	$('#accordion dd:eq(0)').slideDown();
	$('#accordion dt:eq(0)').attr('stus', 'active');

	$('#accordion dt').click(function(){
		cur_stus = $(this).attr('stus');
		if(cur_stus != "active")
		{
			//reset everthing - content and attribute
			$('#accordion dd').slideUp();
			$('#accordion dt').attr('stus', '');
			
			//then open the clicked data
			$(this).next().slideDown();
			$(this).attr('stus', 'active');
		}
		//Remove else part if do not want to close the current opened data
		else
		{
			$(this).next().slideUp();
			$(this).attr('stus', '');
		}
		return false;
	});
});
