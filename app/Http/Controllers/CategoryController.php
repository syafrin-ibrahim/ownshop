<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Gate;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware(function($request, $next){
            if(Gate::allows('manage-categories')) return $next($request);
            abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }

    public function index(Request $request)
    {
        $categ = Category::paginate(10);
        if($request->key){

        }
        return view('pages.category.index', compact('categ'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
       $data = $request->all();
       $data['created_by'] = Auth::user()->id;
       $data['slug']  = Str::slug($request->name,'-');
       if($request->file('image')){
           $data['image'] = $request->file('image')->store('category','public');

       }
       Category::create($data);
       return redirect()->route('category.index')->with('status','data berhasil disimpan');
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
        $categ = Category::findOrFail($id);
        return view('pages.category.edit', compact('categ'));
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
        Validator::make($request->all(),[
            'name' => 'required|min:3|max:50',
            'image' => 'image'
        ])->validate();
        $categ =  Category::findOrFail($id);
      
        $data =  $request->all();
        $data['slug'] = Str::slug($request->name,'-');
        if($request->file('image')){
                if($categ->image && file_exists(storage_path('app/public/'.$categ->image))){
                    Storage::delete('public/'.$categ->image);
                    // Storage::delete('public/'.$user->avatar); 
                }
            $data['image'] = $request->file('image')->store('category', 'public');
        }
        $categ->update($data);
        return redirect()->route('category.index')->with('status','data berhasil diubah');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categ = Category::findOrFail($id);
        
         if($categ->image && file_exists(storage_path('app/public/'. $categ->image))){
                Storage::delete('public/'.$categ->image);                
            }
        
        
         $categ->delete();
        return redirect()->route('category.index')->with('status','data berhasil dihapus');
    }
}
