<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class AttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Employee $employee)
    {
        return Inertia::render('Attachment/UploadMultiple', [
            'employee' => $employee,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Employee $employee)
    {
        request()->validate([
            'file' => ['file', 'max:10240', 'mimes:jpg,jpeg,png,bmp,tiff,pdf']
        ], [
            'max' => 'File can not be larger than 10MB',
            'mimes' => 'Upload images and PDF only'
        ]);
         
        $file = $request->file('file');    

        $file_name = time().'_'.$file->getClientOriginalName();

        $dir = "public/attachments/{$employee->id}";

         $path = $file->storeAs($dir, $file_name);

        // $path = Storage::putFile($dir, $file, 'public');

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
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function download(Attachment $attachment)
    {
        // ddd($attachment->preview_url);
        // ddd($attachment->path);
        return Storage::download($attachment->path);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function edit(Attachment $attachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attachment $attachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attachment $attachment)
    {
        Storage::delete($attachment->path);
        $attachment->delete();
        return redirect()->back();
    }
}
