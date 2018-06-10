<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class WysiwygImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Method to upload and save images
     * @param Request $request
     * @return string
     */
    public function upload(Request $request)
    {
        $path = $request->file('upload')->storePublicly('wysiwyg');

        $result = [
            'url' => Storage::disk('public')->url($path),
            'value' => $path,
            'uploaded' => 1,
            'fileName' => pathinfo($path, PATHINFO_FILENAME)
        ];

        if ($request->CKEditorFuncNum && $request->CKEditor && $request->langCode) {
            //that handler to upload image CKEditor from Dialog
            $funcNum = $request->CKEditorFuncNum;
            $CKEditor = $request->CKEditor;
            $langCode = $request->langCode;
            $token = $request->ckCsrfToken;
            return view('admin.ckeditor.upload_file', compact('result', 'funcNum', 'CKEditor', 'langCode', 'token'));
        }

        return $result;
    }
}