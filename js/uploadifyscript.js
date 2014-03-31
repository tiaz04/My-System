function doFormSubmitgallery() {
	// GRAB FIELDS VALUES AND SEND TO uploadify.php, YOU CAN DO WHATEVER YOU WANT WITH THEM IN uploadify.php FILE
	var myObjVars = {};
	$("form[id$=myForm] input").each(function () {
		switch ($(this)[0].type) {
			case "text":
				myObjVars[$(this)[0].id] = $(this).val();
			break;
		}
	});
	$('#gallery').uploadifySettings('postData', myObjVars);

	// UPLOAD IMAGES
	$('#gallery').uploadifyUpload();
}

function doFormSubmitfile() {
	// GRAB FIELDS VALUES AND SEND TO uploadify.php, YOU CAN DO WHATEVER YOU WANT WITH THEM IN uploadify.php FILE
	var myObjVars = {};
	$("form[id$=myForm] input").each(function () {
		switch ($(this)[0].type) {
			case "text":
				myObjVars[$(this)[0].id] = $(this).val();
			break;
		}
	});
	$('#file').uploadifySettings('postData', myObjVars);

	// UPLOAD IMAGES
	$('#file').uploadifyUpload();
}

function doFormSubmitvideo() {
	// GRAB FIELDS VALUES AND SEND TO uploadify.php, YOU CAN DO WHATEVER YOU WANT WITH THEM IN uploadify.php FILE
	var myObjVars = {};
	$("form[id$=myForm] input").each(function () {
		switch ($(this)[0].type) {
			case "text":
				myObjVars[$(this)[0].id] = $(this).val();
			break;
		}
	});
	$('#video').uploadifySettings('postData', myObjVars);

	// UPLOAD IMAGES
	$('#video').uploadifyUpload();
}

$(document).ready(function() {
	
	
	// Verify if Flash Player is Installed and if Flash Player version is 9 or higher
	if (!FlashDetect.versionAtLeast(9)) {
		// You can have an invisible DIV that contains an alternative form input box to upload files without uploadify, when Flash Detect Fails, you set it to visible and handle things the way you want, you can use this error control to do whatever you want if user has no Flash Player Inslalled.
		$("#gallery").html('You do not have Flash Player installed or your Flash Player is too old!<br>Please install Flash Player 9 or higher.');
		$("#video").html('You do not have Flash Player installed or your Flash Player is too old!<br>Please install Flash Player 9 or higher.');
		$("#file").html('You do not have Flash Player installed or your Flash Player is too old!<br>Please install Flash Player 9 or higher.');
	} else {
		$("#gallery").uploadify({
			// Required Settings
			langFile : baseAddress+'libraries/uploadify/uploadifyLang_it.js',
			swf : baseAddress+'libraries/uploadify/uploadify.swf',
			uploader : baseAddress+'libraries/uploadify/uploadify.php',

			// Options - HERE ARE ALL USEFUL OPTIONS, DON'T USE ANYTHING THAT ISN'T LISTED HERE
			'folder'          : uploadAddress,
			'createFolder'    : true,
			'debug'           : false, // DON'T SET THIS TO TRUE UNLESS YOU NEED TO SEE IF THERE IS ANY ERROR IN YOUR SCRIPT. IN YOUR SITE, JUST DON'T USE THIS OPTION AT ALL
			'auto'            : false,
			'width'           : "100%",
			'height'          : 30,
			'cancelImage'     : baseAddress+'libraries/uploadify/uploadify-cancel.png',
			'checkExisting'   : baseAddress+'libraries/uploadify/uploadify-check-exists.php',
			'fileSizeLimit'   : 100*1024, // 1MB
			'fileTypeDesc'    : 'Image Files',
			'fileTypeExts'    : '*.gif;*.jpg;*.png',
			'method'          : 'post',
			'multi'           : true,
			'queueID'         : 'fileQueue',
			'queueSizeLimit'  : 999,
			'removeCompleted' : true,
			'postData'        : {},
			'progressData'    : 'all',

			onSelect : function(file) {

			},

			onUploadSuccess : function(file,data,response) {
				$("#myForm").append("<input type='hidden' id='img_"+file.id+"_fileName' name='img_"+file.id+"_fileName' value='"+data+"' />"); // INSERT IMAGE FILENAME IN A HIDDEN FORM FIELD
			},

			onQueueComplete: function (stats) {
				$('#myForm').submit(); // THIS IS AN EXAMPLE, YOU CAN SUBMIT YOUR INFOS WITH AJAX IF YOU WANT
			}
		});
		$("#file").uploadify({
			// Required Settings
			langFile : baseAddress+'libraries/uploadify/uploadifyLang_it.js',
			swf : baseAddress+'libraries/uploadify/uploadify.swf',
			uploader : baseAddress+'libraries/uploadify/uploadify.php',

			// Options - HERE ARE ALL USEFUL OPTIONS, DON'T USE ANYTHING THAT ISN'T LISTED HERE
			'folder'          : uploadAddress,
			'createFolder'    : true,
			'debug'           : false, // DON'T SET THIS TO TRUE UNLESS YOU NEED TO SEE IF THERE IS ANY ERROR IN YOUR SCRIPT. IN YOUR SITE, JUST DON'T USE THIS OPTION AT ALL
			'auto'            : false,
			'width'           : "100%",
			'height'          : 30,
			'cancelImage'     : baseAddress+'libraries/uploadify/uploadify-cancel.png',
			'checkExisting'   : baseAddress+'libraries/uploadify/uploadify-check-exists.php',
			'fileSizeLimit'   : 100*1024, // 1MB
			'fileTypeDesc'    : 'Files',
			'fileTypeExts'    : '*.gif;*.jpg;*.png;*.doc;*.docx;*.xls;*.xlsx;*.pdf;*.ppt;*.pptx;*.zip;*.rar',
			'method'          : 'post',
			'multi'           : true,
			'queueID'         : 'fileQueue',
			'queueSizeLimit'  : 999,
			'removeCompleted' : true,
			'postData'        : {},
			'progressData'    : 'all',

			onSelect : function(file) {

			},

			onUploadSuccess : function(file,data,response) {
				$("#myForm").append("<input type='hidden' id='img_"+file.id+"_fileName' name='img_"+file.id+"_fileName' value='"+data+"' />"); // INSERT IMAGE FILENAME IN A HIDDEN FORM FIELD
			},

			onQueueComplete: function (stats) {
				$('#myForm').submit(); // THIS IS AN EXAMPLE, YOU CAN SUBMIT YOUR INFOS WITH AJAX IF YOU WANT
			}
		});
		$("#video").uploadify({
			// Required Settings
			langFile : baseAddress+'libraries/uploadify/uploadifyLang_it.js',
			swf : baseAddress+'libraries/uploadify/uploadify.swf',
			uploader : baseAddress+'libraries/uploadify/uploadify.php',

			// Options - HERE ARE ALL USEFUL OPTIONS, DON'T USE ANYTHING THAT ISN'T LISTED HERE
			'folder'          : uploadAddress,
			'createFolder'    : true,
			'debug'           : false, // DON'T SET THIS TO TRUE UNLESS YOU NEED TO SEE IF THERE IS ANY ERROR IN YOUR SCRIPT. IN YOUR SITE, JUST DON'T USE THIS OPTION AT ALL
			'auto'            : false,
			'width'           : "100%",
			'height'          : 30,
			'cancelImage'     : baseAddress+'libraries/uploadify/uploadify-cancel.png',
			'checkExisting'   : baseAddress+'libraries/uploadify/uploadify-check-exists.php',
			'fileSizeLimit'   : 300*1024, // 1MB
			'fileTypeDesc'    : 'Video Files',
			'fileTypeExts'    : '*.mp4;*.flv;*.mov',
			'method'          : 'post',
			'multi'           : true,
			'queueID'         : 'fileQueue',
			'queueSizeLimit'  : 999,
			'removeCompleted' : true,
			'postData'        : {},
			'progressData'    : 'all',

			onSelect : function(file) {

			},

			onUploadSuccess : function(file,data,response) {
				$("#myForm").append("<input type='hidden' id='img_"+file.id+"_fileName' name='img_"+file.id+"_fileName' value='"+data+"' />"); // INSERT IMAGE FILENAME IN A HIDDEN FORM FIELD
			},

			onQueueComplete: function (stats) {
				$('#myForm').submit(); // THIS IS AN EXAMPLE, YOU CAN SUBMIT YOUR INFOS WITH AJAX IF YOU WANT
			}
		});
	}
});