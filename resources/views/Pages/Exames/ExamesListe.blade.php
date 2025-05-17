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

@extends($layout)@section('content')
<div class="p-4 mt-14">
    <div class="p-4 border-2 border-gray-200 rounded-lg dark:border-gray-700">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Exams List</h1>
            @if (auth()->check() && auth()->user()->role == "teacher")
                <a href="{{route("exame.create")}}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150 dark:bg-blue-700 dark:hover:bg-blue-800 dark:focus:ring-blue-800">
                    <i class="fa-solid fa-plus mr-2"></i> Add Exame
                </a>
            @endif
        </div>

        @if ($exames->isEmpty())
            <div class="flex flex-col items-center justify-center py-12 text-gray-500 dark:text-gray-400">
                <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                </svg>
                <p class="text-lg font-medium">No exams available.</p>
                <p class="text-sm">Check back later for new exams.</p>
            </div>
        @else
             @if (auth()->check() && auth()->user()->role !== "student")
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" role="tablist">
                    <li class="me-2" role="presentation">
                        <a href="{{ route('admin.CoursesListe') }}"
                           class="inline-block p-4 border-b-2 rounded-t-lg {{ request()->routeIs('admin.CoursesListe') ? 'text-blue-600 border-blue-600 dark:text-blue-500 dark:border-blue-500' : 'border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' }}"
                           id="courses-tab" type="button" role="tab" aria-controls="courses" aria-selected="{{ request()->routeIs('admin.CoursesListe') ? 'true' : 'false' }}">
                            Courses
                        </a>
                    </li>
                    <li class="me-2" role="presentation">
                        <a href="{{ route('exame.index') }}"
                           class="inline-block p-4 border-b-2 rounded-t-lg {{ request()->routeIs('exame.index') ? 'text-blue-600 border-blue-600 dark:text-blue-500 dark:border-blue-500' : 'border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' }}"
                           id="exames-tab" type="button" role="tab" aria-controls="exames" aria-selected="{{ request()->routeIs('exame.index') ? 'true' : 'false' }}">
                            Exames
                        </a>
                    </li>
                </ul>
            @endif
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 font-bold">Name</th>
                            <th scope="col" class="px-6 py-3 font-bold">Type</th>
                            <th scope="col" class="px-6 py-3 font-bold">Teacher</th>
                            <th scope="col" class="px-6 py-3 font-bold">Module</th>
                            <th scope="col" class="px-6 py-3 font-bold">Duration</th>
                             @if (auth()->check() && auth()->user()->role == "teacher")
                                <th scope="col" class="px-6 py-3 text-right font-bold">Action</th>
                             @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($exames as $exame)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $exame->name }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $exame->type }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $exame->teacher->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $exame->course->name }}
                            </td>
                             <td class="px-6 py-4">
                                {{ $exame->duree }} minutes
                            </td>
                            @if (auth()->check() && auth()->user()->role == "teacher")
                                <td class="px-6 py-4 text-right">
                                     <div class="inline-flex items-center space-x-3">
                                        <a href="{{ route('exame.edit', $exame->id) }}" class="text-blue-600 dark:text-blue-500 hover:underline" title="Edit Exame">
                                            <i class="fa-solid fa-pencil mr-1"></i>Edit
                                        </a>
                                        <form action="{{ route('exame.destroy', $exame->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this exame?');" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 dark:text-red-500 hover:underline" title="Delete Exame">
                                                <i class="fa-solid fa-trash-can mr-1"></i>Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
