<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Player Details') }}
            </h2>
            <a href="{{ route('players.edit', $player) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                Edit Player
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Player Image -->
                        <div class="flex justify-center">
                            @if($player->profile_image)
                                <img src="{{ Storage::url($player->profile_image) }}" alt="{{ $player->first_name }}" class="w-48 h-48 rounded-full object-cover">
                            @else
                                <div class="w-48 h-48 rounded-full bg-gray-200 flex items-center justify-center">
                                    <span class="text-4xl text-gray-500">{{ substr($player->first_name, 0, 1) }}</span>
                                </div>
                            @endif
                        </div>

                        <!-- Player Information -->
                        <div class="space-y-4">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">Personal Information</h3>
                                <div class="mt-2 grid grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Full Name</p>
                                        <p class="mt-1 text-sm text-gray-900">{{ $player->first_name }} {{ $player->last_name }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Date of Birth</p>
                                        <p class="mt-1 text-sm text-gray-900">{{ $player->date_of_birth->format('F j, Y') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Nationality</p>
                                        <p class="mt-1 text-sm text-gray-900">{{ $player->nationality }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Jersey Number</p>
                                        <p class="mt-1 text-sm text-gray-900">{{ $player->jersey_number }}</p>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-lg font-medium text-gray-900">Physical Information</h3>
                                <div class="mt-2 grid grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Height</p>
                                        <p class="mt-1 text-sm text-gray-900">{{ $player->height }} cm</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Weight</p>
                                        <p class="mt-1 text-sm text-gray-900">{{ $player->weight }} kg</p>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-lg font-medium text-gray-900">Team Information</h3>
                                <div class="mt-2 grid grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Position</p>
                                        <p class="mt-1 text-sm text-gray-900">{{ $player->position ? $player->position->name : 'Not Assigned' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Team</p>
                                        <p class="mt-1 text-sm text-gray-900">{{ $player->team ? $player->team->name : 'Not Assigned' }}</p>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-lg font-medium text-gray-900">Contract Information</h3>
                                <div class="mt-2 grid grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Contract Start</p>
                                        <p class="mt-1 text-sm text-gray-900">{{ $player->contract_start->format('F j, Y') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Contract End</p>
                                        <p class="mt-1 text-sm text-gray-900">{{ $player->contract_end->format('F j, Y') }}</p>
                                    </div>
                                </div>
                            </div>

                            @if($player->medical_conditions)
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">Medical Information</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-900">{{ $player->medical_conditions }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 