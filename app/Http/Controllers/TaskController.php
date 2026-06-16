<?php

namespace App\Http\Controllers;

use App\Models\Task;

class TaskController extends Controller
{
	private function applySorting($query)
	{
		$sortBy = request('sort');
		$sortDir = request('dir');

		if (in_array($sortBy, ['created_at', 'due_date']) && in_array($sortDir, ['asc', 'desc'])) {
			$query->orderBy($sortBy, $sortDir);
		} else {
			$query->latest();
		}

		return $query;
	}

	public function index()
	{
		$tasks = $this->applySorting(auth()->user()->tasks())->paginate(8);

		return view('dashboard', compact('tasks'))
			->with(['sortBy' => request('sort'), 'sortDir' => request('dir')]);
	}

	public function destroy(Task $task)
	{
		abort_if($task->user_id !== auth()->id(), 403);
		$task->delete();
		return back();
	}

	public function destroyOld()
	{
		auth()->user()->tasks()
			->whereDate('due_date', '<', today())
			->delete();
		return back();
	}

	public function due()
	{
		$tasks = $this->applySorting(
			auth()->user()->tasks()->whereDate('due_date', '<', today())
		)->paginate(8);

		return view('dashboard', compact('tasks'))
			->with(['sortBy' => request('sort'), 'sortDir' => request('dir')]);
	}
}
