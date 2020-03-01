<?php
/**
 * Created by PhpStorm.
 * User: klinson <klinson@163.com>
 * Date: 18-9-11
 * Time: 下午7:45
 */

namespace App\Admin\Extensions\Actions;

use Encore\Admin\Admin;

class AjaxWithInputButton
{
    protected $id;
    protected $title;
    protected $input_tip;
    protected $input_name;
    protected $btn_type;
    protected $icon;
    protected $method;

    public function __construct($action, $title, $input_name = 'data', $input_tip = '请输入信息', $method = 'put', $btn_type = 'primary', $icon = null)
    {
        $this->url = $action;
        $this->title = $title;
        $this->input_tip = $input_tip;
        $this->input_name = $input_name;
        $this->btn_type = $btn_type;
        $this->method = $method;
    }

    protected function script()
    {

        $script = <<<SCRIPT

$('.{$this->title}-class').unbind('click').click(function() {

    var input = prompt('{$this->input_tip}');

    var url = $(this).data('action');
    
    $.ajax({
        method: 'post',
        url: url,
        data: {
            {$this->input_name}: input,
            _method: '{$this->method}',
            _token: LA.token,
        },
        success: function (data) {
            $.pjax.reload('#pjax-container');

            if (typeof data === 'object') {
                if (data.status) {
                    swal(data.message, '', 'success');
                } else {
                    swal(data.message, '', 'error');
                }
            }
        }
    });
});

SCRIPT;

        return $script;
    }

    protected function render()
    {
        Admin::script($this->script());

        return <<<EOT
&nbsp;<a href="javascript:void(0);" data-action="{$this->url}" class="{$this->title}-class btn btn-xs btn-{$this->btn_type}">
    {$this->title}
</a>&nbsp;
EOT;
    }

    public function __toString()
    {
        return $this->render();
    }

}