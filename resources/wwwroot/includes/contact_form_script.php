<!-- TinyMCE -->
<script type="text/javascript" src="scripts/editor/tiny_mce/tiny_mce.js" language="javascript"></script>
<script type="text/javascript" src="scripts/editor/tiny_mce/plugins/tinybrowser/tb_tinymce.js.php"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		skin : "o2k7",
		skin_variant : "black",
		height : "150",
		extended_valid_elements : "iframe[width|height|frameborder|scrolling|marginheight|marginwidth|src]",
		//invalid_elements : "strong,b,em,i",
		language : "en",
		editor_selector : "mceEditor",
		editor_deselector : "mceNoEditor",
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,spellchecker,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

		// Theme options
		theme_advanced_buttons1 : "cut,copy,paste,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,charmap,emotions,|,formatselect,|,fontselect,fontsizeselect, pasteword,code",
		theme_advanced_buttons2 : "",
		theme_advanced_buttons3 : "",
		theme_advanced_buttons4 : "",
		theme_advanced_buttons5 : "",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "center",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",
		file_browser_callback : "tinyBrowser",
		document_base_url : "http://localhost/",

		// Replace values for the template plugin
		template_replace_values : {
			username : "\"",
			staffid : ""
		}
	});
</script>
<!-- /TinyMCE -->
<script type="text/javascript">
$(document).ready(function(){
	$('#submit').click(function(){
		if($('#txtName').val() == ''){
			alert('Enter Name');
			return false;
		}
		if($('#txtAddress').val() == ''){
			alert('Enter Address');
			return false;
		}
		if($('#txtPhone').val() == ''){
			alert('Enter Phone');
			return false;
		}
		if($('#txtCountry').val() == ''){
			alert('Enter Country');
			return false;
		}
		if($('#txtEmail').val() == ''){
			alert('enter Email');
			return false;
		}
		if(tinyMCE.get('txtComment').getContent()=="" || tinyMCE.get('txtComment').getContent()==null){
			alert("Enter Comment");
			return false;
		}
	});
});
</script>