<?php

namespace App\Http\Controllers;

use App\Services\TaskServiceInterface;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private TaskServiceInterface $taskService;

    function __construct(TaskServiceInterface $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index(){
        $tasks = $this->taskService->getAllTasks();
        return response()->json($tasks);
    }

    public function show($id){
        $task = $this->taskService->getTaskById($id);
        return response()->json($task);
    }

    public function store(Request $request){
        $this->taskService->AddTask($request->all());
        return response()->json('Task added successfully');
    }

    public function update(Request $request, $id){
        $task = $this->taskService->getTaskById($id);
        $this->taskService->UpdateTask($id, $request->all());
        return response()->json('Task updated successfully', $task);
    }

    public function destroy($id){
        $task = $this->taskService->getTaskById($id);
        $this->taskService->DeleteTask($id);
        return response()->json('Task deleted successfully', null);
    }
}
