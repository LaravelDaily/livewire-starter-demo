<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use Livewire\Component;
use Illuminate\View\View;
use App\Models\TaskCategory;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

class Edit extends Component
{
    use WithFileUploads;

    #[Validate('required|string|max:255')]
    public string $name;

    #[Validate('nullable|boolean')]
    public bool $is_completed;

    #[Validate('nullable|date')]
    public ?string $due_date;

    #[Validate('nullable|file|max:10240')]
    public $media;

    #[Validate([
        'selectedCategories'   => ['nullable', 'array'],
        'selectedCategories.*' => ['exists:task_categories,id'],
    ])]
    public array $selectedCategories = [];

    public Task $task;

    public function mount(Task $task): void
    {
        $this->task = $task;
        $this->task->load('media', 'taskCategories');
        $this->name = $task->name;
        $this->is_completed = $task->is_completed;
        $this->due_date = $task->due_date?->format('Y-m-d');
        $this->selectedCategories = $task->taskCategories->pluck('id')->toArray();
    }

    public function save(): void
    {
        $this->validate();

        $this->task->update([
            'name'         => $this->name,
            'is_completed' => $this->is_completed,
            'due_date'     => $this->due_date ?? null,
        ]);

        if ($this->media) {
            $this->task->getFirstMedia()?->delete();
            $this->task->addMedia($this->media)->toMediaCollection();
        }

        $this->task->taskCategories()->sync($this->selectedCategories ?? []);

        session()->flash('success', 'Task successfully updated.');

        $this->redirectRoute('tasks.index', navigate: true);
    }

    public function render(): View
    {
        return view('livewire.tasks.edit', [
            'categories' => TaskCategory::all(),
        ]);
    }
}
