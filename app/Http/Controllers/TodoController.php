<?php

namespace App\Http\Controllers;

use App\Http\Requests\ToDoRequest;
use App\Http\Requests\ToDoUpdateRequest;
use App\Models\Tag;
use App\Models\Todo;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Todo::with('tags')->orderByDesc('id')->get();
        return view('main', compact('tasks'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ToDoRequest $request)
    {

        $data = $request->validated();
        $image = $data['max_img'];
        $data['max_img'] = Storage::disk('public')->put('/images', $data['max_img']);

        $destinationPath = public_path('storage/images/resized');
        $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $img = Image::make($image->path());
        $img->resize(150, 150)->save($destinationPath.'/'.$filename);
        $data['min_img'] = 'images/resized/'.$img->filename.".".$img->extension;
        /*
        $tags = $data['tag'];
        unset($data['tag']);
        $tags = explode(',', $tags);
        $arrTask = [];
        foreach($tags as $tag){
            $arrTask[] = trim($tag);
        }
*/
        $task = Todo::create($data);
//        dd($task);
 /*       $tag_ids= [];
        foreach($arrTask as $item){
            $tag_ids[] = Tag::firstOrCreate(['name' => $item]);
        }

        foreach($tag_ids as $item){
            $task->tags()->attach([$item->id]);
        }

        $task['tags'] = $tag_ids;
        $task->tags()->attach([1, 3]);
        $arrTask[] = trim($task);
*/
        return $task;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $task)
    {
        return view('edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ToDoUpdateRequest $request, Todo $task)
    {

        $data = $request->validated();

        if(isset($data['max_img'])){
            $image = $data['max_img'];
            $data['max_img'] = Storage::disk('public')->put('/images', $data['max_img']);
            $destinationPath = public_path('storage/images/resized');
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $img = Image::make($image->path());
            $img->resize(150, 150)->save($destinationPath.'/'.$filename);
            $data['min_img'] = 'images/resized/'.$img->filename.".".$img->extension;
        }

        $task->update($data);
        return redirect()->route('todo_index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $task)
    {
        $task->delete();
        return redirect()->route('todo_index');
    }
}
