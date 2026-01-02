<x-app-dashboard-layout>
    <div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Edit User</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Update user details and permissions.</p>
        </div>
        <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
            Back to Users
        </a>
    </div>

    <form method="POST" action="{{ route('admin.users.update', $user) }}" class="max-w-3xl" x-data="{ role: '{{ old('role_id', $user->role_id) }}' }">
        @csrf
        @method('PUT')
        
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm p-6 space-y-6">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white border-b border-gray-100 dark:border-gray-700 pb-4">User Details</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div class="col-span-2 md:col-span-1">
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Full Name *</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                        class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-acef-green focus:border-transparent outline-none transition text-gray-900 dark:text-white">
                    @error('name')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                </div>

                <!-- Email -->
                <div class="col-span-2 md:col-span-1">
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email Address *</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                        class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-acef-green focus:border-transparent outline-none transition text-gray-900 dark:text-white">
                    @error('email')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                </div>

                <!-- Role -->
                <div class="col-span-2 md:col-span-1">
                    <label for="role_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Role *</label>
                    <select name="role_id" id="role_id" required x-model="role"
                        class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-acef-green focus:border-transparent outline-none transition text-gray-900 dark:text-white">
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @error('role_id')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                </div>

                <!-- Country (Conditional) -->
                <div class="col-span-2 md:col-span-1" x-show="role == '2' || role == 'country-admin'" x-transition>
                    <label for="country" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Country</label>
                    <input type="text" name="country" id="country" value="{{ old('country', $user->country) }}" placeholder="e.g. Kenya"
                        class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-acef-green focus:border-transparent outline-none transition text-gray-900 dark:text-white">
                </div>

                <!-- Status -->
                <div class="col-span-2">
                     <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ $user->is_active ? 'checked' : '' }} class="rounded border-gray-300 dark:border-gray-600 text-acef-green focus:ring-acef-green w-5 h-5">
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Active User account</span>
                    </label>
                </div>

                <!-- Password Change -->
                <div class="col-span-2 border-t border-gray-100 dark:border-gray-700 pt-4 mt-2">
                    <h4 class="text-sm font-bold text-gray-900 dark:text-white mb-4">Change Password (Optional)</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">New Password</label>
                            <input type="password" name="password" id="password"
                                class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-acef-green focus:border-transparent outline-none transition text-gray-900 dark:text-white">
                            @error('password')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Confirm New Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-acef-green focus:border-transparent outline-none transition text-gray-900 dark:text-white">
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-4 pt-4">
                <button type="submit" class="px-6 py-2.5 bg-acef-green hover:bg-emerald-600 text-white font-medium rounded-lg transition shadow-sm">
                    Update User
                </button>
                <a href="{{ route('admin.users.index') }}" class="px-6 py-2.5 text-gray-600 dark:text-gray-400 font-medium hover:text-gray-900 dark:hover:text-white transition">
                    Cancel
                </a>
            </div>
        </div>
    </form>
</div>
</x-app-dashboard-layout>
