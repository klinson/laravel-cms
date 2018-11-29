<?php

namespace App\Admin\Extensions\Actions;

class GetButton
{
    protected $id;
    protected $title;
    protected $url;
    protected $btn_type;
    protected $deleteConfirm = '确定操作？';
    protected $confirm = '确认';
    protected $cancel = '取消';
    protected $target = '';

    public function __construct($action, $title, $target = '_self', $btn_type = 'primary', $params = [])
    {
        $this->url = $action;
        $this->title = $title;
        $this->btn_type = $btn_type;
        $this->target = $target;
    }


    protected function render()
    {
        return <<<EOT
&nbsp;<a href="{$this->url}" class="{$this->title}-class btn btn-xs btn-{$this->btn_type}" target="{$this->target}">
    {$this->title}
</a>&nbsp;
EOT;
    }

    public function __toString()
    {
        return $this->render();
    }

}