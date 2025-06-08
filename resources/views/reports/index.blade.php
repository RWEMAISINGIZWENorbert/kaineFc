<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reports') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Available Reports</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="#" class="text-blue-600 hover:text-blue-900">Player Performance Report</a>
                        </li>
                        <li>
                            <a href="#" class="text-blue-600 hover:text-blue-900">Staff Attendance Report</a>
                        </li>
                        <li>
                            <a href="#" class="text-blue-600 hover:text-blue-900">Match Results Report</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 