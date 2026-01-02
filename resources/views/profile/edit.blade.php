<x-app-dashboard-layout>
    <div class="max-w-4xl mx-auto space-y-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Account Settings</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Manage your profile information and account security</p>
        </div>

        <div class="grid grid-cols-1 gap-8">
            <!-- Profile Info & Business Card -->
            <div class="bg-white dark:bg-gray-800 rounded-[32px] border border-gray-100 dark:border-gray-700 p-8 shadow-sm">
                @include('profile.partials.update-profile-information-form')
            </div>

            <!-- Password Update -->
            <div class="bg-white dark:bg-gray-800 rounded-[32px] border border-gray-100 dark:border-gray-700 p-8 shadow-sm">
                @include('profile.partials.update-password-form')
            </div>

            <!-- Delete Account -->
            <div class="bg-white dark:bg-gray-800 rounded-[32px] border border-red-50 dark:border-red-900/20 p-8 shadow-sm">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-dashboard-layout>
