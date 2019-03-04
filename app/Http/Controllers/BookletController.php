<?php

namespace App\Http\Controllers;
use App\Events\BookletCreated;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Booklet;
use App\SalesAgreement;
use App\User;
use Illuminate\Support\Facades\DB;


class BookletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        if (\Gate::allows('isAdmin') || \Gate::allows('isAuthor')) {
           return Booklet::latest()->paginate(5);
           

            
        }
    }

    public function showHasBooklet(){

        if (\Gate::allows('isAdmin') || \Gate::allows('isAuthor')) {
            
             
         }
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function showselect(){
        if (\Gate::allows('isAdmin') || \Gate::allows('isAuthor')) {
            return User::where('type','consultant')->get();
          
        }
        
    }

    public function createSA(Request $request){
       
    
}
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'nameAssign' => 'required',
            'f1' => 'required | integer | min:1',
            'f2' => 'required | integer '
        ]);
        $f1 = (int)$request['f1'];
        $f2 = (int)$request['f2'];
        $bookNum = $f1."-".$f2;
        $booklet = Booklet::create([
            'f1' =>  $f1,
            'nameAssign' => $request['nameAssign'],
            'f2' => $f2,  
            'bookletNumber' => $bookNum
            
        ]);
        
        $user =(int) $request['nameAssign'];
        $arr = [];
        foreach(range($f1,$f2) as $val){
           $arr [] = SalesAgreement::create([
            'saNumber' => $val,
            'user_id' => $user
           ]);
       
    }
    

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $booklet = Booklet::findOrFail($id);

        $this->validate($request,[
            'nameAssign' => 'required',
            'f1' => 'required | numeric | min:1',
            'f2' => 'required | numeric'
        ]);
        $f1 = (int)$request['f1'];
        $f2 = (int)$request['f2'];
        $bookNum = $f1."-".$f2;
        $booklet->update([
            'user_id' =>  (int)$request['nameAssign'],
            'f1' => $f1,
            'f2' => $f2,
            'bookletNumber' => $bookNum
        ]);
        return ['message' => 'Updated the booklet info'];
    }
    public function search(){

        if ($search = \Request::get('q')) {
            $booklets = Booklet::where(function($query) use ($search){
                $query->where('nameAssign','LIKE',"%$search%")
                        ->orWhere('bookNumber','LIKE',"%$search%");
            })->paginate(20);
        }else{
            $booklets = User::latest()->paginate(5);
        }

        return $booklets;

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');

        $booklet = Booklet::findOrFail($id);
        // delete the user

        $booklet->delete();

        return ['message' => 'User Deleted'];
    }
}
