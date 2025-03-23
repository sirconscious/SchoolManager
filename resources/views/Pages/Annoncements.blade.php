@extends('Layouts.AdminLayout') 
@section('content')
<div class="flex flex-col -mt-12 gap-5 justify-center items-center h-screen relative ">
    <div class="w-full flex  ">
        <a href="{{ route('anonnce.create') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            <i class="fa-solid fa-plus"></i> Add Anoncment
        </a>
    </div>
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
        <div class="absolute top-0 right-0">
            <button id="dropdownMenuIconButton" data-dropdown-toggle="dropdownDots" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600" type="button">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                </svg>
                </button>
            <div id="dropdownDots" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700 dark:divide-gray-600">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIcon">
                  <li>
                    <a href="{{route("anonnce.edit",$anonce)}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white   border-b-1  border-blue-950">Edit</a>
                  </li>
                  <li>
                    <form action="{{route("anonnce.destroy" , $anonce)}}" method="POST">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 w-full text-start dark:hover:text-white">Delete</button>

                    </form>
                  </li>
               
                </ul>
              
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
{{-- <a href="{{route("anonnce.create")}}">

    <div class="px-4 py-4 absolute bottom-8 right-5 cursor-pointer rounded-full bg-gradient-to-r from-blue-500 to-green-500 shadow-lg hover:shadow-xl transition-shadow duration-300 ease-in-out">
        <i class="fa-solid fa-plus text-2xl text-white"></i>
    </div>
</a> --}}
    </div>
</div>
@endsection

