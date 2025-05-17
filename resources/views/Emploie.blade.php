@extends('Layouts.AdminLayout')

@section('content')
<div class="mt-14">
    <div class="max-w-7xl mx-auto">
        
        {{-- Flash Messages --}}
        @if(session('success'))
            <div id="success-message" class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 transition-all duration-300">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div id="error-message" class="fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 transition-all duration-300">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            </div>
        @endif

        <!-- Header -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6 mb-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                        <i class="fas fa-calendar-alt text-blue-600 mr-3"></i>
                        Emploi du Temps
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 mt-2">Créer et gérer les horaires par groupe</p>
                </div>
                
                <!-- Group Selector -->
                <div class="flex items-center space-x-4">
                    <label for="group-select" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                        Groupe:
                    </label>
                    <select id="group-select" onchange="changeGroup()" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                        <option value="DEV201" {{ $selectedGroup == 'DEV201' ? 'selected' : '' }}>DEV201</option>
                        <option value="DEV202" {{ $selectedGroup == 'DEV202' ? 'selected' : '' }}>DEV202</option>
                        <option value="DEV203" {{ $selectedGroup == 'DEV203' ? 'selected' : '' }}>DEV203</option>
                        <option value="DEV204" {{ $selectedGroup == 'DEV204' ? 'selected' : '' }}>DEV204</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Create/Edit Schedule Form -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden mb-6">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">
                    <i class="fas fa-edit text-green-600 mr-2"></i>
                    Créer/Modifier l'emploi du temps - {{ $selectedGroup }}
                </h2>

                <form action="{{ route('emploie.store') }}" method="POST" id="schedule-form">
                    @csrf
                    <input type="hidden" name="grp" value="{{ $selectedGroup }}">
                    
                    <!-- Schedule Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse border border-gray-200 dark:border-gray-600">
                            <thead>
                                <tr class="bg-gray-50 dark:bg-gray-700">
                                    <th class="p-4 text-left text-sm font-semibold text-gray-900 dark:text-white border border-gray-200 dark:border-gray-600">
                                        Horaires
                                    </th>
                                    @foreach(['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'] as $day)
                                        <th class="p-4 text-center text-sm font-semibold text-gray-900 dark:text-white border border-gray-200 dark:border-gray-600">
                                            {{ $day }}
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $timeSlots = [
                                        '08:00-09:00', '09:00-10:00', '10:00-11:00', '11:00-12:00',
                                        '12:00-13:00', '13:00-14:00', '14:00-15:00', '15:00-16:00', '16:00-17:00'
                                    ];
                                    $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
                                @endphp
                                
                                @foreach($timeSlots as $timeSlot)
                                    <tr>
                                        <td class="p-3 bg-gray-50 dark:bg-gray-700 text-sm font-medium text-gray-900 dark:text-white border border-gray-200 dark:border-gray-600">
                                            {{ $timeSlot }}
                                        </td>
                                        @foreach($days as $day)
                                            @php
                                                $existingEntry = $schedules->where('day', $day)->where('time_slot', $timeSlot)->first();
                                            @endphp
                                            <td class="p-2 border border-gray-200 dark:border-gray-600">
                                                <div class="space-y-1">
                                                    <input type="text" 
                                                           name="entries[{{ $day }}][{{ $timeSlot }}][subject]" 
                                                           placeholder="Matière"
                                                           value="{{ $existingEntry->subject ?? old("entries.$day.$timeSlot.subject") }}"
                                                           class="w-full px-2 py-1 text-xs border border-gray-300 dark:border-gray-600 rounded focus:ring-1 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                                                    
                                                    <input type="text" 
                                                           name="entries[{{ $day }}][{{ $timeSlot }}][teacher]" 
                                                           placeholder="Professeur"
                                                           value="{{ $existingEntry->teacher ?? old("entries.$day.$timeSlot.teacher") }}"
                                                           class="w-full px-2 py-1 text-xs border border-gray-300 dark:border-gray-600 rounded focus:ring-1 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                                                    
                                                    <input type="text" 
                                                           name="entries[{{ $day }}][{{ $timeSlot }}][room]" 
                                                           placeholder="Salle"
                                                           value="{{ $existingEntry->room ?? old("entries.$day.$timeSlot.room") }}"
                                                           class="w-full px-2 py-1 text-xs border border-gray-300 dark:border-gray-600 rounded focus:ring-1 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                                                </div>
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" onclick="clearForm()" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg flex items-center space-x-2 transition duration-200">
                            <i class="fas fa-trash"></i>
                            <span>Vider</span>
                        </button>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg flex items-center space-x-2 transition duration-200">
                            <i class="fas fa-save"></i>
                            <span>Sauvegarder</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- View Schedule -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">
                    <i class="fas fa-eye text-purple-600 mr-2"></i>
                    Emploi du temps actuel - {{ $selectedGroup }}
                </h2>

                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-200 dark:border-gray-600">
                        <thead>
                            <tr class="bg-gray-50 dark:bg-gray-700">
                                <th class="p-4 text-left text-sm font-semibold text-gray-900 dark:text-white border border-gray-200 dark:border-gray-600">
                                    Horaires
                                </th>
                                @foreach(['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'] as $day)
                                    <th class="p-4 text-center text-sm font-semibold text-gray-900 dark:text-white border border-gray-200 dark:border-gray-600">
                                        {{ $day }}
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($timeSlots as $timeSlot)
                                <tr>
                                    <td class="p-3 bg-gray-50 dark:bg-gray-700 text-sm font-medium text-gray-900 dark:text-white border border-gray-200 dark:border-gray-600">
                                        {{ $timeSlot }}
                                    </td>
                                    @foreach($days as $day)
                                        @php
                                            $entry = $schedules->where('day', $day)->where('time_slot', $timeSlot)->first();
                                        @endphp
                                        <td class="p-2 border border-gray-200 dark:border-gray-600 h-20">
                                            @if($entry && ($entry->subject || $entry->teacher || $entry->room))
                                                <div class="h-full bg-blue-50 dark:bg-blue-900/30 rounded-lg p-2 border border-blue-200 dark:border-blue-700">
                                                    @if($entry->subject)
                                                        <div class="text-xs font-semibold text-blue-800 dark:text-blue-200 mb-1">{{ $entry->subject }}</div>
                                                    @endif
                                                    @if($entry->teacher)
                                                        <div class="text-xs text-blue-600 dark:text-blue-300">{{ $entry->teacher }}</div>
                                                    @endif
                                                    @if($entry->room)
                                                        <div class="text-xs text-blue-500 dark:text-blue-400">Salle: {{ $entry->room }}</div>
                                                    @endif
                                                </div>
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function changeGroup() {
        const groupSelect = document.getElementById('group-select');
        const selectedGroup = groupSelect.value;
        
        const url = new URL(window.location);
        url.searchParams.set('group', selectedGroup);
        window.location.href = url.toString();
    }

    function clearForm() {
        if (confirm('Êtes-vous sûr de vouloir vider tous les champs ?')) {
            const inputs = document.querySelectorAll('#schedule-form input[type="text"]');
            inputs.forEach(input => input.value = '');
        }
    }

    // Auto-hide flash messages
    document.addEventListener('DOMContentLoaded', function() {
        const successMessage = document.getElementById('success-message');
        const errorMessage = document.getElementById('error-message');
        
        if (successMessage) {
            setTimeout(() => {
                successMessage.style.opacity = '0';
                setTimeout(() => successMessage.remove(), 300);
            }, 3000);
        }
        
        if (errorMessage) {
            setTimeout(() => {
                errorMessage.style.opacity = '0';
                setTimeout(() => errorMessage.remove(), 300);
            }, 5000);
        }
    });
</script>
@endsection
