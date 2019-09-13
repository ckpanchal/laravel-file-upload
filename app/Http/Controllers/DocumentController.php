<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $docs = Document::all();
        return view('document.index', ['docs' => $docs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('document.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reqData = $request->input();
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $name = time() . rand(11111, 99999) . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('docs');
            $file->move($destinationPath, $name);
            $reqData['file_url'] = $name;
        }
        $newFile = Document::create($reqData);
        if ($newFile) {
            $request->session()->flash('success', 'Data successfully added');
        } else {
            $request->session()->flash('error', 'Data successfully added');
        }
        return redirect('document');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $doc = Document::find($id);
        if ($doc) {
            return view('document.edit', [ 'doc' => $doc ]);
        } else {
            return redirect('document')->with('error', 'File not found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $document = Document::find($id);
        if (!$document) {
            return redirect('document')->with('error', 'Data not found');
        }

        if ($document->file_url == null) {
            $oldImage = '';
        } else {
            $oldImage = $document->file_url;
        }

        $updateData = $request->input();

        // Supplier Image
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $name = time() . rand(11111, 99999) . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('docs/');
            $file->move($destinationPath, $name);
            $updateData['file_url'] = $name;            
            
            // Delete Old supplier_image
            if (!empty($oldImage)) {
                if (\File::exists(public_path('docs/' . $oldImage))) {
                    \File::delete(public_path('docs/' . $oldImage));
                }
            }
        }

        $docStatus = $document->update($updateData);

        if ($docStatus) {
            return redirect('document')->with('success', 'Data successfully updated.');
        } else {
            return redirect()->route('document.edit', ['id' => 1])->with('error', 'Oops something went wrong. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $document = Document::find($id);
        if (!$document) {
            $respStatus = 'error';
            $respMsg = 'Data not found';
        }

        // Delete file
        $fileUrl = $document->file_url;
        if (\File::exists(public_path('docs/'.$fileUrl))) {
            \File::delete(public_path('docs/'.$fileUrl));
        }

        $isDocDeleted = $document->delete();
        if ($isDocDeleted) {
            $respStatus = 'success';
            $respMsg = 'Data deleted successfully';
        }
        return redirect('document')->with($respStatus, $respMsg);
    }
}
