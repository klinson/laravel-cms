<?php

namespace App\Admin\Extensions\Form;

use Encore\Admin\Form\Field;

class CodeEditor extends Field
{
    protected $view = 'admin::form.editor';

    protected static $js = [
        '/vendor/codemirror/lib/codemirror.js',
        '/vendor/codemirror/addon/edit/matchbrackets.js',
        '/vendor/codemirror/mode/htmlmixed/htmlmixed.js',
        '/vendor/codemirror/mode/xml/xml.js',
        '/vendor/codemirror/mode/javascript/javascript.js',
        '/vendor/codemirror/mode/css/css.js',
        '/vendor/codemirror/mode/clike/clike.js',
        '/vendor/codemirror/mode/php/php.js',
    ];

    protected static $css = [
        '/vendor/codemirror/lib/codemirror.css',
    ];

    protected $languages = [
        'php' => 'text/x-php',
        'go' => 'text/x-go',
        'c' => 'text/x-csrc',
        'c++' => 'text/x-c++src',
        'java' => 'text/x-java',
        'python' => 'text/x-python',
        'html' => 'text/html',
        'markdown' => 'text/x-markdown',
        'vuejs' => 'text/x-vue',
        'javascript' => 'text/javascript'
    ];

    public function render()
    {
        if (isset($this->attributes['language']) && key_exists($this->attributes['language'], $this->languages)) {
            $mode_str = 'mode: "'.$this->languages[$this->attributes['language']].'",';
        } else {
            $mode_str = '';
        }
        $this->script = <<<EOT

CodeMirror.fromTextArea(document.getElementById("{$this->id}"), {
    lineNumbers: true,
    $mode_str
    extraKeys: {
        "Tab": function(cm){
            cm.replaceSelection("    " , "end");
        }
     }
});

EOT;
        return parent::render();

    }
}
