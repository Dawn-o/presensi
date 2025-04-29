<x-app-layout>
    <div class="max-w-7xl mx-auto py-4 sm:py-6 px-4 sm:px-6 lg:px-8">
        <!-- Profile Header Component -->
        <x-profile-header :user="$user" />

        <!-- Profile Content Partial -->
        @include('partials.profile-content')
    </div>
</x-app-layout>
