<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use App\Models\TaskCategory;
use Illuminate\Database\Eloquent\Builder;

class Index extends Component
{
    use WithPagination;

    #[Url(as: 'categories', except: '')]
    public ?array $selectedCategories = [];

    public function delete(int $id): void
    {
        Task::where('id', $id)->delete();

        session()->flash('success', 'Task successfully deleted.');
    }

    public function render(): View
    {
        info($this->selectedCategories);
        return view('livewire.tasks.index', [
            'tasks'      => Task::query()
                ->with('media', 'taskCategories')
                ->when($this->selectedCategories, function (Builder $query) {
                    $query->whereHas('taskCategories', function (Builder $query) {
                        $query->whereIn('id', $this->selectedCategories);
                    });
                })
                ->paginate(5),
            'categories' => TaskCategory::all(),
        ]);
    }
}
