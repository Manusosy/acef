<x-app-dashboard-layout>
    <div class="bg-white dark:bg-gray-800 rounded-xl p-8 border border-gray-200 dark:border-gray-700 shadow-sm">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Welcome back, {{ Auth::user()->name }}!</h2>
        <p class="text-gray-600 dark:text-gray-300 mb-6">
            You are logged in as a <strong>Country Coordinator</strong> for <strong>{{ Auth::user()->country ?? 'Global' }}</strong>.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="p-6 bg-emerald-50 dark:bg-emerald-900/20 rounded-xl border border-emerald-100 dark:border-emerald-800">
                <h3 class="font-bold text-emerald-800 dark:text-emerald-300 mb-2">My Articles</h3>
                <p class="text-sm text-emerald-600 dark:text-emerald-400 mb-4">
                    Create and manage articles for your region. All new articles are saved as drafts for admin approval.
                </p>
                <a href="#" class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white rounded-lg font-medium hover:bg-emerald-700 transition-colors">
                    View Articles
                </a>
            </div>
            
             <div class="p-6 bg-blue-50 dark:bg-blue-900/20 rounded-xl border border-blue-100 dark:border-blue-800">
                <h3 class="font-bold text-blue-800 dark:text-blue-300 mb-2">Media Library</h3>
                <p class="text-sm text-blue-600 dark:text-blue-400 mb-4">
                    Access the shared media library to upload and use photos for your content.
                </p>
                <a href="#" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors">
                    Open Library
                </a>
            </div>
        </div>
    </div>
</x-app-dashboard-layout>
