@extends('Layouts.AdminLayout')
@section('content')
<div class="flex justify-center items-center h-screen ">
    

<form class="max-w-sm mx-auto w-full" action="{{route('exame.store')}}" method="POST">
   @csrf
    <div class="mb-5">
      <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
      <input type="name" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Name..." required />
    </div>
    <div class="mb-5">
      <label for="duree" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Duree</label>
      <input type="duree" name="duree" id="duree" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="duree..." required />
    </div>
   
    <label for="courses_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Module</label>
  <select id="courses_id" name="courses_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    @foreach ($courses as $course)
        <option value="{{$course->id}}">{{$course->name}}</option>
    @endforeach
</select>
<p>Type</p> 

<div class="flex items-center mb-4 ml-10">
  <input id="type" name="type" type="radio" value="cc" name="default-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
  <label for="type"  class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">CC</label>
</div>
<div class="flex items-center ml-10">
  <input checked id="type" name="type" type="radio" value="efm" name="default-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
  <label for="type"  class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">EFM</label>
</div>

    <label for="teachers_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Teacher</label>
  <select id="teachers_id" name="teachers_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    @foreach ($teachers as $teacher)
        <option value="{{$teacher->id}}">{{$teacher->name}}</option>
    @endforeach
</select>

    <button type="submit" class="text-white mt-2 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
  </form>
</div>

@endsection