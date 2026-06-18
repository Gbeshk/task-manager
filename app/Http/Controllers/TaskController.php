<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TaskController extends Controller
{
	private function applySorting(Builder|HasMany $query): Builder|HasMany
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

	private function renderTaskList(bool $onlyDue = false): View
	{
		$query = auth()->user()->tasks();

		if ($onlyDue) {
			$query->whereDate('due_date', '<=', today());
		}

		$tasks = $this->applySorting($query)->paginate(8);

		return view('tasks.index', compact('tasks'))
			->with(['sortBy' => request('sort'), 'sortDir' => request('dir')]);
	}

	public function index(): View
	{
		return $this->renderTaskList();
	}

	public function due(): View
	{
		return $this->renderTaskList(onlyDue: true);
	}

	public function destroy(Task $task): RedirectResponse
	{
		abort_if($task->user_id !== auth()->id(), 403);
		$task->delete();

		return back();
	}

	public function destroyDue(): RedirectResponse
	{
		auth()->user()->tasks()
			->whereDate('due_date', '<=', today())
			->delete();

		return back();
	}

	public function show(Task $task): View
	{
		abort_if($task->user_id !== auth()->id(), 403);

		return view('tasks.show', compact('task'));
	}
}
