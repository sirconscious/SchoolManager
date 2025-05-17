@extends('Layouts.StudentsLayout')
@section('content')
<div class="p-2 mt-14">
    <div class="p-2 border-2 border-gray-200 rounded-lg dark:border-gray-700">
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Your Academic Records</h1>
            <div class="flex items-center space-x-2">
                <span class="px-3 py-1 text-sm font-medium rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                    Total Records: {{ $recordes->count() }}
                </span>
            </div>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-4 font-medium">Exam Name</th>
                        <th scope="col" class="px-6 py-4 font-medium">Module</th>
                        <th scope="col" class="px-6 py-4 font-medium">Type</th>
                        <th scope="col" class="px-6 py-4 font-medium">Score</th>
                        <th scope="col" class="px-6 py-4 font-medium">Feedback</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($recordes as $rec)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $rec->exames->name }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-sm font-medium rounded-full bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300">
                                {{ $rec->exames->course->name }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-sm font-medium rounded-full 
                                @if($rec->exames->type == 'Quiz')
                                    bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                                @elseif($rec->exames->type == 'Midterm')
                                    bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300
                                @else
                                    bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300
                                @endif
                            ">
                                {{ $rec->exames->type }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <span class="px-3 py-1 text-sm font-medium rounded-full 
                                    @if($rec->note >= 14)
                                        bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                                    @elseif($rec->note >= 10)
                                        bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300
                                    @else
                                        bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300
                                    @endif
                                ">
                                    {{ $rec->note }}/20
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="max-w-xs">
                                <p class="text-sm text-gray-600 dark:text-gray-300">
                                    {{ $rec->comment ?: 'No feedback provided' }}
                                </p>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                            <div class="flex flex-col items-center justify-center py-8">
                                <svg class="w-12 h-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="text-lg font-medium">No records found</p>
                                <p class="text-sm text-gray-500">Your exam records will appear here</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($recordes->count() > 0)
        <div class="mt-6 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="flex items-center">
                    <span class="w-3 h-3 bg-green-500 rounded-full mr-2"></span>
                    <span class="text-sm text-gray-600 dark:text-gray-400">Passing (≥14/20)</span>
                </div>
                <div class="flex items-center">
                    <span class="w-3 h-3 bg-yellow-500 rounded-full mr-2"></span>
                    <span class="text-sm text-gray-600 dark:text-gray-400">Average (10-13/20)</span>
                </div>
                <div class="flex items-center">
                    <span class="w-3 h-3 bg-red-500 rounded-full mr-2"></span>
                    <span class="text-sm text-gray-600 dark:text-gray-400">Below Average (<10/20)</span>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection