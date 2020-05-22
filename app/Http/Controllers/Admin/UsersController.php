<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\User;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all()->sortby('created_at');

        return view('admin/index',['users' => $users]);
    }

    public function add() 
    {
        $users = User::all(); 

        return view('admin.create');
    }

    public function create(Request $request)
    {
        $this->validate($request, User::$rules);
        
        $form = $request->all();
        
        unset($form['_token']);
        
        $users = new User;
        $users->name = $form['name'];
        $users->password = Hash::make($form['password']);

        // $users->fill($form);
        // dd($users);
        $users->save();

        // User::create([
        //     'name' => $request['name'],
        //     'password' => Hash::make($request['password']),
        // ]);

        return redirect('admin/index');
    }

    public function edit(Request $request)
    {
        $users = User::find($request->id);
        // dd($sales);
        return view('admin/edit',['users' => $users]);
    }

    public function update(Request $request)
    {
        $this->validate($request, User::$rules);

        $users = User::find($request->id);
        // dd($users);        
        $user = $request->all();
        unset($user['_token']);
        // dd($users);
        $users->fill($user);

        $users->save();

        return redirect('admin/index');
    }

    public function pass_set(Request $request)
    {
        $users = User::find($request->id);
        // dd($sales);
        return view('admin/pass_set',['users' => $users]);
    }

    public function pass_reset(Request $request)
    {
        $this->validate($request, User::$rules);
        
        $form = $request->all();
        
        unset($form['_token']);
        
        $users = User::find($request->id);

        $users->name = $form['name'];
        $users->password = Hash::make($form['password']);

        $users->save();

        return redirect('admin/index');
    }
    
    public function delete(Request $request)
    {
        $sales = User::find($request->id);
        $sales->delete();

        return redirect('admin/index');
    }
}
