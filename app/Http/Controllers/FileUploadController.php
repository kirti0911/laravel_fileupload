<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\upload;
use Mail;

class FileUploadController extends Controller
{
    /** 
    *Function to show form to user for uploading files
    */
    public function showFileUploader() {
        return view('file-upload');
    }

    /**
    * Function to save file to details to database and aws. 
    */
    public function saveFile( Request $request ) {
        
        $request->validate([
            'file' => 'required|mimes:pdf,xml,doc,csv,txt|max:10000',
        ]);
 
        $fileName = $request->file->getClientOriginalName();
        $filePath = 'uploads/' . $fileName;
        $size = $request->file->getSize();
 
        $path = Storage::disk('s3')->put( $filePath, file_get_contents( $request->file ) );
        $path = Storage::disk('s3')->url( $path );

        //Save data to database
        $data = array(
            'filename' => $fileName,
            's3_path' => $filePath,
            'size' => $size
        );
        $insert = upload::saveFile( $data );

        //send email notification after file upload
        $this->sendMail( $data );
 
        return back()->with('success','File has been successfully uploaded.');
    }

    public function sendMail( $data ) {
        
        $to_name = 'Admin';
        $to_email = 'notify@test.test';
        
        Mail::send('file_upload_mail', $data, function($message) use ($to_name, $to_email) {
        $message->to($to_email, $to_name)
        ->subject('File upload notification');
        $message->from('admin@test.com');
        });
        
        return 'Email sent Successfully';
    }
}
