/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */
CKEDITOR.editorConfig = function(config) {

    // Define changes to default configuration here. For example:
    // config.language = 'fr';
    // config.uiColor = '#AADC6E';

    /**
     * KcFinder Browse Settings
     * @type {[type]}
     */
    config.filebrowserBrowseUrl 		= _BASE_URL_ + 'kcfinder/browse.php?opener=ckeditor&type=files';
    config.filebrowserImageBrowseUrl 	= _BASE_URL_ + 'kcfinder/browse.php?opener=ckeditor&type=images';
    config.filebrowserFlashBrowseUrl 	= _BASE_URL_ + 'kcfinder/browse.php?opener=ckeditor&type=flash';

    /**
     * KcFinder Upload Settings
     * @type {[type]}
     */
    config.filebrowserUploadUrl 		= _BASE_URL_ + 'kcfinder/upload.php?opener=ckeditor&type=files';
    config.filebrowserImageUploadUrl 	= _BASE_URL_ + 'kcfinder/upload.php?opener=ckeditor&type=images';
    config.filebrowserFlashUploadUrl 	= _BASE_URL_ + 'kcfinder/upload.php?opener=ckeditor&type=flash';

    config.extraPlugins = 'wordcount,notification';
    
    config.toolbarGroups = [
      { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
      { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
      { name: 'forms', groups: [ 'forms' ] },
      { name: 'styles', groups: [ 'styles' ] },
      { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
      { name: 'paragraph', groups: [ 'align', 'list', 'indent', 'blocks', 'bidi', 'paragraph' ] },
      { name: 'links', groups: [ 'links' ] },
      { name: 'insert', groups: [ 'insert' ] },
      { name: 'colors', groups: [ 'colors' ] },
      { name: 'tools', groups: [ 'tools' ] },
      { name: 'about', groups: [ 'about' ] },
      { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
      { name: 'others', groups: [ 'others' ] }
    ];
  
    config.removeButtons = 'Source,Save,NewPage,Preview,Print,Templates,Cut,Copy,Paste,PasteText,PasteFromWord,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Flash,Table,Smiley,SpecialChar,HorizontalRule,Iframe,Font,FontSize,BGColor,About,Find,Replace,SelectAll,CopyFormatting,RemoveFormat,Language,BidiRtl,BidiLtr,JustifyBlock,Outdent,Indent';
};
