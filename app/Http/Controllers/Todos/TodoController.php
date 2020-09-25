<?php

namespace App\Http\Controllers\Todos;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use App\Notifications\TodoNotification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Store All users
     */
    public $users;
    /**
     * Construct
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->users=User::getAllUsers();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       /*  $todos=Todo::all()->reject(function($todo){
            return $todo->done==0;
        }); */

        $userId=Auth::user()->id;
        $users=$this->users;
        $todos=Todo::where(['affectedTo_id'=>$userId])->orderBy('id','desc')->paginate(6);

        return view('todos.index',compact('todos','users'));

    }
    /**
     * Undocumented function
     * @param Todo $todo
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function affectedTo(Todo $todo,User $user){

        $todo->affectedTo_id=$user->id;
        $todo->affectedBy_id=Auth::user()->id;
        $todo->update();
        $user->notify(new TodoNotification($todo));
        return back();
    }
    //display All todos not completed
    public function notCompleted(){
        $todos = Auth::user()->todos()->where('done', 0)->paginate(6);
        $users=$this->users;
        return view('todos.index',compact('todos','users'));
    }
    //display All todos not completed
    public function completed(){
        $todos = Auth::user()->todos()->where('done', 1)->paginate(6);
        $users=$this->users;
        return view('todos.index',compact('todos','users'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'title' => ['required','min:3'],
            'content' => ['required','min:6' ],
        ]);
        $todo=new Todo();
        $todo->createdBy_id=Auth::user()->id;
        $todo->affectedTo_id=Auth::user()->id;
        $todo->title=$request->title;
        $todo->content=$request->content;
        if($todo->save()){

            notify()->success("Todo <span class='badge badge-dark'>#$todo->id</span>has been created successfully");
        }
        return redirect()->route('todos.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  Todo $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Todo $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        return view('todos.edit',compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Todo   $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {

        if(!isset($request->done)){
            $request['done']=0;
        }

        if( $todo->update($request->all())){

            notify()->success("Todo <span class='badge badge-dark'>#$todo->id</span>has been updated successfully");
             }
        return redirect()->route('todos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        if($todo->delete()){
        notify()->error("Todo <span class='badge badge-dark'>#$todo->id</span>has been deleted successfully");
         }
        return back();
    }
    /**
     * Make todo completed
     * @param Todo $todo
     */
    public function makeCompleted(Todo $todo){
        $todo->done=1;
        if($todo->update()){
            notify()->success("Todo <span class='badge badge-dark'>#$todo->id</span>has been completed");
        }
        return back();

    }

    /**
     * Make todo Not completed
     * @param Todo $todo
     */
    public function makeNotCompleted(Todo $todo){
        $todo->done=0;
        if($todo->update()){
            notify()->success("Todo <span class='badge badge-dark'>#$todo->id</span>has been not completed");
        }
        return back();

    }


}
