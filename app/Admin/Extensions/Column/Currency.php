<?php

namespace App\Admin\Extensions\Column;

use Encore\Admin\Admin;
use Encore\Admin\Grid;
use Encore\Admin\Grid\Column;
use Encore\Admin\Grid\Displayers\AbstractDisplayer;

class Currency extends AbstractDisplayer
{
    public function display($symbol = '￥', $rate = 100)
    {
        if ($rate) {
            $value = doubleval($this->value) / $rate;
        } else {
            $value = $this->value;
        }

        return "{$symbol}&nbsp;{$value}";
    }
}
