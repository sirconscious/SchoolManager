@extends('Layouts.AdminLayout')
@section('content')
    <div class="flex justify-center  items-start mt-15 h-screen"> 
        

{{-- <div class="relative overflow-x-auto shadow-md sm:rounded-lg"> --}}
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
                    group
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
                <td class="px-6 py-4">
                    {{$user->group}}
                </td>
                <td class=" py-4 text-right flex justify-evenly">
                    {{-- <a href="" class="font-medium text-red-600 hover:underline">Delete</a> --}}
                    <form action="{{route("user.destroy",$user->id)}}" method="POST"> @csrf @method("DELETE")
                        <button type="submit" class="font-medium text-red-600 hover:underline" onclick="return confirm('Are you sure you want to delete the student?')"  >Delete</button></form>
                    <a href="{{route("admin.editStudent",$user->id)}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                </td>
            </tr>
   
            @endforeach
        </tbody>
    </table>
</div>

    {{-- </div> --}}

@endsection