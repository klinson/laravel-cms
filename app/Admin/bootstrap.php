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

Form::forget('map');

// 编辑器
Form::forget('editor');
Form::extend('editor', \App\Admin\Extensions\Form\WangEditor::class);
//Form::extend('editor', \App\Admin\Extensions\Form\CKEditor::class);
//Form::extend('code', \App\Admin\Extensions\Form\CodeEditor::class);
//Form::extend('markdown', \App\Admin\Extensions\Form\MarkdownEditor::class);
