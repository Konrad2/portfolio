/*
this.imagePreview = function(){	
	
		xOffset = 10;
		yOffset = 30;
	
	$("a.preview").hover(function(e){
		this.t = this.title;
		this.title = "";	
		var c = (this.t != "") ? "<br/>" + this.t : "";
		
		
		
		$("body").append("<p id='preview'><img src='"+ this.href +"' alt='Image preview' />"+ c +"</p>");								 
		$("#preview")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px")
			.fadeIn("fast");						
    },
	function(){
		this.title = this.t;	
		$("#preview").remove();
    });	
	$("a.preview").mousemove(function(e){
		$("#preview")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px");
	});			
};
*/
/*
function lightBox(){
	
	
}
*/

var BASEURL ='portfolio';

function checkIfLoginExist(){	 
	
	var log = $("#login").val();	
	
	$.post("/createaccount/index/checklogin",{login:log},function(data){ 
		// 1 gdy login już istnieje 
		if  (data == 1 ){			
			//jeśli powiadonienie już istnieje nie wyświetlamy go ponownie
			if($('#loginExistMessage').length == 0){
				$('#login-element').append('<p id="loginExistMessage">Podany login już istnieje</p>');	
			}			
			$('#login').css('border-color','red');
			
		}else{
			$('#loginExistMessage').remove();
			$('#login').css('border-color','white');
		} 
		
	});
}

function makeBorderRed(name){
	
	
}

function pictShow(id){

	/*
	 var data;
	//$.post('/new/things/view/getmain', {"id" : id }, getPicture(data), "json");
	 $.post( BASEURL+'/things/view/getmain', {"id" : id },			 
			 function (data){
		 
		 var item = '.tresc#'+id;
		 
		 		var d = document;
		 
		 			var img = d.createElement("img");
		 			
		 			img.id = "pict";
		 			
		 			//$('#pict').mouseover(function (){ $.remove(); });
		 			
		 			//img.mouseover(function (){ $.remove(); });
		 			
		 			$(item ).append( '<img id="pict" src="' + data.pict + '"/>' );
		 			
		 			//$('img #pict').mouseover.remove();
		 			
	 		}, "json");
	 
	 */
	 
 };

 function pictDest( id ){
	 
	 $('#pict').remove();
//	 $('img #'+id).child('#'+id).remove();
	 
 }
 
 function getPicture(data){
	 
	//  $('#loading').remove();
    //  obj = window.eval(data);
   //   $('#textarea_id').val(obj['notes']);
      
	 alert (data.pict);
 }
 
 
 $(document).ready(

		 function()	{
			 
			// 

			// $('head').add('<script src="' + BASEURL + '/public/scripts/menuUpDown.js" type="text/javascript"></script>');
			 
		//	 var menu = Object.beget(menuUpDown);
			 var menu = new menuUpDown();
			 
			 menu.id = 'navigation';
			 
			 menu.ready();
			
			/*
			 $("ul.thumb li").hover(function() {
			 
			 	$(this).css({'z-index' : '10'}); 
			 	$(this).find('img').addClass("hover").stop() 
			 		.animate({
			 			marginTop: '-110px', 
			 			marginLeft: '-110px',
			 			top: '50%',
			 			left: '50%',
			 			width: '174px',
			 			height: '174px', 
			 			padding: '20px'
			 		}, 200); 

			 	} , function() {
			 	$(this).css({'z-index' : '0'}); 
			 	$(this).find('img').removeClass("hover").stop() 
			 		.animate({
			 			marginTop: '0', 
			 			marginLeft: '0',
			 			top: '0',
			 			left: '0',
			 			width: '100px', 
			 			 height: '100px', 
			 			padding: '5px'
			 		}, 400);
			 });
			 
			  $("ul.thumb li a").click(function() {

	                var mainImage = $(this).attr("href"); //Find Image Name
	               
	                $("#main_view img").attr({ src: mainImage });
	                return false;
	        });
*/
			  
		// efekt dodawania do koszyka	  
			  $(".button").click( 
					  function () {
					
						    var i = 1 - $(".button").index(this);
						    
						      $( this ).effect( "transfer", { to: "#cart"  }, 1000 );

					});

					   $("ul.navigation li").children().click(  function() {	$(this).next().toggle(500); });
			
		//ruuszajce menu
					   /*
						$(".navigation li").prepend("<span></span>"); //Throws an empty span tag right before the a tag

						$(".navigation li").each(function() { //For each list item...
							var linkText = $(this).find("a").html(); //Find the text inside of the <a> tag
							$(this).find("span").show().html(linkText); //Add the text in the <span> tag
						}); 

						$(".navigation li").hover(function() {	//On hover...
							$(this).find("span").stop().animate({
								
								marginTop: "-40" //Find the <span> tag and move it up 40 pixels
							}, 250);
						} , function() { //On hover out...
							$(this).find("span").stop().animate({
								marginTop: "0"  //Move the <span> back to its original state (0px 	)
							}, 250);
						});
						*/
		//left menu
						 
						$("#category ul").attr({ class: 'difrent' }); //Throws an empty span tag right before the a tag
						
						$(".difrent li").children("spam").remove();

					//	 imagePreview();
		 }
		 	 
	);	 
		

 
//	$("ul.kolumna").css({ 'width' : "100%"});
//	var colWrap = $("ul.kolumna").width();
//	var colNum = Math.floor(colWrap / 200);
//	var colFixed = Math.floor(colWrap / colNum);
//	$("ul.kolumna").css({ 'width' : colWrap});
//	$("ul.kolumna li").css({ 'width' : colFixed});
//}

//zmienneKolumny();
//$(window).resize(function () {
	//zmienneKolumny();
//});



