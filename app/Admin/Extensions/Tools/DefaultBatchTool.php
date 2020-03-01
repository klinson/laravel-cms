<?php
/**
 * Created by PhpStorm.
 * User: klinson <klinson@163.com>
 * Date: 18-9-11
 * Time: 下午8:20
 */
namespace App\Admin\Extensions\Tools;

use Encore\Admin\Grid\Tools\BatchAction;

class DefaultBatchTool extends BatchAction
{
    protected $action;
    protected $method;

    public function __construct($action, $method = 'put')
    {
        $this->action = $action;
        $this->method = $method;
    }

    public function script()
    {
        return <<<EOT
$('{$this->getElementClass()}').on('click', function() {

    $.ajax({
        method: 'post',
        url: '{$this->resource}/{$this->action}',
        data: {
            _token: LA.token,
            _method: '{$this->method}',
            ids: $.admin.grid.selected()
        },
        success: function (data) {
            $.pjax.reload('#pjax-container');
            if (typeof data === 'object') {
                if (data.status) {
                    toastr.success(data.message);
                } else {
                    toastr.warning(data.message);
                }
            }
            
        }
    });
});

EOT;
    }
}