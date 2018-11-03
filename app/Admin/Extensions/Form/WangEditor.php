<?php

namespace App\Admin\Extensions\Form;

use Encore\Admin\Form\Field;

class WangEditor extends Field
{
    protected $view = 'admin.wang-editor';

    protected static $css = [
        '/vendor/wangEditor-3.0.10/release/wangEditor.css',
    ];

    protected static $js = [
        '/vendor/wangEditor-3.0.10/release/wangEditor.js',
    ];

    public function render()
    {
        $name = $this->formatName($this->column);
        //上传url
        $uploadServer = '/admin/files/editor';
        $token = csrf_token();

        $this->script = <<<EOT
var E = window.wangEditor
var editor = new E('#{$this->id}');
editor.customConfig.zIndex = 0
editor.customConfig.onchange = function (html) {
    $('input[name=$name]').val(html);
}
editor.customConfig.uploadImgServer = '$uploadServer'
editor.customConfig.uploadImgHeaders = {
    'X-CSRF-TOKEN': '$token'
};
editor.customConfig.uploadFileName = 'files[]'
editor.customConfig.uploadTimeout = 100000000;
editor.create()
EOT;
        return parent::render();
    }
}
