<section class="max-w-5xl">
    <form wire:submit="save" class="flex flex-col gap-6">
        <flux:input
            wire:model="name"
            :label="__('Task Name')"
            required
            badge="required"
        />

        <flux:switch
            wire:model="is_completed"
            label="Completed?"
            align="left"
        />

        <flux:input
            wire:model="due_date"
            type="date"
            :label="__('Due Date')"
        />

        <flux:input
            wire:model="media"
            type="file"
            :label="__('Media')"
        />

        @if($task->media_file)
            <a href="{{ $task->media_file->original_url }}" target="_blank">
                <img src="{{ $task->media_file->original_url }}" alt="{{ $task->name }}" class="w-32 h-32" />
            </a>
        @endif

        <div>
            <flux:button variant="primary" type="submit">{{ __('Save') }}</flux:button>
        </div>
    </form>
</section>
