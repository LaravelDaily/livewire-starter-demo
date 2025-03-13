<section>
    <x-alerts.success />

    <div class="flex flex-grow gap-x-4 mb-4">
        <flux:button href="{{ route('tasks.create') }}" variant="filled">{{ __('Create Task') }}</flux:button>
        <flux:button href="{{ route('task-categories.index') }}" variant="filled">{{ __('Manage Task Categories') }}</flux:button>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Task
                    </th>
                    <th scope="col" class="px-6 py-3">
                        File
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Categories
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $task->name }}
                        </th>
                        <td class="px-6 py-4">
                            @if($task->media_file)
                                <a href="{{ $task->media_file->original_url }}" target="_blank">
                                    <img src="{{ $task->media_file->original_url }}" alt="{{ $task->name }}" class="w-8 h-8" />
                                </a>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <span @class([
                                'text-green-600' => $task->is_completed,
                                'text-red-700' => ! $task->is_completed,
                            ])>
                                {{ $task->is_completed ? 'Completed' : 'In progress' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 space-x-1">
                            @foreach($task->taskCategories as $category)
                                <span class="rounded-full bg-gray-200 px-2 py-1 text-xs">
                                    {{ $category->name }}
                                </span>
                            @endforeach
                        </td>
                        <td class="px-6 py-4 space-x-2">
                            <flux:button href="{{ route('tasks.edit', $task) }}" variant="filled">{{ __('Edit') }}</flux:button>
                            <flux:button wire:confirm="Are you sure?" wire:click="delete({{ $task->id }})" variant="danger" type="button">{{ __('Delete') }}</flux:button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($tasks->hasPages())
        <div class="mt-5">
            {{ $tasks->links() }}
        </div>
    @endif
</section>
