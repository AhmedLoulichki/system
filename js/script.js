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

$(document).ready(function(){

	//check the width of the wrapper and the sidebar wrapper.
	var wrapper = $("#wrapper").outerWidth(true);
	var sidebar_wrapper = $("#sidebar_wrapper").outerWidth(true);
	
	//set the post wrapper width.
	var width = wrapper - sidebar_wrapper - 10 + "px";	
	$("#post_wrapper").css("width",width);

});