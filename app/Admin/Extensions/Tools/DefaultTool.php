<?php
/**
 * Created by PhpStorm.
 * User: klinson <klinson@163.com>
 * Date: 18-9-11
 * Time: 下午8:20
 */
namespace App\Admin\Extensions\Tools;

use Encore\Admin\Grid\Tools\BatchAction;

class DefaultTool extends BatchAction
{
    protected $action;

    public function __construct($action)
    {
        $this->action = $action;
    }

    public function script()
    {
        return <<<EOT
$('{$this->getElementClass()}').on('click', function() {

    $.ajax({
        method: 'post',
        url: '{$this->resource}/{$this->action}',
        data: {
            _token:LA.token,
            ids: selectedRows()
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