<?php
/**
 * Created by PhpStorm.
 * User: klinson <klinson@163.com>
 * Date: 2019/1/1
 * Time: 20:32
 */

namespace App\Admin\Extensions\Tools;

use Encore\Admin\Grid\Tools\AbstractTool;

class DefaultSimpleTool extends AbstractTool
{
    protected $action;
    protected $btn_type;
    protected $title;
    protected $site;
    protected $icon;

    public function __construct($action, $title, $site = 'right', $btn_type = 'default', $icon = null)
    {
        $this->title = $title;
        $this->btn_type = in_array($btn_type, ['default', 'primary', 'success', 'info', 'warning', 'danger']) ? $btn_type : 'default';
        $this->action = $action;
        $this->site = in_array($site, ['right', 'left']) ? $site : 'right';
        $this->icon = $icon;
    }

    public function render()
    {
        if (! is_null($this->icon)) {
            $icon_html = "<i class='fa fa-{$this->icon}'></i>&nbsp;&nbsp;";
        } else {
            $icon_html = '';
        }
        $html = <<<HTML
<div class='pull-{$this->site}' style='margin-right: 10px'>
<a href='{$this->action}' class='btn btn-sm btn-{$this->btn_type}'>
{$icon_html}
{$this->title}</a>
</div>
HTML;
        return $html;
    }
}