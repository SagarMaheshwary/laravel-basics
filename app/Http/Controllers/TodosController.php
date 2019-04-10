<?php

namespace App\Http\Controllers;

use Auth;
use App\Todo;
use Illuminate\Http\Request;

class TodosController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | TodosController
    |--------------------------------------------------------------------------
    | This controller will be responsible for creating, retrieving, updating
    | and deleting todos from the database.
    |
    */

    /**
     * PHP magic method that runs when the
     * class instance is created.
     * 
     * @return void
     */
    public function __construct(){

        /**
         * Only authenticated users may access 
         * all the methods.
         * 
         * Note: pass an array of strings if you
         * have multiple middleware.
         */
        $this->middleware('auth');

        /**
         * Chain it with except('method') method
         * if you want to exclude certain methods.
         * 
         * Note: Just like middleware except() can also
         * take an array of strings.
         */
    }

    /**
     * Display the the Todos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get the authentication user.
        $user = Auth::user();

        //get all the todos that belong to the user with pagination.
        $todos = $user->todos()->orderBy('created_at','desc')->paginate(8);

        //return a view with all the todos.
        return view('todos.index',[
            'todos' => $todos,
        ]);
    }

    /**
     * Show the form for creating a new Todo.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todos.create');
    }

    /**
     * Store a new Todo in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation rules
        $rules = [
            'title' => 'required|string|unique:todos,title|min:2|max:191',
            'body'  => 'required|string|min:5|max:1000',
        ];

        //custom validation error messages
        $messages = [
            'title.unique' => 'Todo title should be unique',
        ];

        //First Validate the form data
        $request->validate($rules,$messages);

        //Create a Todo
        $todo          = new Todo;
        $todo->title   = $request->title;
        $todo->body    = $request->body;
        $todo->user_id = Auth::id();
        $todo->save(); // save it to the database.

        //Redirect to a specified route with flash message.
        return redirect()
            ->route('todos.index')
            ->with('status','Created a new Todo!');
    }

    /**
     * Display a specified Todo.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Find a Todo by it's ID
        $todo = Todo::findOrFail($id);

        return view('todos.show',[
            'todo' => $todo,
        ]);
    }

    /**
     * Show a form for editing a specified Todo.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Find a Todo by it's ID
        $todo = Todo::findOrFail($id);

        return view('todos.edit',[
            'todo' => $todo,
        ]);
    }

    /**
     * Update a specified Todo from the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validation rules
        $rules = [
            'title' => "required|string|unique:todos,title,{$id}|min:2|max:191",
            'body'  => 'required|string|min:5|max:1000',
        ];

        //custom validation error messages
        $messages = [
            'title.unique' => 'Todo title should be unique',
        ];

        //First Validate the form data
        $request->validate($rules,$messages);

        //Update the Todo
        $todo        = Todo::findOrFail($id);
        $todo->title = $request->title;
        $todo->body  = $request->body;
        $todo->save(); //Can be used for both creating and updating

        //Redirect to a specified route with flash message.
        return redirect()
            ->route('todos.show',$id)
            ->with('status','Updated the selected Todo!');
    }

    /**
     * Remove the specified Todo from the database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Delete the Todo
        $todo = Todo::findOrFail($id);
        $todo->delete();

        // Todo::destroy([id]) is also avaliable

        //Redirect to a specified route with flash message.
        return redirect()
            ->route('todos.index')
            ->with('status','Deleted the selected Todo!');
    }
}
