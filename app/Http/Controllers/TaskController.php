<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TaskController extends Controller
{
	use AuthorizesRequests;

	public function index(): View
	{
		return $this->renderTaskList();
	}

	public function due(): View
	{
		return $this->renderTaskList(onlyDue: true);
	}

	public function create(): View
	{
		return view('tasks.create');
	}

	public function store(StoreTaskRequest $request): RedirectResponse
	{
		$task = auth()->user()->tasks()->create([
			'status'      => 'pending',
			'due_date'    => $request->input('due_date'),
			'title'       => $request->input('title'),
			'description' => $request->input('description'),
		]);

		return redirect()->route('tasks.show', $task);
	}

	public function show(Task $task): View
	{
		$this->authorize('view', $task);
		return view('tasks.show', compact('task'));
	}

	public function edit(Task $task): View
	{
		$this->authorize('update', $task);
		return view('tasks.edit', compact('task'));
	}

	public function update(StoreTaskRequest $request, Task $task): RedirectResponse
	{
		$this->authorize('update', $task);

		$task->update([
			'due_date'    => $request->input('due_date'),
			'title'       => $request->input('title'),
			'description' => $request->input('description'),
		]);

		return redirect()->route('tasks.show', $task);
	}

	public function destroy(Task $task): RedirectResponse
	{
		$this->authorize('delete', $task);
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

	private function renderTaskList(bool $onlyDue = false): View
	{
		$query = auth()->user()->tasks();

		if ($onlyDue) {
			$query->whereDate('due_date', '<=', today());
		}

		$sortBy  = request('sort');
		$sortDir = request('dir');

		if (in_array($sortBy, ['created_at', 'due_date']) && in_array($sortDir, ['asc', 'desc'])) {
			$query->orderBy($sortBy, $sortDir);
		} else {
			$query->latest();
		}

		$tasks = $query->paginate(8);

		return view('tasks.index', compact('tasks'))
			->with(['sortBy' => $sortBy, 'sortDir' => $sortDir]);
	}
}
