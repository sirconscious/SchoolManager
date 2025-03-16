@extends('Layouts.TeacherLayout') 
@section('content')
<div class="flex justify-center flex-col items-center h-screen relative mt-2 w-full"> 
    <h2 class="text-4xl font-extrabold dark:text-white absolute left-64 top-24 ">{{$recordes->first()->user->name}}'s recoreds :</h2>

<div class="relative overflow-x-auto ml-50 w-[1200px] mt-38">

    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Exame 
                </th>
                <th scope="col" class="px-6 py-3">
                    Note
                </th>
                <th scope="col" class="px-6 py-3">
                    Comment
                </th>
                <th scope="col" class="px-6 py-3">
                    Created At
                </th>
            </tr>
        </thead>
        <tbody class="max-h-52 overflow-y-scroll"> 
            @foreach ($recordes as $recored)
                
            <tr class="bg-white dark:bg-gray-800">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$recored->exames->name}}
                </th>
                <td class="px-6 py-4">
                    {{$recored->note}}
                </td>
                <td class="px-6 py-4">
                    {{$recored->comment}}
                </td>
                <td class="px-6 py-4">
                    {{$recored->created_at}}
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>

</div>