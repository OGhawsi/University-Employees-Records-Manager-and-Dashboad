<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class AttachmentController extends Controller
{
  
    public function create(Employee $employee)
    {
        return Inertia::render('Attachment/UploadMultiple', [
            'employee' => $employee,
        ]);
    }

    public function store(Request $request, Employee $employee)
    {
      
        request()->validate([
            'file' => ['file', 'max:76000', 'mimes:jpg,jpeg,png,bmp,tiff,pdf']
        ], [
            'max' => 'File can not be larger than 75 MB',
            'mimes' => 'Upload images and PDF only'
        ]);
         
        $file = $request->file('file');    

        // set up the file name
        $file_name = time().'_'.$file->getClientOriginalName();

        // create directory for the user
        $dir = "public/attachments/{$employee->id}";

        // store the file in the directory created
         $path = $file->storeAs($dir, $file_name);

        //  create front end url to access images and files
        $preview_url = url("storage/attachments/{$employee->id}/$file_name");

        Attachment::create([
             'employee_id' => $employee->id,
             'name' => $file->getClientOriginalName(),
             'type' => $file->getMimeType(),
             'size' => $file->getSize(),
             'preview_url' => $preview_url,
             'path' => $path,
         ]);
    }

    public function download(Attachment $attachment)
    {
        return Storage::download($attachment->path);
    }
    
    public function destroy(Attachment $attachment)
    {
        Storage::delete($attachment->path);
        $attachment->delete();
        return redirect()->back();
    }
}
