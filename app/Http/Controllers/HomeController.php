<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
use DB;
use App\Events\newMessage;

class HomeController extends Controller
{

    public $friend;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['friend_id']=0;
        $id = Auth::user()->id;
        $data['users'] = DB::table('users')->select('users.*')->where('users.id','!=',$id)->get();
        
        return view('home',$data);
    }

    public function chooseFri(Request $request){
        $id2 = $request->friend_id;
        $id = Auth::user()->id;
        $friend=DB::table('users')->where('users.id','=',$id2)->first();
        $messages=DB::table('messages')
                    ->where([['sender_id','=',$id],['receiver_id','=',$id2]])
                    ->orwhere([['sender_id','=',$id2],['receiver_id','=',$id]])
                    ->get();
  
        return response()->json(['choosing friend with success'=>true,'messages'=>$messages,'friend'=>$friend]);
    }

    public function sendMsg(Request $request){

        $id2 = $request->friend_id;
        $id = Auth::user()->id;
        $msg = $request->message;
        
        $arr = array('text'=>$msg,'sender_id'=>$id,'receiver_id'=>$id2,'created_at'=>date('Y-m-d H:i:s'));
        DB::table('messages')->insert($arr);

        $friend=DB::table('users')->select('id','name')->where('users.id','=',$id2)->first();
        
        event(new newMessage(['sending msg with success'=>true,'friend'=>$friend,'sender_id'=>$id, 'msg'=>$msg]));
        return response()->json(['sending msg with success'=>true,'friend'=>$friend,'sender_id'=>$id, 'msg'=>$msg]);
    }

    

}
