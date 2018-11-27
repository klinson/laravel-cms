<?php
/**
 * Created by PhpStorm.
 * User: klinson <klinson@163.com>
 * Date: 18-9-11
 * Time: 下午7:45
 */

namespace App\Admin\Extensions\Actions;

use Encore\Admin\Admin;

class AjaxButton
{
    protected $id;
    protected $title;
    protected $btn_type;
    protected $deleteConfirm = '确定操作？';
    protected $confirm = '确认';
    protected $cancel = '取消';

    public function __construct($action, $title, $btn_type = 'primary', $params = [])
    {
        $this->url = $action;
        $this->title = $title;
        $this->btn_type = $btn_type;
    }

    protected function script()
    {

        $script = <<<SCRIPT

$('.{$this->title}-class').unbind('click').click(function() {

    var url = $(this).data('action');

    swal({
      title: "$this->deleteConfirm",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "$this->confirm",
      closeOnConfirm: false,
      cancelButtonText: "$this->cancel"
    },
    function(){
        $.ajax({
            method: 'post',
            url: url,
            data: {
                _method:'put',
                _token:LA.token,
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