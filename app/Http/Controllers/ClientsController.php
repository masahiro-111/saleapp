<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Clients;

class ClientsController extends Controller
{
    //
    public function index(Request $request)
    {
        $clients = Clients::all()->sortby('created_at');
        // dd($clients);
        return view('clients/index',['clients' => $clients]);
    }

    public function add() 
    {
        return view('clients.create');
    }

    public function create(Request $request)
    {
        $this->validate($request, Clients::$rules);
        
        $form = $request->all();
        
        unset($form['_token']);
        
        $clients = new Clients;
        $clients->fill($form);
        // dd($users);
        $clients->save();

        return redirect('clients/index');
    }

    public function edit(Request $request)
    {
        $clients = Clients::find($request->id);

        return view('clients/edit',['clients' => $clients]);
    }

    public function update(Request $request)
    {
        $this->validate($request, Clients::$rules);

        $clients = Clients::find($request->id);

        $client = $request->all();
        unset($client['_token']);
        
        $clients->fill($client);
        $clients->save();

        return redirect('clients/index');
    }

    public function delete(Request $request)
    {
        $clients = Clients::find($request->id);
        $clients->delete();

        return redirect('clients/index');
    }
}
