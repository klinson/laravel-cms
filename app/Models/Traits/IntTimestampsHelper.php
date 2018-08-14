<?php
/**
 * Created by PhpStorm.
 * User: klinson <klinson@163.com>
 * Date: 18-6-15
 * Time: 上午9:39
 */

namespace App\Models\Traits;

trait IntTimestampsHelper
{
    /*
    |--------------------------------------------------------------------------
    | created_at 和 updated_at 处理成时间戳模式
    |--------------------------------------------------------------------------
    */

    /**
     * 获取当前时间
     *
     * @return int
     */
    public function freshTimestamp() {
        return time();
    }

    /**
     * 避免转换时间戳为时间字符串
     *
     * @param \DateTime|int $value
     * @return \DateTime|int
     */
    public function fromDateTime($value) {
        return $value;
    }

    /**
     * select的时候避免转换时间为Carbon
     *
     * @param mixed $value
     * @return mixed
     */
//  protected function asDateTime($value) {
//      return $value;
//  }

    /**
     * 从数据库获取的为获取时间戳格式
     *
     * @return string
     */
    public function getDateFormat() {
        return 'U';
    }
}