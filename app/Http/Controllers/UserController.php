<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Support\Facades\Storage;
use Validator;
use Illuminate\Support\Facades\Gate;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware(function($request, $next){
            if(Gate::allows('manage-users')) return $next($request);
            abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }

    public function index(Request $request)
    {

        $user = User::paginate(10);
        if($request->get('key')){
            $user = User::where('email', 'LIKE','%$request->key%')->paginate(10);
            
        }
        return view('pages.user.index', compact('user'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $data['roles'] = json_encode($request->roles);
        if($request->file('avatar')){
            $data['avatar'] = $request->file('avatar')->store('assets/avatar','public');
        }

        User::create($data);
        return redirect()->route('user.index')->with('status','user has been created');

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
        $user = User::findOrFail($id);
        return view('pages.user.edit', compact('user'));
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

        Validator::make($request->all(), [
            "name" => "required|min:5|max:100",
            "roles" => "required",
            "phone" => "required|digits_between:10,12",
            "address" => "required|min:20|max:200",
            'username' => 'required|string|min:5|max:20'
        ])->validate();

       

        $user = User::findOrFail($id);
        $data = $request->all();
        $data['roles'] = json_encode($request->roles);
     
        if($request->file('avatar')){
            if($user->avatar && file_exists(storage_path('app/public/'. $user->avatar))){
                Storage::delete('public/'.$user->avatar);                
            }
            $data['avatar'] = $request->file('avatar')->store('assets/avatar','public');
        }
       
        
        $user->update($data);
        return redirect()->route('user.index')->with('status','data berhasil diubah');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
         if($user->avatar && file_exists(storage_path('app/public/'. $user->avatar))){
                Storage::delete('public/'.$user->avatar);                
            }
        
        
         $user->delete();
        return redirect()->route('user.index')->with('status','data berhasil dihapus');
    }
}
