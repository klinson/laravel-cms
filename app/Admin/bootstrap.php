<?php

/**
 * Laravel-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * Encore\Admin\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * Encore\Admin\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */

use Encore\Admin\Form;
use Encore\Admin\Grid\Column;

Admin::script("document.getElementsByTagName('footer')[0].getElementsByTagName('strong')[0].innerHTML='".config('admin.powered_by_info')."';");

Form::forget('map');

// 编辑器
//Form::forget('editor');
//Form::extend('wangEditor', \App\Admin\Extensions\Form\WangEditor::class);
//Form::extend('ckEditor', \App\Admin\Extensions\Form\CKEditor::class);
//Form::extend('codeEditor', \App\Admin\Extensions\Form\CodeEditor::class);
//Form::extend('markdown', \App\Admin\Extensions\Form\MarkdownEditor::class);

//Column::extend('qrcode', \App\Admin\Extensions\Column\Qrcode::class);
Admin::js('/vendor/clipboard/dist/clipboard.min.js');
Column::extend('urlWrapper', \App\Admin\Extensions\Column\UrlWrapper::class);
