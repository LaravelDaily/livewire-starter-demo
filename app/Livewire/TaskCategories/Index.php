<?php

namespace App\Livewire\TaskCategories;

use Livewire\Component;
use Illuminate\View\View;
use App\Models\TaskCategory;

class Index extends Component
{
    public function delete(int $id): void
    {
        $taskCategory = TaskCategory::findOrFail($id);

        if ($taskCategory->tasks()->count() > 0) {
            $taskCategory->tasks()->detach();
        }

        $taskCategory->delete();
    }

    public function render(): View
    {
        return view('livewire.task-categories.index', [
            'taskCategories' => TaskCategory::withCount('tasks')->paginate(5),
        ]);
    }
}
