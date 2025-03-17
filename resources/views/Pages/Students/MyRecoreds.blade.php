@extends('Layouts.StudentsLayout')
@section('content')
<div class="flex justify-center flex-col mt-12 items-start w-full h-screen">
    <div class="relative overflow-x-auto w-full max-h-[500px] overflow-y-auto shadow-md rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 sticky top-0">
                <tr>
                    <th scope="col" class="px-6 py-3">Controle</th>
                    <th scope="col" class="px-6 py-3">Module</th>
                    <th scope="col" class="px-6 py-3">Type</th>
                    <th scope="col" class="px-6 py-3">Note</th>
                    <th scope="col" class="px-6 py-3">Comment</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recordes as $rec)
                <tr class="bg-white dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $rec->exames->name }}
                    </th>
                    <td class="px-6 py-4">{{ $rec->exames->course->name }}</td>
                    <td class="px-6 py-4">{{ $rec->exames->type }}</td>
                    <td class="px-6 py-4">{{ $rec->note }}</td>
                    <td class="px-6 py-4">{{ $rec->comment }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection