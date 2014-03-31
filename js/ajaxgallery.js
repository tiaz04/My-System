$(document).ready(function() {

$('.menu_ajaxgallery a').click(function(e){
    e.preventDefault();
	var id_gallery = $(this).attr("rel");
	$(this).parent().find(".active").removeClass("active");
	$(this).addClass("active");
	
	$('#ajaxgallery').load(baseAddress+'admin/gallery/ajaxgall_list/'+id_gallery, function() {
		  
		});
});





$('#ajaxgallery').on('click','a.ajgall_img',function(event){
    event.preventDefault();
	$(this).parent().parent().find(".active").removeClass("active");
	$(this).addClass("active");
	
	$('#ajaximageid').attr("value",$(this).attr("rel"));
});


$('.menu_ajaxfilegallery li').click(function(){
	var id_gallery = $(this).attr("rel");
	$(this).parent().find(".active").removeClass("active");
	$(this).addClass("active");
	
	$('#ajaxfilegallery').load(baseAddress+'admin/filegallery/ajaxgall_list/'+id_gallery, function() {
		  
		});
});
$('#ajaxfilegallery').on('click','a.ajgall_img',function(event){
event.preventDefault();
	
	$(this).parent().find(".active").removeClass("active");
	$(this).addClass("active");
	
	$('#ajaxfileid').attr("value",$(this).attr("rel"));

});


});
