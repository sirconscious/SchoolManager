@extends('Layouts.StudentsLayout') 
@section('content')
<div class="flex justify-center flex-col items-center h-screen relative mt-2 w-full">
<figure class=" w-5xl">
    <img class="h-auto max-w-full rounded-lg" src="{{asset('storage/'.$emploie)}}" alt="image description">
    <figcaption class="mt-2 text-sm text-center text-gray-500 dark:text-gray-400">{{auth()->user()->group}}</figcaption>
  </figure>
  
</div>
@endsection   