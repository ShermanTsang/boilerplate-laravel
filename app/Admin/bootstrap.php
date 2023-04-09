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
    .datetime-column {
        font-size: 0.9rem;
        display: flex;
        flex-flow: column;
    }
    .datetime-column-region {
        color: #999;
        margin-right: 3px;
        font-size: 0.85rem;
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
        z-index: 98;
        width: 20px;
    }
    .embed-frame-web {
        width: 100%;
        height: 100%;
        border: none;
    }
    .embed-frame-button {
        border: 1px solid #fff;
        border-radius: 6px;
        font-size: 0.96rem;
        padding: 5px 10px;
    }
    .embed-frame-button a {
        color: #fff;
    }
    .embed-frame-header {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        align-items: center;
        justify-content: space-between;
        position: absolute;
        width: 100%;
        top: 0;
        left: 0;
        right: 0;
        padding: 10px 12px;
        z-index: 99;
        background-color: rgba(35,137,255,0.6);
        transition: background-color 0.3s;
    }
    .embed-frame-header:hover {
        background-color: rgba(35,137,255,0.95);
    }
    .embed-frame-name {
        color: #fff;
        font-size: 1.1rem;
    }
CSS
);

Admin::script(
    <<<JS
    console.log('Hello world!');
JS
);
