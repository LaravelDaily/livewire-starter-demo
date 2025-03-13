<section class="max-w-5xl">
    <form wire:submit="save" class="flex flex-col gap-6">
        <flux:input
            wire:model="name"
            :label="__('Task Name')"
            required
            badge="required"
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

        <div>
            <flux:button variant="primary" type="submit">{{ __('Save') }}</flux:button>
        </div>
    </form>
</section>
