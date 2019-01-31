<?php

namespace App\Http\Controllers;

use zgldh\QiniuStorage\QiniuStorage;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function uploadImageForSimditor(Request $request)
    {
        $disk = QiniuStorage::disk('qiniu');
        $filename = $disk->put('/images/editor/' . date('Y/m/d'), $request->file('upload_file'));
        $img_url = $disk->downloadUrl($filename);
        //$img_url = $disk->downloadUrl($filename,'https');
        if (!$filename) {
            $data = [
                "success" => false,
                "msg" => "上传失败!",
                "file_path" => "none"
            ];
        } else {
            $data = [
                "success" => true,
                "msg" => "上传成功!",
                "url" => "$img_url"
            ];
        }
        return $data;
    }

    public function uploadImageForEditormd(Request $request)
    {
        $disk = QiniuStorage::disk('qiniu');
        $filename = $disk->put('/images/editor/' . date('Y/m/d'), $request->file('editormd-image-file'));
        $img_url = $disk->downloadUrl($filename);
        //$img_url = $disk->downloadUrl($filename,'https');
        if (!$filename) {
            $data = [
                "success" => 0,
                "msg" => "上传失败!"
            ];
            return $data;
        }
        $data = [
            "success" => 1,
            "msg" => "上传成功!",
            "url" => "$img_url"
        ];
        return $data;
    }
}
