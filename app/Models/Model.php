<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    protected $perPage = 10;

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeSort($query)
    {
        return $query->orderBy('sort', 'desc');
    }

    public function getAdminLinkAttribute()
    {
        if (! $this->id) {
            return '';
        }
        $route_name = 'admin::'.lcfirst(\Illuminate\Support\Str::plural((class_basename(get_called_class())))).'.show';
        if (app('router')->has($route_name)) {
            return route($route_name, ['id' => $this]);
        } else {
            return '';
        }
    }

    public function getLinkAttribute()
    {
        if (! $this->id) {
            return '';
        }
        $route_name = lcfirst(\Illuminate\Support\Str::plural((class_basename(get_called_class())))).'.show';
        if (app('router')->has($route_name)) {
            return route($route_name, ['id' => $this]);
        } else {
            return '';
        }
    }

    /**
     * 生成后台form的模型select选择器
     * @param \Encore\Admin\Form $form
     * @param string $formField 存储表单字段
     * @param string $titles 选择下拉显示标题的字段，可以是title或者数组['id', 'title']或者id,title 多个会以|拼接
     * @param string $label 选择项目标题
     * @param boolean $is_all_options 是否一次获取全部
     * @param string $query_field 模糊查询字段
     * @param string $select_type 选择类型，可选参数select,multipleSelect
     * @author klinson <klinson@163.com>
     * @return $this|mixed
     */
    public static function form_display_select($form, $formField = '', $titles = 'title', $label = '', $is_all_options = true, $query_field = 'title', $select_type = 'select')
    {
        if (empty($formField)) {
            $formField = \Illuminate\Support\Str::snake(class_basename(get_called_class()), '_').'_id';
        }
        if (empty($label)) {
            $label = __(ucfirst(\Illuminate\Support\Str::snake(class_basename(get_called_class()), ' ') . ' id'));
        }
        if (! is_array($titles)) {
            $titles = explode(',', $titles);
        }

        if (count($titles) == 1) {
            if (! $is_all_options) {
                return $form->$select_type($formField, $label)->match(function ($keyword) use ($query_field, $titles) {
                    return static::where($query_field, 'LIKE', '%' . $keyword . '%')
                        // because select2 js plugin needs `text` and `id` column,
                        // so if your model does not contains these two, remember to AS for them
                        ->select([\DB::raw($titles[0].' AS text'), 'id'])
                        ->latest();
                })->text(function ($id) use ($titles) {
                    if (is_array($id)) {
                        return static::whereIn('id', $id)->select([\DB::raw($titles[0].' AS text'), 'id'])->pluck('text', 'id');
                    } else {
                        return static::where('id', $id)->select([\DB::raw($titles[0].' AS text'), 'id'])->pluck('text', 'id');
                    }
                    // return type is `{id1: text1, id2: text2...}
                });
            } else {
                return $form->$select_type($formField, $label)->options(static::all(['id', $titles[0]])->pluck($titles[0], 'id'));
            }
        } else {
            $selects = implode($titles, "`, ' | ', `");
            $selects = "concat(`{$selects}`) AS text";
            if (! $is_all_options) {
                return $form->$select_type($formField, $label)->match(function ($keyword) use ($query_field, $selects) {
                    return static::where($query_field, 'LIKE', '%' . $keyword . '%')
                        // because select2 js plugin needs `text` and `id` column,
                        // so if your model does not contains these two, remember to AS for them
                        ->select([\DB::raw($selects), 'id'])
                        ->latest();
                })->text(function ($id) use ($selects) {
                    if (is_array($id)) {
                        return static::whereIn('id', $id)->select([\DB::raw($selects), 'id'])->pluck('text', 'id');
                    } else {
                        return static::where('id', $id)->select([\DB::raw($selects), 'id'])->pluck('text', 'id');
                    }
                    // return type is `{id1: text1, id2: text2...}
                });
            } else {
                $list = static::all([\DB::raw($selects), 'id'])->pluck('text', 'id');
                return $form->$select_type($formField, $label)->options($list);
            }
        }
    }
}
