<?php

namespace App\Admin\Extensions;

use Encore\Admin\Form\Field;

class Simditor extends Field
{
    protected $view = 'component.simditor';
    protected static $css = [
        '/vendor/simditor/simditor.css',
        '/vendor/simditor/simditor-html.css',
    ];

    protected static $js = [
        '/vendor/simditor/module.js',
        '/vendor/simditor/uploader.js',
        '/vendor/simditor/hotkeys.js',
        '/vendor/simditor/simditor.js',
        '/vendor/simditor/simditor-dropzone.js',
        '/vendor/simditor/beautify-html.js',
        '/vendor/simditor/simditor-html.js',
    ];

    public function render()
    {
        $url = route('api.upload.image');
        $this->script = <<<EOT
        
var toolbar = ['title', 'bold', 'italic', 'underline', 'strikethrough', 'fontScale', 'color', '|', 'ol', 'ul', 'blockquote', 'code', 'table', '|', 'link', 'image', 'hr', '|', 'indent', 'outdent', 'alignment','|','html'];
var editor = new Simditor({
  textarea: $('#{$this->id}'),
  toolbar: toolbar,
  upload: true,
  pasteImage: true,
  toolbar: true,
  upload: {
		    url : '{$url}',
		    params: null,
		    fileKey: 'upload_file', 
		    connectionCount: 3,
		    leaveConfirm: '正在上传文件，确定要离开吗'
		  }
});

EOT;
        return parent::render();
    }
}