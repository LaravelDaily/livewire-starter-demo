<?php

namespace App\Livewire\TaskCategories;

use Livewire\Component;
use Illuminate\View\View;
use App\Models\TaskCategory;
use Livewire\Attributes\Validate;

class Edit extends Component
{
    #[Validate('required|string|max:255')]
    public string $name;

    public TaskCategory $taskCategory;

    public function mount(TaskCategory $taskCategory): void
    {
        $this->taskCategory = $taskCategory;
        $this->name = $taskCategory->name;
    }

    public function save(): void
    {
        $this->validate();

        $this->taskCategory->update([
            'name' => $this->name,
        ]);

        session()->flash('success', 'Task category successfully updated.');

        $this->redirectRoute('task-categories.index', navigate: true);
    }

    public function render(): View
    {
        return view('livewire.task-categories.edit');
    }
}
