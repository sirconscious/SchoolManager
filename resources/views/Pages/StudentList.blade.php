@extends('Layouts.AdminLayout')
@section('content')
<div class="mt-18 flex justify-between">
    <div class="max-w-[150px]">
        <select id="groupes" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="all">All</option>
            @foreach ($groupes as $groupe)
            <option value="{{ $groupe->group_name }}">{{ $groupe->group_name }}</option>
            @endforeach
        </select>
    </div>
    <a href="{{ route('admin.dashbored') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
        <i class="fa-solid fa-plus"></i> Add Student
    </a>
</div>

<div class="flex justify-center items-start mt-5 h-screen">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">Student name</th>
                <th scope="col" class="px-6 py-3">Email</th>
                <th scope="col" class="px-6 py-3">Phone</th>
                <th scope="col" class="px-6 py-3">Group</th>
                <th scope="col" class="px-6 py-3">Actions</th>
            </tr>
        </thead>
        <tbody id="students">
            @foreach ($users as $user)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $user->name }}
                </th>
                <td class="px-6 py-4">{{ $user->email }}</td>
                <td class="px-6 py-4">{{ $user->phone }}</td>
                <td class="px-6 py-4">{{ $user->group }}</td>
                <td class="py-4 text-right flex justify-evenly">
                    
<button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Action <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
    </svg>
    </button>
    
    <!-- Dropdown menu -->
    <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-32 dark:bg-gray-700">
        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
          <li class="text-center">

            <button type="button" 
            data-modal-target="deleteModal" 
            data-modal-toggle="deleteModal" 
            data-delete-url="{{ route('user.destroy', $user->id) }}" 
            class="font-medium text-red-600 hover:underline">
        Delete
    </button>
          </li>
        <li class="text-center">
            <a href="{{ route('admin.editStudent', $user->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>

        </li>
        </ul>
    </div>
    
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Delete Student</h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="deleteModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <p class="text-gray-500 dark:text-gray-400">Are you sure you want to delete this student?</p>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">Yes, delete</button>
                </form>
                <button data-modal-hide="deleteModal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('[data-modal-toggle="deleteModal"]');
        const deleteForm = document.getElementById('deleteForm');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const deleteUrl = button.getAttribute('data-delete-url');
                deleteForm.setAttribute('action', deleteUrl);
            });
        });
    });
    
</script>
<script>
    let groupes = document.getElementById('groupes');
    let students = document.getElementById('students');
    
    groupes.addEventListener('change', function () {
        if (this.value == "all") {
            window.location.reload();
        
        }
        fetch(`http://localhost:8000/get-students/${this.value}`)
            .then(res => res.json())
            .then(data => {
                students.innerHTML = '';
                data.forEach(student => {
                    let tr = document.createElement('tr');
                    tr.classList.add('bg-white', 'border-b', 'dark:bg-gray-800', 'dark:border-gray-700', 'hover:bg-gray-50', 'dark:hover:bg-gray-600');
    
                    let nameCell = document.createElement('th');
                    nameCell.scope = 'row';
                    nameCell.className = 'px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white';
                    nameCell.textContent = student.name;
                    tr.appendChild(nameCell);
    
                    let emailCell = document.createElement('td');
                    emailCell.className = 'px-6 py-4';
                    emailCell.textContent = student.email;
                    tr.appendChild(emailCell);
    
                    let phoneCell = document.createElement('td');
                    phoneCell.className = 'px-6 py-4';
                    phoneCell.textContent = student.phone;
                    tr.appendChild(phoneCell);
    
                    let groupCell = document.createElement('td');
                    groupCell.className = 'px-6 py-4';
                    groupCell.textContent = student.group;
                    tr.appendChild(groupCell);
    
                    let actionsCell = document.createElement('td');
                    actionsCell.className = 'py-4 text-right flex justify-evenly';
                    
                    let deleteForm = document.createElement('form');
                    deleteForm.action = `/user/${student.id}`;
                    deleteForm.method = 'POST';
                    deleteForm.innerHTML = `
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="font-medium text-red-600 hover:underline" onclick="return confirm('Are you sure you want to delete the student?')">Delete</button>
                    `;
                    actionsCell.appendChild(deleteForm);
    
                    let editLink = document.createElement('a');
                    editLink.href = `/admin/editStudent/${student.id}`;
                    editLink.className = 'font-medium text-blue-600 dark:text-blue-500 hover:underline';
                    editLink.textContent = 'Edit';
                    actionsCell.appendChild(editLink);
    
                    tr.appendChild(actionsCell);
                    students.appendChild(tr);
                });
            })
            .catch(err => console.log(err));
    });
</script>

@endsection