<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFileRequest;
use App\Models\User;
use App\Notifications\Reminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $files = Gate::allows('viewAll', File::class)
            // If The User's Role Is Admin he will see all files stored in the database 
            ? File::all()
            // If The User's Role Is Not Admin he will see only the files that he uploaded
            :
            File::where('user_id', Auth::id())->get();
        return view('files-index', compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('files-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFileRequest $request)
    {

        $file = new File();
        $file->name = uniqid() . '_' . $request->file('file')->getClientOriginalName();
        $file->path = $request->file('file')->store('files', 'public');
        $file->user_id = Auth::id();
        $file->save();

        //$user->notify(new Reminder($fileName));

        return redirect()->route('files.index')->with('success', 'File uploaded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(File $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(File $file)
    {
        if (Gate::allows('delete-file', $file)) {
            Storage::disk('public')->delete($file->path);

            $file->delete();
            return redirect()->route('files.index')->with('success', 'File Deleted successfully.');
        } else {
            return redirect()->route('files.index')->with('error', 'You are not authorized to delete this file.');
        }
    }
}
