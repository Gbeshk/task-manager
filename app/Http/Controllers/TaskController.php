<?php

namespace App\Http\Controllers;

use App\Models\Task;

class TaskController extends Controller
{
	public function index()
	{
		$tasks = auth()->user()->tasks()->latest()->paginate(8);

		return view('dashboard', compact('tasks'));
	}

	public function destroy(Task $task)
	{
		abort_if($task->user_id !== auth()->id(), 403);

		$task->delete();

		return back();
	}
}
