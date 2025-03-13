<?php

namespace App\Livewire\TaskCategories;

use Livewire\Component;
use Illuminate\View\View;
use App\Models\TaskCategory;
use Livewire\Attributes\Validate;

class Create extends Component
{
    #[Validate('required|string|max:255')]
    public string $name = '';

    public function save(): void
    {
        $this->validate();

        TaskCategory::create([
            'name' => $this->name,
        ]);

        session()->flash('success', 'Task category successfully created.');

        $this->redirectRoute('task-categories.index', navigate: true);
    }

    public function render(): View
    {
        return view('livewire.task-categories.create');
    }
}
