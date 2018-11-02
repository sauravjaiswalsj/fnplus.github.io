var time = new Array(4);
var remote_url = "http://srmapi-hmm.rhcloud.com/";

$(document).ready(function(){	

	$('#get_info .btn').click(function(){		
		$(this).addClass('disabled').find('i').fadeIn();
		var register = $('#get_info').find('input[name=regno]').val();
		var password = $('#get_info').find('input[name=pass]').val();
		$('#get_info div.json_response_failure').hide();
		$('#get_info div.json_response_success').hide();		
		time[0] = new Date().getTime();
		$.post('get-info.php',{regno:register,pass:password},function(data){				
	 		if(data.error)	 		{	
	 			var div = '#get_info div.json_response_failure';
	 			$(div).find('.error').html(data.error);
 				$(div).find('.code').html(data.code);
	 			$(div).fadeIn();
	 		}
	 		else
	 		{
	 			var div = '#get_info div.json_response_success';
	 			$(div).find('.name').html(data.name);
	 			$(div).find('.regno').html(data.regno);
	 			$(div).find('.course').html(data.course);
	 			$(div).find('.studentid').html(data.studentid);
	 			$(div).find('.semester').html(data.semester);
	 			$(div).find('.year').html(data.year);
	 			$(div).find('.email').html(data.email);
	 			$(div).find('.dob').html(data.dob);
	 			$(div).find('.sex').html(data.sex);
	 			$(div).find('.address').html(data.address);
	 			$(div).find('.pincode').html(data.pincode);
	 			$(div).find('.error').html('false');
	 			$(div).fadeIn();
	 		}
	 		
	 		$('#get_info .btn').removeClass('disabled').find('i').fadeOut(function(){	 			
	 			time[0] = (new Date().getTime() - time[0])/1000;
	 			var div = '#get_info';
	 			$(div).find('.time').html(time[0]+'s');	 				 			
	 		});	 		
		},"json");
	});


	$('#get_tt .btn').click(function(){		
		$(this).addClass('disabled').find('i').fadeIn();
		var register = $('#get_tt').find('input[name=regno]').val();
		var password = $('#get_tt').find('input[name=pass]').val();
		$('#get_tt div.json_response_failure').hide();
		$('#get_tt div.json_response_success').hide();
		time[1] = new Date().getTime();
		$.post('get-tt.php',{regno:register,pass:password},function(data){		
			
	 		if(data.error)	 		{	
	 			var div = '#get_tt div.json_response_failure';
	 			$(div).find('.error').html(data.error);
	 			$(div).find('.code').html(data.code);
	 			$(div).fadeIn();
	 		}
	 		else
	 		{
	 			var div = '#get_tt div.json_response_success';	 			
	 			$(div).find('.monday').html(data.monday.join());
	 			$(div).find('.tuesday').html(data.tuesday.join());
	 			$(div).find('.wednesday').html(data.wednesday.join());
	 			$(div).find('.thursday').html(data.thursday.join());
	 			$(div).find('.friday').html(data.friday.join());
	 			$(div).find('.error').html('false');	 			
	 			$(div).fadeIn();
	 		}
	 		$('#get_tt .btn').removeClass('disabled').find('i').fadeOut(function(){
	 			time[1] = (new Date().getTime() - time[1])/1000;
	 			var div = '#get_tt';
	 			$(div).find('.time').html(time[1]+'s');	 				 			
	 		});	 		
		},"json");
	});

	$('#get_check .btn').click(function(){		
		$(this).addClass('disabled').find('i').fadeIn();
		var register = $('#get_check').find('input[name=regno]').val();
		var password = $('#get_check').find('input[name=pass]').val();
		$('#get_check div.json_response_failure').hide();
		$('#get_check div.json_response_success').hide();
		time[2] = new Date().getTime();
		$.post('get-check.php',{regno:register,pass:password},function(data){			
			
	 		if(data.error)	 		{	
	 			var div = '#get_check div.json_response_failure';
	 			$(div).find('.error').html(data.error);
	 			$(div).find('.code').html(data.code);
	 			$(div).fadeIn();
	 		}
	 		else
	 		{
	 			var div = '#get_check div.json_response_success';	 				 		
	 			$(div).fadeIn();
	 		}
	 		$('#get_check .btn').removeClass('disabled').find('i').fadeOut(function(){
	 			time[2] = (new Date().getTime() - time[2])/1000;
	 			var div = '#get_check';
	 			$(div).find('.time').html(time[2]+'s');	 				 			
	 		});	 		
		},"json");
	});


	$('#get_attd .btn').click(function(){		
		$(this).addClass('disabled').find('i').fadeIn();
		var register = $('#get_attd').find('input[name=regno]').val();
		var password = $('#get_attd').find('input[name=pass]').val();
		$('#get_attd div.json_response_failure').hide();
		$('#get_attd div.json_response_success').hide().html('');		
		time[3] = new Date().getTime();
		$.post('get-attd.php',{regno:register,pass:password},function(data){			
			window.text = data;	 		if(data.error){	
	 			var div = '#get_attd div.json_response_failure';
	 			$(div).find('.error').html(data.error);
	 			$(div).find('.code').html(data.code);
	 			$(div).fadeIn();
	 		}
	 		else
	 		{
	 			var div = '#get_attd div.json_response_success';
	 			$(div).append("{ <br />");
	 			for(var i=0;i<data.subjects.length;i++)
	 			{	
		 			if(data[data.subjects[i]])
		 			{
		 				$(div).append("&nbsp;&nbsp;<strong>"+data.subjects[i]+"</strong> : { <br />");
		 				$(div).append("&nbsp;&nbsp;&nbsp;&nbsp;<strong>sub-desc</strong> : <span class=\"error text-success\">"+data[data.subjects[i]]['sub-desc']+"</span>,<br/>");
		 				$(div).append("&nbsp;&nbsp;&nbsp;&nbsp;<strong>max-hrs</strong> : <span class=\"error text-success\">"+data[data.subjects[i]]['max-hrs']+"</span>,<br/>");
		 				$(div).append("&nbsp;&nbsp;&nbsp;&nbsp;<strong>attd-hrs</strong> : <span class=\"error text-success\">"+data[data.subjects[i]]['attd-hrs']+"</span>,<br/>");
		 				$(div).append("&nbsp;&nbsp;&nbsp;&nbsp;<strong>abs-hrs</strong> : <span class=\"error text-success\">"+data[data.subjects[i]]['abs-hrs']+"</span>,<br/>");
		 				$(div).append("&nbsp;&nbsp;&nbsp;&nbsp;<strong>avg-attd</strong> : <span class=\"error text-success\">"+data[data.subjects[i]]['avg-attd']+"</span><br/>");
		 				$(div).append("&nbsp;&nbsp;}<br/>");
		 			}
		 			
	 			}
	 			$(div).append("}");	
	 			$(div).append("<br/><strong>Time </strong><span class=\"time muted\"></span>"); 			
	 			$(div).fadeIn();	 			
	 		}
	 		$('#get_attd .btn').removeClass('disabled').find('i').fadeOut(function(){
	 			time[3] = (new Date().getTime() - time[3])/1000;
	 			var div = '#get_attd';
	 			$(div).find('.time').html(time[3]+'s');	 				 			
	 		});
		},"json");
	});

});