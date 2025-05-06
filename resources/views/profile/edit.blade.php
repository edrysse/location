<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <div class="bg-blue-100 text-blue-700 rounded-full p-3">
                <i class="fas fa-user fa-lg"></i>
            </div>
            <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Profile') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8 min-h-[80vh] bg-gradient-to-br from-gray-100 to-blue-50 dark:from-gray-900 dark:to-gray-800">
        <div class="max-w-2xl mx-auto space-y-8">
            <!-- User Info -->
            <div class="bg-white dark:bg-gray-900 shadow rounded-xl p-6 flex flex-col items-center">
                <div class="bg-blue-200 text-blue-700 rounded-full p-4 mb-3">
                    <i class="fas fa-user-circle fa-3x"></i>
                </div>
                <div class="text-center">
                    <h3 class="text-xl font-semibold mb-1">{{ Auth::user()->name }}</h3>
                    <p class="text-gray-500 dark:text-gray-300 mb-2">{{ Auth::user()->email }}</p>
                </div>
            </div>
            <!-- Update Info -->
            <div class="bg-white dark:bg-gray-900 shadow rounded-xl p-6">
                <h4 class="text-lg font-bold mb-4 text-blue-700">Update Profile Information</h4>
                <div>
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
            <!-- Change Password -->
            <div class="bg-white dark:bg-gray-900 shadow rounded-xl p-6">
                <h4 class="text-lg font-bold mb-4 text-blue-700">Change Password</h4>
                <div>
                    @include('profile.partials.update-password-form')
                </div>
            </div>
            <!-- Delete Account -->
            <div class="bg-white dark:bg-gray-900 shadow rounded-xl p-6">
                <h4 class="text-lg font-bold mb-4 text-red-500">Delete Account</h4>
                <div>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
