@extends('Layouts.TeacherLayout') 
@section('content')
<div class="flex justify-end w-full items-start mt-15  relative "> 
    

<div class=" overflow-x-auto min-w-[1250px]">
    

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
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    name
                </th>
                <th scope="col" class="px-6 py-3">
                    type
                </th>
                <th scope="col" class="px-6 py-3">
                    teacher
                </th>

                <th scope="col" class="px-6 py-3">
                   Module 
                </th>
                <th scope="col" class="px-6 py-3">
                   Duree 
                </th>
                <th scope="col" class="px-6 py-3">
                   Action 
                </th>
            </tr>
        </thead>
        <tbody>
             @foreach ($exames as $exame)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$exame->name}}
                </th>
                <td class="px-6 py-4">
                    {{$exame->type}}
                </td>
                <td class="px-6 py-4">
                    {{$exame->teacher->name}}
                </td> 
                <td class="px-6 py-4">
                    {{$exame->course->name}}
                </td> 
                <td class="px-6 py-4">
                    {{$exame->duree}}
                </td> 
              
                  <td class=" py-4 text-right flex justify-evenly">
                    <form action="{{route("exame.destroy",$exame->id)}}" method="POST"> @csrf @method("DELETE")
                        <button type="submit" class="font-medium text-red-600 hover:underline" onclick="return confirm('Are you sure you want to delete the exame?')"  >Delete</button></form>
                    <a href="{{route("exame.edit",$exame->id)}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                </td> 
            </tr>
   
            @endforeach 
        </tbody>
    </table>
    
    
</div>

</div> 


</div >

    <a href="{{route("exame.create")}}" class="fixed bottom-10 right-5">
        <div class="px-4 py-4  cursor-pointer rounded-full bg-gradient-to-r from-blue-500 to-green-500 shadow-lg hover:shadow-xl transition-shadow duration-300 ease-in-out">
            <i class="fa-solid fa-plus text-2xl text-white"></i>
        </div>
    </a>
