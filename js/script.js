$(document).ready(function(){

	set_post_width();
	
	input_help();
});

function input_help(){

	//This is done for every input element with the "required" attribute.
	//Grabs the info in the "rel" attribute and adds a span (with the class "hidden"), with the info in.
	$("input[required]").each(function(){
		var title = $(this).attr("placeholder");
		$(this).after("<span class='hidden'> <- "+title+"</span>");
		console.log(title);
	//When a input element is focused the class "hidden" is removed and the info inside the element becomes visible.
	}).focus(function(){
		$(this).next().removeClass("hidden");
		console.log(this);
	//When a input element is no longer focused the class "hidden" is added again and the info inside the element becomes invisible.
	}).focusout(function(){
		$(this).next().addClass("hidden");
	});
}

function set_post_width(){

	//check the width of the wrapper and the sidebar wrapper.
	var wrapper = $("#wrapper").outerWidth(true);
	var sidebar_wrapper = $("#sidebar_wrapper").outerWidth(true);
	
	//set the post wrapper width.
	var width = wrapper - sidebar_wrapper - 50 + "px";
	$(".post").css("width",width);
}

//confirm function for deleting posts.
function delete_post(id){
	
	var answer = confirm("Are you sure you want to delete this post?");
	
	if(answer){
		window.location = "?delete_post_id=" + id;
	}
}

//confirm function for logging out.
function logout(){

	var answer = confirm("Are you sure you want to logout?");
	
	if(answer){
		window.location = "?status=loggedout";
	}
}
