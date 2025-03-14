@extends('Layouts.TeacherLayout') 
@section('content')
<div class="flex justify-center items-center h-screen w-full gap-3">
    <figure class=" mt-8">
        @if ($groupesListe->isNotEmpty())
        <img class="h-auto max-w-full rounded-lg" src="{{ asset('storage/' . $groupesListe->first()->emploie) }}" alt="image description">
    @else
        <p>No image available</p>
    @endif        <figcaption class="mt-2 text-sm text-center text-gray-500 dark:text-gray-400">{{ $groupesListe->first()->group_name }}</figcaption>
    <div class="pagination mt-4 flex justify-center space-x-2">
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
    

    </figure>
</div>
@endsection