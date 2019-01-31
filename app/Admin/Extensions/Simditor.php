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
        $token = csrf_token();
        $config = json_encode((array)config('admin.extensions.simditor.config'));
        $this->script = <<<EOT
        
        var config = {$config}
        config['textarea'] = $('#{$this->id}')
        config['upload']['params'] = {_token: '{$token}'}
        $(document).ready(function(){
            var editor = new Simditor(config);
        });
        
EOT;
        return parent::render();
    }
}