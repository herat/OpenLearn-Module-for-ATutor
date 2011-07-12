/*
 *This javascript file uses jQuery framework. It will format data into an accordion.
 *It uses following html format
 *<dl id="accordion">
 *   <dt> <input src="" title="" alt="" /><a> </a></dt>
 *   <dd> Data goes here </dd>
 *</dl>
 */
$(document).ready(function() {
	var cur_stus;//current status of a link
	
	//close all on default
	$('#accordion dd').hide();
	$('#accordion dt a').attr('stus', '');
	$('#accordion dt input').each(function(index) {
		$(this).attr('src', 'mods/ol_search_open_learn/plus.gif');
		$(this).attr('alt', 'Open: '+$(this).next().text());
		$(this).attr('title', 'Open: '+$(this).next().text());
  	});
	       
	//open default data
	$('#accordion dd:eq(0)').slideDown();
	$('#accordion dt:eq(0) a').attr('stus', 'active');
	$('#accordion dt:eq(0) input').each(function(index) {
		$(this).attr('src', 'mods/ol_search_open_learn/minus.gif');
		$(this).attr('alt', 'Close: '+$(this).next().text());
		$(this).attr('title', 'Close: '+$(this).next().text());
	});
        
        //open or close a section based on clicked <A> 
	$('#accordion dt > a').click( function(event){
		cur_stus = $(this).attr('stus');
				
		if(cur_stus != "active")
		{
			//reset everthing - content and attribute
			$('#accordion dd').slideUp();
			$('#accordion dt a').attr('stus', '');
			$('#accordion dt input').each(function(index) {
    			$(this).attr('src', 'mods/ol_search_open_learn/plus.gif');
				$(this).attr('alt', 'Open: '+$(this).next().text());
				$(this).attr('title', 'Open: '+$(this).next().text());
  			});
			
			//then open the clicked data
			$(this).parents('dt:first').next().slideDown();
			$(this).attr('stus', 'active');
			$(this).prev().attr('src', 'mods/ol_search_open_learn/minus.gif');
			$(this).prev().attr('alt', 'Close: '+$(this).text());
			$(this).prev().attr('title', 'Close: '+$(this).text());
		}
		//Remove else part if do not want to close the current opened data
		else
		{
			$(this).parents('dt:first').next().slideUp();
			$(this).attr('stus', '');
			$(this).prev().attr('src', 'mods/ol_search_open_learn/plus.gif');
			$(this).prev().attr('alt', 'Open: '+$(this).text());
			$(this).prev().attr('title', 'Open: '+$(this).text());
		}
		return false;
	});
	
	//open or close a section based on clicked image
	$('#accordion dt > input').click( function(event){
		cur_stus = $(this).next().attr('stus');
				
		if(cur_stus != "active")
		{
			//reset everthing - content and attribute
			$('#accordion dd').slideUp();
			$('#accordion dt a').attr('stus', '');
			$('#accordion dt input').each(function(index) {
    			$(this).attr('src', 'mods/ol_search_open_learn/plus.gif');
				$(this).attr('alt', 'Open: '+$(this).next().text());
				$(this).attr('title', 'Open: '+$(this).next().text());
  			});
			
			//then open the clicked data
			$(this).parents('dt:first').next().slideDown();
			$(this).next().attr('stus', 'active');
			$(this).attr('src', 'mods/ol_search_open_learn/minus.gif');
			$(this).attr('alt', 'Close: '+$(this).next().text());
			$(this).attr('title', 'Close: '+$(this).next().text());
		}
		//Remove else part if do not want to close the current opened data
		else
		{
			$(this).parents('dt:first').next().slideUp();
			$(this).next().attr('stus', '');
			$(this).attr('src', 'mods/ol_search_open_learn/plus.gif');
			$(this).attr('alt', 'Open: '+$(this).next().text());
			$(this).attr('title', 'Open: '+$(this).next().text());
		}
		return false;
	});
	
});

