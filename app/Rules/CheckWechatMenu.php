<?php

namespace App\Rules;

use App\Models\WechatMenu;
use Illuminate\Contracts\Validation\Rule;

class CheckWechatMenu implements Rule
{
    protected $message;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        switch ($attribute) {
            case 'parent_id':
                if ($value > 0 && ! WechatMenu::find($value)) {
                    $this->message = '上级菜单不存在';
                    return false;
                }
                if (! WechatMenu::checkMenuCount($value)) {
                    $this->message = '上级菜单的子菜单数量已经满了，请删除部分再添加';
                    return false;
                }
                break;
            default:
                break;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message ?: '请填写正确的 :attribute';
    }
}
