	
function menu () {	
	
	menu.prototype.id = "navigation";
}


function menuUpDown(){
	
	this.prototype = new menu();
	
					this.ready = function (){
						
						$('.' + this.id + ' li').prepend("<span></span>"); //Throws an empty span tag right before the a tag
	
							$('.' + this.id + ' li').each(function() { //For each list item...
								var linkText = $(this).find("a").html(); //Find the text inside of the <a> tag
								$(this).find("span").show().html(linkText); //Add the text in the <span> tag
							}); 
	
							$('.' + this.id + ' li').hover(function() {	//On hover...
								$(this).find("span").stop().animate({
									
									marginTop: "-40" //Find the <span> tag and move it up 40 pixels
								}, 250);
							} , function() { //On hover out...
								$(this).find("span").stop().animate({
									marginTop: "0"  //Move the <span> back to its original state (0px 	)
								}, 250);
							});
					}
					
						
}