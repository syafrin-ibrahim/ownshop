<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Book;
use App\Category;
class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::with('category')->paginate(10);
        return view('pages.book.index', compact('books'))->with('status','Data Book Berhasil disimpan');
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('pages.book.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        $data['created_by'] =  Auth::user()->id;
        $data['status'] = $request->save_action;
        if($request->file('cover')){
            $data['cover'] = $request->file('cover')->store('book','public');
        }
        Book::create($data);       
        return redirect()->route('book.index')->with('status','Data berhasil disimpan');


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
        $book =  Book::findOrFail($id);
        $category = Category::all();
        return view('pages.book.edit', compact('book','category'));
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
        $book = Book::findOrFail($id);
        
        $data = $request->all();
        $data['slug'] = Str::slug($request->title,'-');
        $data['created_by'] =  Auth::user()->id;
        if($request->file('cover')){
            if($book->cover && file_exists(storage_path('app/public/'.$book->cover))){
                Storage::delete('public/'.$book->cover);
            }
            $data['cover'] = $request->file('cover')->store('book', 'public');
        }
        $book->update($data);
        return redirect()->route('book.index')->with('status','data berhail dihapus');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
      
        if(file_exists(storage_path('app/public/'.$book->cover))){
            Storage::delete('public/'.$book->cover);
        }
        $book->delete();
        return redirect()->route('book.index')->with('status','data berhasil dihapus');
    }
}
