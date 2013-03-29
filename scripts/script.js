$(function() {

	// Some important vars!
	var URL = 	"http://202.164.53.122/~vigasdeep/pabwalo/index.php";
	var popup = false;
	var oldBook = "none";
     var validator = "";
    var rules={};
    var messages={};


    $(document).ready(function () {
        // 1. prepare the validation rules and messages.
        rules = {

            booking: "required",
            
            
        };
        messages = {
          
            booking: "option is requried",
            
        };

        // 2. Initiate the validator
        
       validator = new jQueryValidatorWrapper("contact-form",rules, messages);

    });
       


// Starting config for booking page!!
$('.BusField').animate({opacity:0.0,height:0, paddingTop:0, paddingBottom:0, marginBottom:0},1);
$('.DoctorField').animate({opacity:0.0,height:0, paddingTop:0, paddingBottom:0, marginBottom:0},1);
$('.PatientField').animate({opacity:0.0,height:0, paddingTop:0, paddingBottom:0, marginBottom:0},1);
//$('.LocationField').animate({opacity:0.0,height:0, paddingTop:0, paddingBottom:0, marginBottom:0,marginTop:0},1);
//$(".LocationField td").animate({marginTop:0},1000);
// Booking config ends here !!

    changeLike();
/*

Job form, change function for type of form to be displayed, manual or scanned.


   */
$('#type').change(function(){
	var typeVal=$('input:radio[name=type]:checked').val();
	if(typeVal==0){
		$('#manual').fadeOut();
		$('#scanned').delay(400).fadeIn();
	}
	if(typeVal==1){
		$('#scanned').fadeOut();
		$('#manual').delay(400).fadeIn();
	}
});
/*
 type change function END
   */

$('.rightBox').click(function(){
	window.location = URL+"/booking";
});

$("#booking").change(function(){
    var value= $(this).val().replace(/ /g,"");
	//$("#blah").html("*"+value+"-"+oldBook+"*");
	if(oldBook != "none"){
		hideOldMenu(oldBook,value);
	}else{
		showMenu(value);
	}    	
    return false; //prevent default browser action
});

$("#Docselfapp").click(function(){
    var value= $(this).val();
	if(value == "No"){
		$('.DoctorField').animate({height:265},1000);
		$('.PatientField').animate({opacity:1.0,height:25, paddingTop:0, paddingBottom:0, marginBottom:10},1000);
	}else{
		$('.DoctorField').animate({height:195},1000);
		$('.PatientField').animate({opacity:0.0,height:0, paddingTop:0, paddingBottom:0, marginBottom:0},1000);
	}    	
    return false; //prevent default browser action
});

$('#accommodationType').change(function(){
	$('#accommodation').attr('disabled','disabled');
	/*if($(this).val() == "0"){
		$(".LocationField").animate({opacity:1.0,height:25, paddingTop:0, paddingBottom:0, marginBottom:10},1000);
		$(".LocationField td").animate({marginTop:10},1000);
	}else{
		$(".LocationField").animate({opacity:0.0,height:0, paddingTop:0, paddingBottom:0, marginBottom:0,marginTop:0},1000);
		$(".LocationField td").animate({marginTop:0},1000);
	}*/
	fetchHotels();
});

$('#location').change(function(){
	$('#accommodation').attr('disabled','disabled');
	fetchHotels();
});

$('#restaurantType').change(function(){
	$('#restaurant').attr('disabled','disabled');
	fetchRes();
});

$("#button").click(function(){
	if(popup == false){
		$("#overlayEffect").fadeIn("slow");
		$("#popupContainer").fadeIn("slow");
		$("#close").fadeIn("slow");
	    center();
		popup = true;
	}
    	
});
	
$("#close").click(function(){
	hidePopup();
});
	
$("#overlayEffect").click(function(){
	hidePopup();
});


$("#buttonBooking").click(function(){
    
    if($('#booking option:selected').val()=="Bus"){
        
        var ruless = {

            
            company: "required",
            date: "required",
            time: "required",
            journey: "required",
            pessengers: "required"
            
        };
         var messagess = {
          
            company: "Company is required",
            date: "Date is required",
            time: "Time required",
            journey: "Journey is required",
            pessengers: "Passengers is required"
        };

        // 2. Initiate the validator
        
       
     validator = new jQueryValidatorWrapper("contact-form",ruless, messagess);    
    }
    
   
    var check = validator.validate();
    if (!check){
        alert("aaya "+check);
                return;
    }
        

    
	$("#overlayEffectBooking").fadeIn("slow");
	$("#popupContainerBooking").fadeIn("slow");
	$("#closeBooking").fadeIn("slow");
	var windowWidth = document.documentElement.clientWidth;
	var windowHeight = document.documentElement.clientHeight;
	var popupHeight = $("#popupContainerBooking").height();
	var popupWidth = $("#popupContainerBooking").width();
	$("#popupContainerBooking").css({
		"position": "absolute",
		"top": windowHeight/2-popupHeight/2,
		"left": windowWidth/2-popupWidth/2
	});

	$("#closeBooking").click(function(){
		$("#overlayEffectBooking").fadeOut("slow");
		$("#popupContainerBooking").fadeOut("slow");
		$("#closeBooking").fadeOut("slow");
	});

	$("#overlayEffectBooking").click(function(){
		$("#overlayEffectBooking").fadeOut("slow");
		$("#popupContainerBooking").fadeOut("slow");
		$("#closeBooking").fadeOut("slow");
	});




});

$("#buttonLogin").click(function(){
	if(popup == false){
		$("#overlayEffectLogin").fadeIn("slow");
		$("#popupContainerLogin").fadeIn("slow");
		$("#closeLogin").fadeIn("slow");
	    centerLogin();
		popup = true;
	}	
	});
	
	$("#closeLogin").click(function(){
		hidePopupLogin();
	});
	
	$("#overlayEffectLogin").click(function(){
		hidePopupLogin();
	});


$("#company").change(function(){
	if($(this).val() != ""){
		showCompanyOverview("Bus","id",$(this).val());
	}else{
		showOverview("Bus");
	}

});

$("#hospital").change(function(){
	if($(this).val() != ""){
		showCompanyOverview("Hospital","id",$(this).val());
	}else{
		showOverview("Doctor");
	}

});

$("#accommodation").change(function(){
	if($(this).val() != ""){
		showCompanyOverview("Accommodation","id",$(this).val());
	}else{
		showOverview("Accommodation");
	}

});

$("#restaurant").change(function(){
	if($(this).val() != ""){
		showCompanyOverview("Restaurant","id",$(this).val());
	}else{
		showOverview("Restaurant");
	}

});


$("#searchField").focus(function(){
	$(this).css('color','#333333');
	if($(this).val() == "Search here..."){
		$(this).val('');
	}
});

$("#searchField").blur(function(){
	$(this).css('color','#cccccc');
	if($(this).val() == ""){
		$(this).val('Search here...');
	}
});









function showMenu(value){
	var h = 0;
	if(value == "Bus") h = 195;
	else if(value == "Doctor"){ h = 195; if($('#Docselfapp').val()== "No") h=265;
	}else if(value == "Accommodation") h = 265; 
	else if(value == "Restaurant") h = 195;
	$('.'+value+'Field').animate({opacity:1.0,height:h,marginTop:10,display:"block",marginBottom:5},1000); 
	showOverview(value);
	oldBook = value;
}

function hideOldMenu(old, value){
	$('.'+old+'Field').animate({opacity:0.0,height:0, paddingTop:0, paddingBottom:0, marginTop:0,display:"inline-block",marginBottom:0},1000, function(){ showMenu(value); }); 
}

function showOverview(value){
	$.post(URL+"/booking/fetchPageOverview",
		{'id':value},
		function(data){
			$('#overviewBooking').animate({opacity:0.0},function(){
				$('#overviewBooking').html(data);
				$('#overviewBooking').animate({opacity:1.0});
			});

		}
	);
}

function showCompanyOverview(table,key,val){
	$.post(URL+"/booking/fetchCompanyOverview",
		{'table':table,'key':key,'val':val},
		function(data){
			$('#overviewBooking').animate({opacity:0.0},function(){
				$('#overviewBooking').html(data);
				$('#overviewBooking').animate({opacity:1.0});
			});

		}
	);
}

function fetchHotels(){
	var accom = $('#accommodationType').val();
	var loc = $('#location').val();
	$.post(URL+"/booking/fetchHotels",
		{'hotelType':accom,'location':loc},
		function(data){
			$('#accommodation').parent().html(data);
			$("#accommodation").change(function(){
	if($(this).val() != ""){
		showCompanyOverview("Accommodation","id",$(this).val());
	}else{
		showOverview("Accommodation");
	}

});
		}
	);
}

function fetchRes(){
	var res = $('#restaurantType').val();
	$.post(URL+"/booking/fetchRes",
		{'val':res},
		function(data){
			$('#restaurant').parent().html(data);
			$("#restaurant").change(function(){
	if($(this).val() != ""){
		showCompanyOverview("Restaurant","id",$(this).val());
	}else{
		showOverview("Restaurant");
	}

});
		}
	);
}
	
function center(){
	var windowWidth = document.documentElement.clientWidth;
	var windowHeight = document.documentElement.clientHeight;
	var popupHeight = $("#popupContainer").height();
	var popupWidth = $("#popupContainer").width();
	$("#popupContainer").css({
		"position": "absolute",
		"top": windowHeight/2-popupHeight/2,
		"left": windowWidth/2-popupWidth/2
	});
	
	}
function hidePopup(){
	if(popup==true){
		$("#overlayEffect").fadeOut("slow");
		$("#popupContainer").fadeOut("slow");
		$("#close").fadeOut("slow");
		popup = false;
	}
}
//adsssssssssssssssss
	
function centerLogin(){
	var windowWidth = document.documentElement.clientWidth;
	var windowHeight = document.documentElement.clientHeight;
	var popupHeight = $("#popupContainerLogin").height();
	var popupWidth = $("#popupContainerLogin").width();
	$("#popupContainerLogin").css({
		"position": "absolute",
		"top": windowHeight/2-popupHeight/2,
		"left": windowWidth/2-popupWidth/2
	});
	
}

function hidePopupLogin(){
	if(popup==true){
		$("#overlayEffectLogin").fadeOut("slow");
		$("#popupContainerLogin").fadeOut("slow");
		$("#closeLogin").fadeOut("slow");
		popup = false;
	}
}


} ,jQuery);



var number = 0;
var likes = ["Bus Travel", "Appointments", "Hotels", "Parties","Guest House","Restaurant"];

  
function changeLike(){
	number++;
	if(number > 5){number=0;}
	$("#bookOther").animate({opacity:0.0},function(){
		$("#bookOther").html(likes[number]);
		$("#bookOther").animate({opacity:0.8},function(){
			setTimeout('changeLike()',3000);
		});
	});
}
