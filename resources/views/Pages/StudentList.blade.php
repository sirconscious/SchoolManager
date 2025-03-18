@extends('Layouts.AdminLayout')
@section('content')
<div class="mt-18">
       
    {{-- <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400 mb-1">
        <li class="me-2">
            <a href="{{ route('admin.studentList') }}" 
               class="inline-block p-4 rounded-t-lg 
               {{ request()->routeIs('admin.studentList') ? 'text-blue-600 bg-gray-100 dark:bg-gray-800 dark:text-blue-500' : 'hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300' }}">
                Students
            </a>
        </li>
        
        <li class="me-2">
            <a href="{{ route('admin.dashbored') }}" 
               class="inline-block p-4 rounded-t-lg 
               {{ request()->routeIs('admin.dashbored') ? 'text-blue-600 bg-gray-100 dark:bg-gray-800 dark:text-blue-500' : 'hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300' }}">
                Add Student
            </a>
        </li>
    
      
    </ul> --}}
    <a  href="{{ route('admin.dashbored') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Add Student</a>

</div> 
        <div class="mt-3 max-w-[150px]">
            <select id="groupes" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="all" >All</option>
               @foreach ($groupes as $groupe)
               <option value="{{$groupe->group_name}}">{{$groupe->group_name}}</option>
           
               @endforeach
              </select>
        </div>
 
    <div class="flex justify-center    items-start mt-5 h-screen"> 
    


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
        <tbody id="students">
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
