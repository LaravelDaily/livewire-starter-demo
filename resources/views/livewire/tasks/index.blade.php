<section>
    <x-alerts.success />

    <flux:button href="{{ route('tasks.create') }}" variant="filled" class="mb-4">{{ __('Create Task') }}</flux:button>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Task
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
                            <span @class([
                                'text-green-600' => $task->is_completed,
                                'text-red-700' => ! $task->is_completed,
                            ])>
                                {{ $task->is_completed ? 'Completed' : 'In progress' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 space-x-2">
                            <flux:button href="#" variant="filled">{{ __('Edit') }}</flux:button>
                            <flux:button wire:confirm="Are you sure?" wire:click="delete({{ $task->id }})" variant="danger" type="button">{{ __('Delete') }}</flux:button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
