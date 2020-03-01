<?php
/**
 * Created by PhpStorm.
 * User: klinson <klinson@163.com>
 * Date: 2018/10/24
 * Time: 21:24
 */

namespace App\Admin\Extensions\Form;

use Encore\Admin\Form\Field\Text;

class Currency extends Text
{
    /**
     * @var string
     */
    protected $symbol = '￥';

    /**
     * @var array
     */
    protected static $js = [
        '/vendor/laravel-admin/AdminLTE/plugins/input-mask/jquery.inputmask.bundle.min.js',
    ];

    public function __construct($column, array $arguments = [])
    {
        parent::__construct($column, $arguments);
    }

    /**
     * Set symbol for currency field.
     *
     * @param string $symbol
     *
     * @return $this
     */
    public function symbol($symbol)
    {
        $this->symbol = $symbol;

        return $this;
    }

    /**
     * Set digits for input number.
     *
     * @param int $digits
     *
     * @return $this
     */
    public function digits($digits)
    {
        return $this->options(compact('digits'));
    }

    /**
     * {@inheritdoc}
     */
    public function prepare($value)
    {
        return (float) $value;
    }

    /**
     * {@inheritdoc}
     */
    public function render()
    {
        $this->script = <<<EOT
$('{$this->getElementClassSelector()}').inputmask({
    alias: "numeric",
    radixPoint: ".",
    prefix: "",
    digits: 2,
    removeMaskOnSubmit: true,
    onUnMask: function(maskedValue, unmaskedValue) {
        // 提交进行乘以100取整
        var m2 = Math.pow(10, 2);
        var m4 = Math.pow(10, 4);
        return Math.round(parseFloat(unmaskedValue) * m4, 10) / m2;
    },
    onBeforeMask: function (value, opts) {
        // 渲染进行除以100进行取小数
        if (value != '') {
            value = parseFloat(value)/100;
            value = value.toString();
        }

        return value;
  }
});
EOT;

        $this->prepend($this->symbol)
            ->defaultAttribute('style', 'width: 120px');

        return parent::render();
    }
}
