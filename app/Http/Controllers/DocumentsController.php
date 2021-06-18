<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use App\Http\Requests\DocumentRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Auth;
use File;


class DocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
         $tahuns = DB::table('documents')
                  ->select('tahun')->distinct()->get();
         $documents = Document::all();
                     
        return view('documents.index', compact('tahuns','documents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $document = new Document();
        return view('documents.upload',compact('document'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocumentRequest $request)
    {
        $user_id = Auth::user()->id;
        $document=new Document();
        if($request->hasFile('file')){
            $file=$request->file('file');
            $filename=$file->getClientOriginalName().time().'.'.$file->getClientOriginalExtension();
            $request->file->move('storage/', $filename);

            $document->file = $filename;
        } 
     
        $document->title=$request->title;
        $document->tahun=$request->tahun;
        $document->description=$request->desc;
        $document->user_id=$user_id;
        // $request->user()->documents()->create($document->only('title','desc','file'));
        $document->save();
        return redirect()->route('documents')->with('success',"Dokumen berhasil disimpan");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Document::find($id);

        return view('documents.detail', compact('data'));
    }

    public function search()
    {
        $search_text= $_GET['query'];
        $documents = Document::where('title','LIKE','%'.$search_text.'%')
                     ->orWhere('description','LIKE','%'.$search_text.'%')
                     ->orWhereHas('user',function($q) use ($search_text) {
                         $q->where('name', 'LIKE','%'.$search_text.'%');
                     })->paginate(6);

        return view('documents.search', compact('documents'));
    }

    public function download($file)
    {
        return response()->download('storage/'.$file);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $documents = Document::find($id);

        return view('documents.edit', compact('documents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
         $document = Document::where('id', $request->id)
                  ->update([
                      'title' => $request->title,
                      'description'  => $request->desc,
                  ]);
                                                         
        return redirect('/documents')->with('success','Dokumen berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $document=Document::where('id', $id)->first();
         File::delete('storage/'.$document->file);

        Document::where('id',$id)->delete();

        return redirect('/documents')->with('success','Dokumen berhasil dihapus');
    }
}
