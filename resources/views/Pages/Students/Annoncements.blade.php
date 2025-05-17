@extends('Layouts.StudentsLayout')
@section('content')
<div class="p-2 mt-14">
    <div class="p-2 border-2 border-gray-200 rounded-lg dark:border-gray-700">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Latest Announcements</h1>

        @if ($anoncmentsListe->isEmpty())
            <div class="flex flex-col items-center justify-center py-12 text-gray-500 dark:text-gray-400">
                <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2H7a2 2 0 00-2 2v2m7-7h.01"></path>
                </svg>
                <p class="text-lg font-medium">No announcements available.</p>
                <p class="text-sm">Check back later for updates.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($anoncmentsListe as $anonce)
                    <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 overflow-hidden">
                        @if ($anonce->image)
                            <img class="w-full h-48 object-cover" src="{{ asset('storage/' . $anonce->image) }}" alt="Announcement Image" />
                        @endif
                        <div class="p-5">
                            <div class="flex items-center mb-4">
                                <img class="w-10 h-10 rounded-full mr-3" src="{{ asset('images/user (1).png') }}" alt="Author Avatar"/>
                                <div class="flex flex-col">
                                    <h5 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $anonce->user?->name }}</h5>
                                    <span class="text-sm text-gray-500 dark:text-gray-400">{{ \Carbon\Carbon::parse($anonce->created_at)->format('d/m/Y') }}</span>
                                </div>
                            </div>
                            <h5 class="mb-3 text-xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $anonce->title }}</h5>
                            <p class="mb-4 font-normal text-gray-700 dark:text-gray-400">{{ $anonce->body }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="pagination mt-8 flex justify-center space-x-2">
                @if ($currentPage > 1)
                    <a href="?page={{ $currentPage - 1 }}" class="px-3 py-1 bg-gray-200 text-gray-800 rounded">« Previous</a>
                @endif

                @for ($i = 1; $i <= $totalPages; $i++)
                    <a href="?page={{ $i }}" class="px-3 py-1 {{ $currentPage == $i ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-800' }} rounded">
                        {{ $i }}
                    </a>
                @endfor

                @if ($currentPage < $totalPages)
                    <a href="?page={{ $currentPage + 1 }}" class="px-3 py-1 bg-gray-200 text-gray-800 rounded">Next »</a>
                @endif
            </div>

        @endif
    </div>
</div>
@endsection