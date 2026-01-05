<x-app-dashboard-layout>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Add New Year</h1>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 max-w-2xl">
        <form action="{{ route('admin.timeline-years.store') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Year</label>
                <input type="number" name="year" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Order (Optional)</label>
                <input type="number" name="order" value="0" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                <p class="text-xs text-gray-500 mt-1">Higher numbers appear first/last depending on sorting.</p>
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="is_visible" value="1" checked class="rounded border-gray-300 text-acef-green focus:ring-acef-green">
                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Visible</span>
                </label>
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.timeline-years.index') }}" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-acef-green text-white rounded-lg hover:bg-green-700">Save Year</button>
            </div>
        </form>
    </div>
</x-app-dashboard-layout>
