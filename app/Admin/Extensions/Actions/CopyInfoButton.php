<?php

namespace App\Admin\Extensions\Actions;

use Encore\Admin\Facades\Admin;

class CopyInfoButton
{
    protected $title;
    protected $info;
    protected $btn_type;
    protected $icon;

    protected static $js = ['/vendor/clipboard/src/clipboard.js'];

    public function __construct($title, $info = '', $btn_type = 'primary', $icon = null)
    {
        $this->title = $title;
        $this->btn_type = $btn_type;
        $this->info = $info;
        $this->icon = $icon;
    }

    protected function script()
    {
        return <<<JS
var clipboard = new ClipboardJS('.clipboard-btn');

clipboard.on('success', function(e) {
    swal('复制代码成功', '', 'success');
    e.clearSelection();
});
JS;
    }

    protected function render()
    {
        Admin::js(static::$js);
        Admin::script($this->script());

        return <<<EOT
&nbsp;<button class="btn btn-xs clipboard-btn btn-{$this->btn_type}" data-clipboard-text="{$this->info}">
    {$this->title}
</button>&nbsp;
EOT;
    }

    public function __toString()
    {
        return $this->render();
    }

}