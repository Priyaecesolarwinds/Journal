<?php

namespace App\Http\Controllers;

use App\Pdf;
use Spatie\Permission\Models\Role;

use Illuminate\Http\Request;

class UploadFileController extends Controller
{
    public function index(){
     {
        try{
            $roles = Role::pluck('name','id');

            return view('upload', compact('roles'));
        }catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);

        }
    }

}

public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf,xlx,csv|max:2048',
        ]);
        
        $fileName =$request->file->getClientOriginalName();  
        
        $pdf = new Pdf();
        $request->file->move(public_path('uploads'), $fileName);
       
        /*  
            Write Code Here for
            Store $fileName name in DATABASE from HERE 
        */

        $pdf->fileName = $fileName;
        $pdf->save();
         
        return back()->with('success', 'File uploaded successfully!')
                     ->with('file', $fileName);
    }
}
