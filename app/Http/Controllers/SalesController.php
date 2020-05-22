<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Sales;

use App\Clients;
use App\User;

use Illuminate\Support\Facades\Auth;

use DB;

class SalesController extends Controller
{

    public function index(Request $request)
    {
        // $sales = Sales::all()->sortby('created_at');

        // $sales = DB::table('sales')
        //             ->join('users', 'sales.pic_id', '=', 'users.id')
        //             ->get();
        
        $sales = Sales::select(
                    'sales.id',
                    'sales.title',
                    'sales.status',
                    'sales.location',
                    'sales.client_id',
                    'users.name',
                    'clients.pic_name',
                    'clients.corp_name',
                    'sales.created_at',
                    'sales.updated_at')
                    ->join('users', 'sales.pic_id', '=', 'users.id')
                    ->join('clients', 'sales.client_id', '=', 'clients.id')
                    ->paginate(10);

        // dd($sales);
        
        // ページ数
        // $sales = Sales::paginate(10);
        // $users = User::all();

        // return view('sales/index',['sales' => $sales,'users' => $users]);
        return view('sales/index',['sales' => $sales]);
    }
    
    public function add() 
    {
        $sales = Sales::all();
        $users = User::all();
        $clients = Clients::all();

        return view('sales.create',["sales" => $sales,'users' => $users,'clients' => $clients]);
    }

    public function create(Request $request)
    {
        $this->validate($request, Sales::$rules);
        
        $form = $request->all();
        
        unset($form['_token']);
        
        $sales = new Sales;
        $sales->fill($form);
        // dd($sales);
        $sales->save();

        return redirect('sales/index');
    }

    public function search()
    {
        $users = User::all();
        $clients = Clients::all();

        return view('sales/search',['users' => $users,'clients' => $clients]);
    }

    public function result(Request $request)
    {
        $serach_pic_id = $request->input('serach_pic_id');
        $serach_client_id = $request->input('serach_client_id');
        $serach_title = $request->input('serach_title');
        $serach_content = $request->input('serach_content');
        $serach_location = $request->input('serach_location');
        $serach_skill = $request->input('serach_skill');
        $serach_term = $request->input('serach_term');
        $serach_proponent = $request->input('serach_proponent');
        $serach_note = $request->input('serach_note');
        $serach_status = $request->input('serach_status');
        //日付検索
        $serach_created_from = $request->input('created_from');
        $serach_created_until = $request->input('created_until');
        $serach_updated_from = $request->input('updated_from');
        $serach_updated_until = $request->input('updated_until');

        $query = Sales::query();

        $query = $query->select(
            'sales.id',
            'sales.title',
            'sales.content',
            'sales.location',
            'sales.term',
            'sales.skill',
            'sales.proponent',
            'sales.note',
            'sales.status',
            'sales.pic_id',
            'sales.client_id',
            'users.name',
            'clients.pic_name',
            'clients.corp_name',
            'sales.created_at',
            'sales.updated_at',);

        $query->join('users', 'sales.pic_id', '=', 'users.id');
        $query->join('clients', 'sales.client_id', '=', 'clients.id');

        //日付検索
        if (!empty($serach_created_from) && !empty($serach_created_until)) {
            $query->whereBetween("sales.created_at", [$serach_created_from, $serach_created_until]);
        }

        if (!empty($serach_updated_from) && !empty($serach_updated_until)) {
            $query->whereBetween("sales.updated_at", [$serach_updated_from, $serach_updated_until]);
        }

        if(!empty($serach_pic_id)) {
            $query->where('pic_id',$serach_pic_id);
        }
        if(!empty($serach_client_id)) {
            $query->where('client_id',$serach_client_id);
        }

        if(!empty($serach_title)) {
            $query->where('title','like', '%'.$serach_title.'%');
        }

        if(!empty($serach_content)) {
            $query->where('content','like', '%'.$serach_content.'%');
        }

        if(!empty($serach_location)) {
            $query->where('location','like', '%'.$serach_location.'%');
        }

        if(!empty($serach_skill)) {
            $query->where('skill','like', '%'.$serach_skill.'%');
        }

        if(!empty($serach_term)) {
            $query->where('term','like', '%'.$serach_term.'%');
        }

        if(!empty($serach_proponent)) {
            $query->where('proponent','like', '%'.$serach_proponent.'%');
        }
        
        if(!empty($serach_note)) {
            $query->where('note','like', '%'.$serach_note.'%');
        }

        if($serach_status == "提案前") {
            $query->where('status',"提案前");
        }elseif($serach_status == "提案中") {
            $query->where('status',"提案中");
        }elseif($serach_status == "面談前") {
            $query->where('status',"面談前");
        }elseif($serach_status == "結果待ち") {
            $query->where('status',"結果待ち");
        }elseif($serach_status == "終了") {
            $query->where('status',"終了");
        }
        
        $sales = $query->paginate(10);

        $count = count($sales);

        return view('sales/result',['sales' => $sales,'count' => $count]);
    }

    public function edit(Request $request)
    {
        // $sales = Sales::find($request->id);
        
        $sales = Sales::select(
            'sales.id',
            'sales.title',
            'sales.content',
            'sales.location',
            'sales.term',
            'sales.skill',
            'sales.proponent',
            'sales.note',
            'sales.status',
            'sales.pic_id',
            'sales.client_id',
            'users.name',
            'clients.pic_name',
            'clients.corp_name',
            'sales.created_at',
            'sales.updated_at')
            ->join('users', 'sales.pic_id', '=', 'users.id')
            ->join('clients', 'sales.client_id', '=', 'clients.id')
            ->find($request->id);
        // dd($sales);

        $users = User::all(); 
        $clients = Clients::all(); 

        return view('sales/edit',['sales' => $sales,'users' => $users,'clients' => $clients]);
    }

    public function update(Request $request)
    {
        $this->validate($request, Sales::$rules);

        $sales = Sales::find($request->id);

        $sale = $request->all();
        unset($sale['_token']);
        
        $sales->fill($sale);
        $sales->save();

        return redirect('sales/index');
    }

    public function delete(Request $request)
    {
        $sales = Sales::find($request->id);
        $sales->delete();

        return redirect('sales/index');
    }

}
