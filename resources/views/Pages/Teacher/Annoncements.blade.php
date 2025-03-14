@extends('Layouts.TeacherLayout') 
@section('content')
<div class="flex justify-center items-center h-screen relative ">
    <div class="grid grid-cols-3 gap-4">
      
   @foreach ($anoncmentsListe as $anonce)
   <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
    <div class="p-5">
            
    <div class="w-full  max-w-sm bg-white borde  rounded-lg  dark:bg-gray-800 dark:border-gray-700 relative">
        <div class="flex  items-center p-2 relative">
            <img class="w-12 h-12 mb-3 rounded-full shadow-lg" src="{{asset('images/user (1).png')}}" alt="Bonnie image"/>
            <div class="flex flex-col ml-2">
    
                <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{$anonce->user?->name}}</h5>
                <span class="text-sm text-gray-500 dark:text-gray-400">{{ \Carbon\Carbon::parse($anonce->created_at)->format('d/m/Y') }}</span>
            </div>
           
        </div>
    </div>
    
            <a href="#">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$anonce->title}}</h5>
            </a>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$anonce->body}}</p>
    
        </div>
        <a href="#">
            <img class="w-full h-auto rounded-t-lg object-contain max-h-[400px]" src="{{asset('storage/'.$anonce->image)}}" alt="" />
        </a>
    </div>
    
    <figure class=" mt-8 absolute bottom-8 right-2/5">
      <figcaption class="mt-2 text-sm text-center text-gray-500 dark:text-gray-400">{{ $anoncmentsListe->first()->title }}</figcaption>
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

   @endforeach 

</div>
@endsection