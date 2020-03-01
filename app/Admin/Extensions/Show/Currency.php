<?php

namespace App\Admin\Extensions\Show;

use Encore\Admin\Show\AbstractField;

class Currency extends AbstractField
{
    public function render($symbol = '￥', $rate = 100)
    {
        // 返回任意可被渲染的内容
        if ($rate) {
            $value = doubleval($this->value) / $rate;
        } else {
            $value = $this->value;
        }

        return "{$symbol}&nbsp;{$value}";
    }
}
