@extends('Layouts.AdminLayout') 
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

    
    <div class=" grid grid-cols-2">
        
        <form class="max-w-sm mx-auto" method="POST" action="{{route('admin.StoreEmploie')}}" enctype="multipart/form-data">
            @csrf
            
            <label for="groupe_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select a groupe</label>
            <select id="groupe_name" name="groupe_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @foreach ($groupes as $groupe)
                 <option value="{{$groupe->group_name}}">{{$groupe->group_name}}</option>
                @endforeach
            </select> 
            
        <div class="flex items-center justify-center w-[300px] h-200px">
            <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                    </svg>
                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG or JPG</p>
                </div>
                <input id="dropzone-file"  type="file" name="dropzone-file"  class="hidden" />
            </label> 
        
        </div> 
        <button type="submit" class=" text-white  my-1 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Ajouter Emploie</button>
        
          </form>
        
    </div>
</div>
@endsection