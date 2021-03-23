/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	 //config.language = 'fr';
	 //config.uiColor = '#AADC6E';
         config.toolbar = 'MyToolbar';
		 config.extraPlugins = 'uicolor';
         config.extraPlugins = 'MediaEmbed';
		config.toolbar_MyToolbar =
	[
		{ name: 'basicstyles', items : ['Source', 'Bold','Italic','Strike','-','RemoveFormat','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock' ]},
		{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
		{ name: 'editing', items : [ 'Find','Replace','Scayt' ] },		
		{ name: 'tools', items : [ 'Maximize' ] },
                '/',
		{ name: 'insert', items : [ 'Image','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe','MediaEmbed' ] },
		{ name: 'styles', items : [ 'Styles','Format'] }, 		
		{ name: 'colors',      items : [ 'TextColor','BGColor' ] },
		{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote' ] },
		{ name: 'links', items : [ 'Link','Unlink','Anchor' ] }
		
	];        
         config.filebrowserBrowseUrl = webpath+'ckfinder/browse.php?type=files';
         config.filebrowserImageBrowseUrl = webpath+'gears/admin/editor/ckfinder/browse.php?type=images';
         config.filebrowserFlashBrowseUrl = webpath+'/ckfinder/browse.php?type=flash';
         config.filebrowserUploadUrl = webpath+'ckfinder/upload.php?type=files';
         config.filebrowserImageUploadUrl = webpath+'ckfinder/upload.php?type=images';
         config.filebrowserFlashUploadUrl = webpath+'ckfinder/upload.php?type=flash';
        
};
