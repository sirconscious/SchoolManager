@extends('Layouts.StudentsLayout')

@section('content')
<div class="mt-14">
    <div class="max-w-6xl mx-auto">
        
        <!-- Header -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6 mb-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                        <i class="fas fa-calendar-check text-blue-600 mr-3"></i>
                        Mon Emploi du Temps
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 mt-2">Groupe {{ $selectedGroup }}</p>
                </div>
                
                <!-- Navigation buttons -->
                {{-- <div class="flex items-center space-x-3">
                    <a href="{{ route('emploie.view') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition duration-200">
                        <i class="fas fa-eye"></i>
                        <span>Voir tous</span>
                    </a>
                    <button onclick="printSchedule()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition duration-200">
                        <i class="fas fa-print"></i>
                        <span>Imprimer</span>
                    </button>
                </div> --}}
            </div>
        </div>

        @php
            $timeSlots = [
                '08:00-09:00', '09:00-10:00', '10:00-11:00', '11:00-12:00',
                '12:00-13:00', '13:00-14:00', '14:00-15:00', '15:00-16:00', '16:00-17:00'
            ];
            $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
        @endphp

        <!-- Schedule Display -->
        @if($schedules->count() > 0)
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden print-container">
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-6 print-header">
                        <i class="fas fa-calendar-alt text-blue-600 mr-2"></i>
                        Emploi du temps - {{ $selectedGroup }}
                        <span class="text-sm text-gray-500 dark:text-gray-400 ml-2">
                            Semaine du {{ date('d/m/Y') }}
                        </span>
                    </h2>

                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse border border-gray-200 dark:border-gray-600">
                            <thead>
                                <tr class="bg-blue-50 dark:bg-blue-900/30">
                                    <th class="p-4 text-left text-sm font-semibold text-gray-900 dark:text-white border border-gray-200 dark:border-gray-600 bg-blue-100/50 dark:bg-blue-900/50">
                                        <i class="fas fa-clock mr-2"></i>Horaires
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
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                        <td class="p-3 bg-blue-50/50 dark:bg-blue-900/20 text-sm font-medium text-gray-900 dark:text-white border border-gray-200 dark:border-gray-600">
                                            <i class="fas fa-clock text-blue-600 mr-2"></i>
                                            {{ $timeSlot }}
                                        </td>
                                        @foreach($days as $day)
                                            @php
                                                $entry = $schedules->where('day', $day)->where('time_slot', $timeSlot)->first();
                                            @endphp
                                            <td class="p-2 border border-gray-200 dark:border-gray-600 h-24">
                                                @if($entry && ($entry->subject || $entry->teacher || $entry->room))
                                                    <div class="h-full bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/30 dark:to-blue-800/30 rounded-lg p-3 border border-blue-200 dark:border-blue-700 hover:shadow-md transition-shadow cursor-default">
                                                        @if($entry->subject)
                                                            <div class="text-sm font-bold text-blue-900 dark:text-blue-100 mb-1">
                                                                <i class="fas fa-book mr-1"></i>{{ $entry->subject }}
                                                            </div>
                                                        @endif
                                                        @if($entry->teacher)
                                                            <div class="text-xs text-blue-700 dark:text-blue-300 mb-1">
                                                                <i class="fas fa-user mr-1"></i>{{ $entry->teacher }}
                                                            </div>
                                                        @endif
                                                        @if($entry->room)
                                                            <div class="text-xs text-blue-600 dark:text-blue-400">
                                                                <i class="fas fa-door-open mr-1"></i>{{ $entry->room }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                @else
                                                    <div class="h-full bg-gray-50 dark:bg-gray-700/30 rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-600 flex items-center justify-center">
                                                        <span class="text-xs text-gray-400 dark:text-gray-500">Libre</span>
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

            <!-- Statistics -->
            <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                @php
                    $totalClasses = $schedules->count();
                    $totalHours = $totalClasses * 1; // Assuming each slot is 1 hour
                    $subjectsCount = $schedules->whereNotNull('subject')->pluck('subject')->unique()->count();
                @endphp
                
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-4">
                    <div class="flex items-center">
                        <div class="bg-blue-100 dark:bg-blue-900/50 p-3 rounded-full">
                            <i class="fas fa-clock text-blue-600 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600 dark:text-gray-400">Total heures</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalHours }}h</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-4">
                    <div class="flex items-center">
                        <div class="bg-green-100 dark:bg-green-900/50 p-3 rounded-full">
                            <i class="fas fa-chalkboard-teacher text-green-600 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600 dark:text-gray-400">Cours planifiés</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalClasses }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-4">
                    <div class="flex items-center">
                        <div class="bg-purple-100 dark:bg-purple-900/50 p-3 rounded-full">
                            <i class="fas fa-book text-purple-600 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600 dark:text-gray-400">Matières</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $subjectsCount }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- No schedule found -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
                <div class="text-center py-12">
                    <div class="bg-blue-100 dark:bg-blue-900/50 rounded-full w-24 h-24 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-calendar-times text-blue-600 text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                        Aucun emploi du temps trouvé
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-6">
                        Il n'y a aucun emploi du temps créé pour le groupe {{ $selectedGroup }}.
                    </p>
                    {{-- <a href="{{ route('emploie.index', ['group' => $selectedGroup]) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg inline-flex items-center space-x-2 transition duration-200">
                        <i class="fas fa-plus"></i>
                        <span>Créer un emploi du temps</span>
                    </a> --}}
                </div>
            </div>
        @endif
    </div>
</div>

<script>
    function printSchedule() {
        window.print();
    }

    // Enhanced print styles
    const style = document.createElement('style');
    style.textContent = `
        @media print {
            body * {
                visibility: hidden;
            }
            .print-container, .print-container *, .print-header {
                visibility: visible;
            }
            .print-container {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
            body {
                background: white !important;
            }
            table {
                font-size: 12px;
            }
            th, td {
                padding: 8px !important;
            }
        }

        @media screen {
            .schedule-container {
                animation: fadeIn 0.5s ease-in;
            }
            
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }
        }
    `;
    document.head.appendChild(style);

    // Add some interactivity
    document.addEventListener('DOMContentLoaded', function() {
        // Add hover effects to schedule cells
        const scheduleCells = document.querySelectorAll('table tbody td > div');
        scheduleCells.forEach(cell => {
            if (cell.children.length > 0) {
                cell.addEventListener('mouseenter', function() {
                    this.style.transform = 'scale(1.02)';
                    this.style.transition = 'transform 0.2s ease';
                });
                cell.addEventListener('mouseleave', function() {
                    this.style.transform = 'scale(1)';
                });
            }
        });
    });
</script>
@endsection
