<?php
namespace App\Admin\Extensions\Exporters;

use Encore\Admin\Grid\Exporters\AbstractExporter;
use Maatwebsite\Excel\Facades\Excel;

class ExcelExporter extends AbstractExporter
{
    protected $fileName = '导出文件';
    protected $fields = [];
    protected $transform = [];
    // function方式下的转换字段替换值定义
    protected $transformField = '{{:field}}';

    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
        return $this;
    }

    public function setFields($fields)
    {
        $this->fields = $fields;
        return $this;
    }

    public function setTransform($transform)
    {
        $this->transform = $transform;
        return $this;
    }

    public function setTransformField($transformField)
    {
        $this->transformField = $transformField;
        return $this;
    }

    public function export()
    {
        Excel::create($this->fileName . '-' . date('YmdHis'), function($excel) {

            $excel->sheet('Sheetname', function($sheet) {
                $row_number = 1;
                $sheet->appendRow($row_number++, array_values($this->fields));

                $this->chunk(function ($list) use ($sheet, &$row_number) {
                    $list->map(function ($item) use ($sheet, &$row_number) {
//                        $item = $item->toArray();
                        $data = array_map(function ($item_c) use ($item) {
                            // 示例'aaaa|bbb'就是aaaa没有数据就取bbb的值
                            $fields = explode('|', $item_c);
                            $return = null;
                            $field_name = null;

                            // 第一层是或 => |
                            foreach ($fields as $field) {
                                $field_name = $field;
                                $next_fields = explode('.', $field);

                                // 第二层是下级 => .
                                $return = $item;
                                foreach ($next_fields as $next_field) {
                                    // 可能是方法返回值
                                    if (is_object($return)) {
                                        if (substr($next_field, strlen($next_field)-2) === '()') {
                                            // 方法返回内容
                                            try {
                                                $function_name = substr($next_field, 0, strlen($next_field)-2);
                                                $return = call_user_func(array($return, $function_name));
                                            } catch (\BadMethodCallException $exception) {
                                                // 不存在方法，中断下级循环
                                                $return = null;
                                                break;
                                            }
                                        } else if (isset($return->$next_field)){
                                            // 对象值
                                            $return = $return->$next_field;
                                        } else {
                                            // 对象值和方法动不存在，中断下级循环
                                            $return = null;
                                            break;
                                        }
                                    } else if (is_array($return) && isset($return[$next_field])){
                                        // 数组值
                                        $return = $return[$next_field];
                                    } else {
                                        // 什么都没有,中断下级循环
                                        $return = null;
                                        break;
                                    }
                                }

                                if (! is_null($return)) {
                                    // 或过程，已经获取到数据，中断循环
                                    break;
                                }
                            }

                            // 数据不存在， 不需要转换，直接返回数据
                            if (is_null($return)) {
                                return '';
                            }

                            // 数据转换
                            if (isset($this->transform[$field_name])) {
                                if (is_array($this->transform[$field_name])) {
                                    // 数组转换
                                    $return = $this->transform[$field_name][$return];
                                } else if (is_string($this->transform[$field_name])) {
                                    // 特殊转换，当前支持仅仅function类型
                                    $tmp = explode(',', $this->transform[$field_name]);
                                    switch ($tmp[0]) {
                                        case 'function':
                                            //示例：'function,date,Y-m-d H:i:s,{{:field}}'
                                            $function_name = $tmp[1];
                                            unset($tmp[0]);
                                            unset($tmp[1]);
                                            $params = array_values($tmp);
                                            if (empty($params)) {
                                                $params[] = $return;
                                            } else {
                                                foreach ($params as &$param) {
                                                    if ($param === $this->transformField) {
                                                        $param = $return;
                                                    }
                                                }
                                            }

                                            $return = call_user_func_array($function_name, $params);
                                            break;
                                        default:
                                            break;
                                    }
                                }
                            }

                            // 防止科学计数法
                            return strval($return)."\t";
                        }, array_keys($this->fields));

                        $sheet->appendRow($row_number++, $data);
                    });
                }, 1000);
            });

        })->export('xlsx');
    }
}