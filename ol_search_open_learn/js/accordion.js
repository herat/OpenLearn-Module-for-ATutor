/****************************************************************/
/* OpenLearn module for ATutor                                  */
/* http://atutoropenlearn.wordpress.com                         */
/*                                                              */
/* This module allows to search OpenLearn for educational       */
/* content.														*/
/* Author: Herat Gandhi											*/
/* This program is free software. You can redistribute it and/or*/
/* modify it under the terms of the GNU General Public License  */
/* as published by the Free Software Foundation.				*/
/****************************************************************/

/**
 * This javascript file uses jQuery framework. It will format data into 
 * an accordion.
 * It uses following html format:
 * <dl id="accordion">
 *   <dt> <input src="" title="" alt="" /><a> </a></dt>
 *   <dd> Data goes here </dd>
 * </dl>
 */
 
 /**
  * Initialize Accordion
  *
  * This function sets accordion when page is loaded. It opens first 
  * content panel and hides all other content panels.
  * 
  */

$(document).ready(function() {
	var cur_stus;//current status of a link
	var n = 0;

	var openval = document.getElementById("opentip").value;
	var closeval = document.getElementById("closetip").value;

 	//focus on anchor just before search results
	$('#focus_here').focus();	

	//close all on default
	$('#accordion dd').hide();//hide all content
	$('#accordion dt a').attr('stus', '');//set stus attribute to null to indicate panel is closed
	$('#accordion dt input').each(function(index) {
		$(this).attr('src', 'mods/ol_search_open_learn/images/plus.gif'); //set image of '+' to all closed panels
		$(this).attr('alt', openval +$(this).next().text()); //alt attribute is set to "open"+ title of particular result
		$(this).attr('title', openval+$(this).next().text()); //title attribute is set to "open"+ title of particular result
  	});
	       
	//open default data
	$('#accordion dd:eq('+n+')').slideDown();//open first panel
	$('#accordion dt:eq('+n+') a').attr('stus', 'active');//set stus to indicate panel is open
	$('#accordion dt:eq('+n+') input').each(function(index) {
		$(this).attr('src', 'mods/ol_search_open_learn/images/minus.gif'); //set image of '-' to show panel is open
		$(this).attr('alt', closeval +$(this).next().text()); //alt attribute is set to "close"+ title of first result
		$(this).attr('title', closeval +$(this).next().text()); //title attribute is set to "close"+ title of first result
	});
        
    //open or close a section based on clicked <A> 
	$('#accordion dt > a').click( function(event){
		cur_stus = $(this).attr('stus'); //get status of focused section
				
		//focused section is currently closed	
		if(cur_stus != "active")
		{
			//reset everthing - content and attribute
			$('#accordion dd').slideUp();
			$('#accordion dt a').attr('stus', '');
			$('#accordion dt input').each(function(index) {
    			$(this).attr('src', 'mods/ol_search_open_learn/images/plus.gif');
				$(this).attr('alt', openval+$(this).next().text());
				$(this).attr('title', openval+$(this).next().text());
  			});
			
			//then open the clicked data
			$(this).parents('dt:first').next().slideDown();
			$(this).attr('stus', 'active');
			$(this).prev().attr('src', 'mods/ol_search_open_learn/images/minus.gif');
			$(this).prev().attr('alt', closeval+$(this).text());
			$(this).prev().attr('title', closeval+$(this).text());
		}
		//Remove else part if do not want to close the current opened data
		else
		{
			$(this).parents('dt:first').next().slideUp();
			$(this).attr('stus', '');
			$(this).prev().attr('src', 'mods/ol_search_open_learn/images/plus.gif');
			$(this).prev().attr('alt', openval+$(this).text());
			$(this).prev().attr('title', openval+$(this).text());
		}
		return false; //false is returned to prevent browser to change URL
	});
	
	//open or close a section based on clicked image
	$('#accordion dt > input').click( function(event){
		cur_stus = $(this).next().attr('stus'); //get status of focused section
				
		if(cur_stus != "active")
		{
			//reset everthing - content and attribute
			$('#accordion dd').slideUp();
			$('#accordion dt a').attr('stus', '');
			$('#accordion dt input').each(function(index) {
    			$(this).attr('src', 'mods/ol_search_open_learn/images/plus.gif');
				$(this).attr('alt', openval+$(this).next().text());
				$(this).attr('title', openval+$(this).next().text());
  			});
			
			//then open the clicked data
			$(this).parents('dt:first').next().slideDown();
			$(this).next().attr('stus', 'active');
			$(this).attr('src', 'mods/ol_search_open_learn/images/minus.gif');
			$(this).attr('alt', closeval+$(this).next().text());
			$(this).attr('title', closeval+$(this).next().text());
		}
		//Remove else part if do not want to close the current opened data
		else
		{
			$(this).parents('dt:first').next().slideUp();
			$(this).next().attr('stus', '');
			$(this).attr('src', 'mods/ol_search_open_learn/images/plus.gif');
			$(this).attr('alt', openval+$(this).next().text());
			$(this).attr('title', openval+$(this).next().text());
		}
		return false; //false is returned to prevent page to change URL
	});
	
});

