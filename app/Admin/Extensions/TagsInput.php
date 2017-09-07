<?php

namespace App\Admin\Extensions;

use Encore\Admin\Form\Field;

class TagsInput extends Field
{
    protected $view = 'component.tagsInput';

    protected static $css = [
        '/vendor/tagsInput/jquery.tagsinput.css',
    ];

    protected static $js = [
        '/vendor/tagsInput/jquery.tagsinput.js',
    ];

    public function render()
    {
        $this->script = <<<EOT
        
$('#{$this->id}').tagsInput({
                'width': '100%',
                'height':'60px',
                'defaultText': '+ 添加',
                'removeWithBackspace': true,
                'minChars': 1,
                'maxChars': 0,
                'placeholderColor': '#666666'
            })

EOT;
        return parent::render();
    }
}