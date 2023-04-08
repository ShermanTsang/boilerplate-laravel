<?php

use Dcat\Admin\Admin;

/**
 * Dcat-admin - admin builder based on Laravel.
 * @author jqh <https://github.com/jqhph>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 *
 * extend custom field:
 * Dcat\Admin\Form::extend('php', PHPEditor::class);
 * Dcat\Admin\Grid\Column::extend('php', PHPEditor::class);
 * Dcat\Admin\Grid\Filter::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */

Admin::style(
    <<<CSS
    .main-footer {
        display: none !important;
    }
    .embed-frame {
        position: relative;
        display: block;
        width: 100%;
        height: 80vh;
        overflow: hidden;
        border-radius: 6px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .embed-frame-overlay {
        position: absolute;
        right:0;
        top: 0;
        bottom: 0;
        background-color: rgba(255,255,255,.9);
        height: 100%;
        width: 20px;
    }
    .embed-frame-web {
        width: 100%;
        height: 100%;
        border: none;
    }
    .embed-frame-link {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 8px 0;
        font-size: 1.1rem;
        text-align: center;
        background-color: rgba(35,137,255,0.8);
    }
    .embed-frame-link a {
        color: #fff;
    }
CSS
);

Admin::script(
    <<<JS
    console.log('Hello world!');
JS
);
