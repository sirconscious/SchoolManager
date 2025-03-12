@extends('Layouts.TeacherLayout') 
@section('content')
<div class="flex justify-center items-center h-screen  mt-2 w-full relative">
    <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400 mb-1 absolute top-20 left-64">
        <li class="me-2">
            <a href="{{ route('teacher.studentList') }}" 
               class="inline-block p-4 rounded-t-lg 
               {{ request()->routeIs('teacher.studentList') ? 'text-blue-600 bg-gray-100 dark:bg-gray-800 dark:text-blue-500' : 'hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300' }}">
                Students
            </a>
        </li>
        
        <li class="me-2">
            <a href="{{ route('record.create') }}" 
               class="inline-block p-4 rounded-t-lg 
               {{ request()->routeIs('record.create') ? 'text-blue-600 bg-gray-100 dark:bg-gray-800 dark:text-blue-500' : 'hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300' }}">
                Add Record
            </a>
        </li>
    </ul>



    <div class="relative overflow-x-auto shadow-md sm:rounded-lg ml-60 w-[1200px] mt-28">
        <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">
            <div>
               
                <select id="groupes" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected value="all">Choose a group</option>
               @foreach ($groupes as $group)
                <option value="{{$group->group_name}}">{{$group->group_name}}</option>
               @endforeach
                </select>
            
            </div>
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </div>
                <input type="text" id="table-search" class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
            </div>
        </div>

      <div class="relative overflow-x-auto shadow-md sm:rounded-lg  w-[1200px] h-[500px] overflow-y-auto">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                    Phone
                </th>
                <th scope="col" class="px-6 py-3">
                    Group
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody id="students" class="overflow-y-auto">
            @foreach ($students as $student)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $student->name }}
                </th>
                <td class="px-6 py-4">
                    {{ $student->email }}
                </td>
                <td class="px-6 py-4">
                    {{ $student->phone }}
                </td>
                <td class="px-6 py-4">
                    {{ $student->group }}
                </td>
                <td class="px-6 py-4">
                    <div >
                        <button id="dropdownMenuIconButton" data-dropdown-toggle="dropdownDots" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600" type="button">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                            <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                            </svg>
                            </button>
                        <div id="dropdownDots" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700 dark:divide-gray-600">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIcon">
                              <li>
                                <a href="" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white   border-b-1  border-blue-950">Add record</a>
                              </li>
                              <li>
                                <a href="" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 w-full text-start dark:hover:text-white">View records</a>
                              </li>
                           
                            </ul>
                          
                        </div>
                    </div>
            
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

    </div>
    
</div>
<script>
    let groupe = document.getElementById('groupes'); 
    let studetns = document.getElementById("students") ;
    groupe.addEventListener('change' , function(){
        if (this.value == "all") {
            window.location.reload();
        }
        fetch(`http://localhost:8000/get-students/${this.value}`)
        .then(res => res.json())
        .then(data => {
            // console.log(data[5].group);
            studetns.innerHTML = '';
            for (let std in data ){
                let option = document.createElement('option');
                let tr = document.createElement('tr');
                tr.classList.add('bg-white', 'border-b', 'dark:bg-gray-800', 'dark:border-gray-700', 'hover:bg-gray-50', 'dark:hover:bg-gray-600');
tr.innerHTML = `
    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
        ${data[std].name}
    </th>
    <td class="px-6 py-4">${data[std].email}</td>
    <td class="px-6 py-4">${data[std].phone}</td>
    <td class="px-6 py-4">${data[std].group}</td>
    <td class="px-6 py-4 relative">
        <button class="dropdown-btn inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600" type="button">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
            </svg>
        </button>
        <div class="dropdown-menu z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700 dark:divide-gray-600 absolute right-0 mt-2">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                <li>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white border-b border-blue-950">Add record</a>
                </li>
                <li>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 w-full text-start dark:hover:text-white">View records</a>
                </li>
            </ul>
        </div>
    </td>
`;

students.appendChild(tr);

// Attach click event to toggle dropdown
const dropdownBtn = tr.querySelector('.dropdown-btn');
const dropdownMenu = tr.querySelector('.dropdown-menu');

dropdownBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    dropdownMenu.classList.toggle('hidden');
});

// Close dropdown if clicking outside
document.addEventListener('click', (e) => {
    if (!dropdownBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
        dropdownMenu.classList.add('hidden');
    }
});
                studetns.appendChild(option);
            }
        })
    })
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
