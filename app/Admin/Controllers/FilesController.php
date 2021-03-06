<?php
/**
 * Created by PhpStorm.
 * User: klinson <klinson@163.com>
 * Date: 2018/11/1
 * Time: 23:47
 */

namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    public function editor(Request $request)
    {
        if ($files = $request->file('files')) {
            $urls = [];
            if (is_array($files)) {
                foreach ($files as $file) {
                    $path = $file->store('editor', 'admin');
                    $urls[] = Storage::disk('admin')->url($path);
                }

            } else {
                $path = $files->store('editor', 'admin');
                $urls[] = Storage::disk('admin')->url($path);
            }

            return [
                "errno" => 0,
                "data" => $urls
            ];
        } else {
            return [
                "errno" => 1,
                "data" => '请选择上传文件'
            ];
        }
    }

    public function simditor(Request $request)
    {
        if ($files = $request->file('files')) {
            $urls = [];
            if (is_array($files)) {
                foreach ($files as $file) {
                    $path = $file->store('editor', 'admin');
                    $urls[] = Storage::disk('admin')->url($path);
                }

            } else {
                $path = $files->store('editor', 'admin');
                $urls[] = Storage::disk('admin')->url($path);
            }

            return [
                "success" => true,
                "msg" => '上传成功',
                "file_path" => $urls,
            ];
        } else {
            return [
                "success" => false,
                "msg" => '请选择上传文件',
                "file_path" => [],
            ];
        }
    }
}