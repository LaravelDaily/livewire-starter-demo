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

        <ul class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            @foreach($categories as $category)
                <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                    <div class="flex items-center ps-3">
                        <input wire:model="selectedCategories" id="{{ $category->id }}-checkbox-list" type="checkbox" value="{{ $category->id }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="{{ $category->id }}-checkbox-list" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $category->name }}</label>
                    </div>
                </li>
            @endforeach
        </ul>

        <div>
            <flux:button variant="primary" type="submit">{{ __('Save') }}</flux:button>
        </div>
    </form>
</section>
