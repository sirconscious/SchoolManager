@php
    $layout = 'Layouts.StudentsLayout'; // Default layout
    if (auth()->check()) {
        if (auth()->user()->role == "admin") {
            $layout = 'Layouts.AdminLayout';
        } elseif (auth()->user()->role == "teacher") {
            $layout = 'Layouts.TeacherLayout';
        }
    }
@endphp

@extends($layout)

@section('content')
<div class="flex justify-end w-full items-start mt-15 h-screen relative"> 
    
<div class="relative overflow-x-auto min-w-[1250px]">
   <div class="felx justify-between flex-row  absolute top-0 right-0 mt-2">
       <div class="flex justify-end">
       @if (auth()->user()->role == "teacher")
       <a href="{{route("course.create")}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
        <i class="fa-solid fa-plus"></i> Add Course
    </a>
       @endif
       </div>
   </div>
    {{-- @dd(auth()->user()->role); --}}
    @if (auth()->user()->role  !== "student")
        
    <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400 mb-1">
        <li class="me-2">
            <a href="{{ route('admin.CoursesListe') }}" 
               class="inline-block p-4 rounded-t-lg 
               {{ request()->routeIs('admin.CoursesListe') ? 'text-blue-600 bg-gray-100 dark:bg-gray-800 dark:text-blue-500' : 'hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300' }}">
                Courses
            </a>
        </li>
        
        <li class="me-2">
            <a href="{{ route('exame.index') }}" 
               class="inline-block p-4 rounded-t-lg 
               {{ request()->routeIs('exame.index') ? 'text-blue-600 bg-gray-100 dark:bg-gray-800 dark:text-blue-500' : 'hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300' }}">
                Exames
            </a>
        </li>
    
        
    </ul>
    @endif
    

    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    name
                </th>
                <th scope="col" class="px-6 py-3">
                    description
                </th>
                <th scope="col" class="px-6 py-3">
                    Coef
                </th>
                <th scope="col" class="px-6 py-3">
                    Created At
                </th>

                <th scope="col" class="px-6 py-3">
                    
                   @if (auth()->user()->role == "teacher")
                       Actions
                   @else
                       Dmonload
                   @endif 
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($courses as $course)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$course->name}}
                </th>
                <td class="px-6 py-4">
                    {{$course->description}}
                </td>
                <td class="px-6  py-4">
                    {{$course->coef->coef}}
                </td>
                <td class="px-6 py-4">
                    {{$course->created_at}}
                </td>
              
                <td class="py-4 text-right flex justify-evenly">
                    @if (auth()->user()->role == "teacher")

                        
                    <div>
                        <!-- Dropdown toggle button -->
                        <button id="dropdownDefaultButton-{{ $course->id }}" data-dropdown-toggle="dropdown-{{ $course->id }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                            Actions
                            <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg>
                        </button>
            
                        <!-- Dropdown menu -->
                        <div id="dropdown-{{ $course->id }}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200 text-center" aria-labelledby="dropdownDefaultButton-{{ $course->id }}">
                                <li>
                                    <form class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" action="{{ route('course.destroy', $course->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="font-medium text-red-600 hover:underline" onclick="return confirm('Are you sure you want to delete the course?')">Delete</button>
                                    </form>
                                </li>
                                <li>
                                    <a href="{{ route('course.edit', $course->id) }}" class="block px-4 py-2 text-blue-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                                </li>
                                <li>
                                    <a href="{{ route('file.download', $course->id) }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                        <i class="fa-solid fa-download"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    @endif
                    @if (auth()->user()->role !== "teacher")
                    
                        <a href="{{ route('file.download', $course->id) }}" class="block px-4 py-2">
                            <i class="fa-solid fa-download text-2xl mr-10  dark:hover:text-white"  ></i>
                        </a>
                    
                    @endif
                </td>
            </tr>
   
            @endforeach
        </tbody>
    </table>
    
    
</div>

</div>