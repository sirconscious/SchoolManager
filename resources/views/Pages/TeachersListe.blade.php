@extends('Layouts.AdminLayout') 
@section('content')
<div class="flex justify-center flex-col mt-12  items-start w-full h-screen"> 
    {{-- <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400 mb-1 w-full">
        <li class="me-2">
            <a href="{{ route('admin.teacherList') }}" 
               class="inline-block p-4 rounded-t-lg 
               {{ request()->routeIs('admin.teacherList') ? 'text-blue-600 bg-gray-100 dark:bg-gray-800 dark:text-blue-500' : 'hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300' }}">
                Teachers
            </a>
        </li>
        
        <li class="me-2">
            <a href="{{ route('admin.addTeacher') }}" 
               class="inline-block p-4 rounded-t-lg 
               {{ request()->routeIs('admin.addTeacher') ? 'text-blue-600 bg-gray-100 dark:bg-gray-800 dark:text-blue-500' : 'hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300' }}">
                Add Teacher
            </a>
        </li>
    
      
    </ul> --}} 
    <a href="{{ route('admin.addTeacher') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"><i class="fa-solid fa-plus"></i> Add teacher</a>

    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Student name
                </th>
                <th scope="col" class="px-6 py-3">
                    email
                </th>
                <th scope="col" class="px-6 py-3">
                    Phone
                </th>
               
                <th scope="col" class="px-6 py-3">
                   Actions
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$user->name}}
                </th>
                <td class="px-6 py-4">
                    {{$user->email}}
                </td>
                <td class="px-6 py-4">
                    {{$user->phone}}
                </td>
                
                <td class=" py-4 text-right flex justify-evenly">
                    {{-- <a href="" class="font-medium text-red-600 hover:underline">Delete</a> --}}
                    <form action="{{route("user.destroy",$user->id)}}" method="POST"> @csrf @method("DELETE")
                        <button type="submit" class="font-medium text-red-600 hover:underline" onclick="return confirm('Are you sure you want to delete the teacher?')"  >Delete</button></form>
                    <a href="{{route("admin.editTeacher",$user->id)}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                </td>
            </tr>
   
            @endforeach
        </tbody>
    </table>
</div>

    </div>
@endsection