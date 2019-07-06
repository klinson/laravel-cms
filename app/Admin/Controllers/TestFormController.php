<?php
/**
 * Created by PhpStorm.
 * User: klinson <klinson@163.com>
 * Date: 19-3-29
 * Time: 下午3:49
 */

namespace App\Admin\Controllers;


use App\Handlers\HarassMobileHandler;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;

class TestFormController extends Controller
{
    protected $pageHeader = '测试表单';


    public function index()
    {
        return Admin::content(function (Content $content) {
            $this->_setPageDefault($content);
            $options = [
                1 => 'A',
                2 => 'B',
                3 => 'C',
                4 => 'D',
            ];

            $form = new Form();
            $form->action('/admin/testForm');
            $form->method();
            $form->text('text');
            $form->password('password');
            $form->checkbox('checkbox')->options($options);
            $form->radio('radio')->options($options);
            $form->select('select')->options($options);
            $form->multipleSelect('multipleSelect')->options($options);
            $form->textarea('textarea');
            $form->hidden('hidden');
            $form->id('id');
            $form->ip('ip');
            $form->url('url');
            $form->color('color');
            $form->email('email');
            $form->mobile('mobile');
            $form->slider('slider');
            $form->file('file');
            $form->image('image');
            $form->date('date');
            $form->datetime('datetime');
            $form->time('time');
            $form->year('year');
            $form->month('month');
            $form->dateRange('dateRange_start', 'dateRange_end');
            $form->dateTimeRange('dateTimeRange_start', 'dateTimeRange_end');
            $form->timeRange('timeRange_start', 'timeRange_end');
            $form->number('number');
            $form->currency('currency');
            $form->switch('switch');
            $form->display('display');
            $form->rate('rate');
            $form->divider();
            $form->decimal('decimal');
            $form->html('html');
            $form->tags('tags')->options($options);
            $form->icon('icon');
            $form->captcha('captcha');
            $form->listbox('listbox');
//            $form->table('table');
            $form->timezone('timezone');
            $form->keyValue('keyValue');
            $form->list('list');
            $form->tagsinput('tagsinput');
            $form->media('media')->path('images');
            $form->cropper('cropper');
            $form->distpicker(['province_id' => '省', 'city_id' => '市', 'district_id' => '区'], 'distpicker');

            $form->editor('ueditor');
            $form->ckEditor('ckEditor');
            $form->codeEditor('codeEditor');
            $form->markdown('markdown');
//            $form->simditor('simditor');
//            注意： 此组件不可与simditor同时使用
            $form->editormd('editormd');

            $content->body(new Box($this->pageHeader, $form));
        });
    }


    public function store(Request $request)
    {

//        dump($request->all());

        admin_toastr('保存成功', 'success');
        admin_info('保存成功', '保存成功');
        return redirect()->back();
    }
}