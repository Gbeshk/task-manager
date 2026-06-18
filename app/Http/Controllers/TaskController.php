<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
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
		$task = auth()->user()->tasks()->make([
			'status'   => 'pending',
			'due_date' => $request->input('due_date'),
		]);

		$this->applyTranslations($task, $request);
		$task->save();

		return redirect()->route('tasks.show', $task);
	}

	public function show(Task $task): View
	{
		Gate::authorize('owns', $task);
		return view('tasks.show', compact('task'));
	}

	public function edit(Task $task): View
	{
		Gate::authorize('owns', $task);
		return view('tasks.edit', compact('task'));
	}

	public function update(StoreTaskRequest $request, Task $task): RedirectResponse
	{
		Gate::authorize('owns', $task);

		$task->update(['due_date' => $request->input('due_date')]);
		$this->applyTranslations($task, $request);
		$task->save();

		return redirect()->route('tasks.show', $task);
	}

	public function destroy(Task $task): RedirectResponse
	{
		Gate::authorize('owns', $task);
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

	private function applyTranslations(Task $task, StoreTaskRequest $request): void
	{
		$task->setTranslations('title', [
			'en' => $request->input('title_en'),
			'ka' => $request->input('title_ka'),
		]);

		$task->setTranslations('description', [
			'en' => $request->input('description_en', ''),
			'ka' => $request->input('description_ka', ''),
		]);
	}
}
