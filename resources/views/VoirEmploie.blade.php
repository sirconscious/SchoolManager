@extends('Layouts.TeacherLayout')

@section('content')
<div class="mt-14">
    <div class="max-w-7xl mx-auto">
        
        <!-- Header -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6 mb-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                        <i class="fas fa-eye text-blue-600 mr-3"></i>
                        Voir Emplois du Temps
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 mt-2">Consulter tous les horaires par groupe</p>
                </div>
                
                <!-- Navigation & Group Selector -->
                <div class="flex items-center space-x-4">
                    {{-- <a href="{{ route('emploie.index') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition duration-200">
                        <i class="fas fa-edit"></i>
                        <span>Gérer Emplois</span>
                    </a> --}}
                    
                    <label for="group-select" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                        Filtrer par groupe:
                    </label>
                    <select id="group-select" onchange="changeGroup()" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                        <option value="all" {{ $selectedGroup == 'all' ? 'selected' : '' }}>Tous les groupes</option>
                        <option value="DEV201" {{ $selectedGroup == 'DEV201' ? 'selected' : '' }}>DEV201</option>
                        <option value="DEV202" {{ $selectedGroup == 'DEV202' ? 'selected' : '' }}>DEV202</option>
                        <option value="DEV203" {{ $selectedGroup == 'DEV203' ? 'selected' : '' }}>DEV203</option>
                        <option value="DEV204" {{ $selectedGroup == 'DEV204' ? 'selected' : '' }}>DEV204</option>
                    </select>
                </div>
            </div>
        </div>

        @php
            $timeSlots = [
                '08:00-09:00', '09:00-10:00', '10:00-11:00', '11:00-12:00',
                '12:00-13:00', '13:00-14:00', '14:00-15:00', '15:00-16:00', '16:00-17:00'
            ];
            $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
            
            // Color scheme for different groups
            $groupColors = [
                'DEV201' => 'bg-blue-50 border-blue-200 text-blue-900 dark:bg-blue-900/30 dark:border-blue-700 dark:text-blue-100',
                'DEV202' => 'bg-green-50 border-green-200 text-green-900 dark:bg-green-900/30 dark:border-green-700 dark:text-green-100',
                'DEV203' => 'bg-purple-50 border-purple-200 text-purple-900 dark:bg-purple-900/30 dark:border-purple-700 dark:text-purple-100',
                'DEV204' => 'bg-orange-50 border-orange-200 text-orange-900 dark:bg-orange-900/30 dark:border-orange-700 dark:text-orange-100'
            ];
        @endphp

        <!-- Schedules Display -->
        @if($schedulesByGroup->count() > 0)
            @if($selectedGroup === 'all')
                <!-- Show all groups -->
                @foreach($schedulesByGroup as $groupName => $schedules)
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden mb-6">
                        <div class="p-6">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">
                                <i class="fas fa-users text-purple-600 mr-2"></i>
                                Emploi du temps - {{ $groupName }}
                            </h2>

                            <div class="overflow-x-auto">
                                <table class="w-full border-collapse border border-gray-200 dark:border-gray-600">
                                    <thead>
                                        <tr class="bg-gray-50 dark:bg-gray-700">
                                            <th class="p-4 text-left text-sm font-semibold text-gray-900 dark:text-white border border-gray-200 dark:border-gray-600">
                                                Horaires
                                            </th>
                                            @foreach($days as $day)
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
                                                        $colorClass = $groupColors[$groupName] ?? 'bg-gray-50 border-gray-200 text-gray-900';
                                                    @endphp
                                                    <td class="p-2 border border-gray-200 dark:border-gray-600 h-20">
                                                        @if($entry && ($entry->subject || $entry->teacher || $entry->room))
                                                            <div class="h-full {{ $colorClass }} rounded-lg p-2 border">
                                                                @if($entry->subject)
                                                                    <div class="text-xs font-semibold mb-1">{{ $entry->subject }}</div>
                                                                @endif
                                                                @if($entry->teacher)
                                                                    <div class="text-xs opacity-75">{{ $entry->teacher }}</div>
                                                                @endif
                                                                @if($entry->room)
                                                                    <div class="text-xs opacity-75">{{ $entry->room }}</div>
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
                @endforeach
            @else
                <!-- Show single group -->
                @php
                    $schedules = $schedulesByGroup->first();
                    $colorClass = $groupColors[$selectedGroup] ?? 'bg-blue-50 border-blue-200 text-blue-900';
                @endphp
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">
                            <i class="fas fa-calendar-alt text-purple-600 mr-2"></i>
                            Emploi du temps - {{ $selectedGroup }}
                        </h2>

                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse border border-gray-200 dark:border-gray-600">
                                <thead>
                                    <tr class="bg-gray-50 dark:bg-gray-700">
                                        <th class="p-4 text-left text-sm font-semibold text-gray-900 dark:text-white border border-gray-200 dark:border-gray-600">
                                            Horaires
                                        </th>
                                        @foreach($days as $day)
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
                                                        <div class="h-full {{ $colorClass }} rounded-lg p-2 border">
                                                            @if($entry->subject)
                                                                <div class="text-xs font-semibold mb-1">{{ $entry->subject }}</div>
                                                            @endif
                                                            @if($entry->teacher)
                                                                <div class="text-xs opacity-75">{{ $entry->teacher }}</div>
                                                            @endif
                                                            @if($entry->room)
                                                                <div class="text-xs opacity-75">{{ $entry->room }}</div>
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
            @endif
        @else
            <!-- No schedules found -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
                <div class="text-center py-12">
                    <i class="fas fa-calendar-times text-gray-400 text-6xl mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                        Aucun emploi du temps trouvé
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-6">
                        @if($selectedGroup === 'all')
                            Il n'y a aucun emploi du temps créé pour le moment.
                        @else
                            Il n'y a aucun emploi du temps créé pour le groupe {{ $selectedGroup }}.
                        @endif
                    </p>
                    {{-- <a href="{{ route('emploie.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg inline-flex items-center space-x-2 transition duration-200">
                        <i class="fas fa-plus"></i>
                        <span>Créer un emploi du temps</span>
                    </a> --}}
                </div>
            </div>
        @endif

        <!-- Legend -->
        @if($selectedGroup === 'all' && $schedulesByGroup->count() > 0)
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6 mt-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Légende des couleurs par groupe</h3>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    @foreach($groupColors as $group => $colorClass)
                        <div class="flex items-center space-x-2">
                            <div class="w-6 h-6 {{ $colorClass }} rounded border"></div>
                            <span class="text-sm text-gray-700 dark:text-gray-300">{{ $group }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
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

    // Print functionality
    function printSchedule() {
        window.print();
    }

    // Add print styles
    const style = document.createElement('style');
    style.textContent = `
        @media print {
            body * {
                visibility: hidden;
            }
            .schedule-container, .schedule-container * {
                visibility: visible;
            }
            .schedule-container {
                position: absolute;
                left: 0;
                top: 0;
            }
        }
    `;
    document.head.appendChild(style);
</script>
@endsection