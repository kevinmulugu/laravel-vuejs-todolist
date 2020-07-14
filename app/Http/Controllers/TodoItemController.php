<?php

namespace App\Http\Controllers;

use App\TodoItem;
use Illuminate\Http\Request;

/**
 * Class TodoItemController
 * Created by Kevin Mulugu (kevinmulugu@gmail.com)
 * @package App\Http\Controllers
 */
class TodoItemController extends Controller
{
    /**
     * Show the todos page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('todos');
    }

    /**
     * Returns todos as json response
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function todos(Request $request)
    {
        return response()->json(TodoItem::all());
    }

    /**
     * Creates and stores todoItem to database.
     * @param Request $request
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        /**
         * Valiate the name
         */
        $this->validate($request, [
            'name' => [ 'required',  'string', 'min:5', 'max:50', 'unique:todo_items,name' ]
        ]);

        $todoItem = new TodoItem();
        $todoItem->name = $request->name;
        $todoItem->save();

        return $todoItem;
    }

    /**
     * Updates a todo item
     * @param Request $request
     * @param TodoItem $todoItem
     * @return TodoItem
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, TodoItem $todoItem)
    {
        /**
         * Validate the request,
         * Exempt the current TodoItem if the name has not changed
         */
        $this->validate($request, [
            'name' => [ 'required', 'string', 'min:5', 'max:50', 'unique:todo_items,name,'.$todoItem->id ]
        ]);

        $todoItem->name = $request->name;
        $todoItem->save();

        return $todoItem;
    }

    public function destroy(Request $request, TodoItem $todoItem)
    {
        $todoItem->delete();
        return response()->json(null, 204);
    }
}
