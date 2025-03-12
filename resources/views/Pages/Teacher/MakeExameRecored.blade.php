@extends('Layouts.TeacherLayout') 
@section('content')
<div class="flex justify-center items-center h-screen relative mt-2 w-full">
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
<form class="max-w-sm mx-auto w-full" action="{{route('record.store')}}" method="POST">
    @csrf
    <div class="mb-5">
             
            <div class="flex">
                
                <div class="">
                 <select id="groupes" name="groupes" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 min-w-[150px]">
                    <option value="">Choose a groupe</option>
                    @foreach ($groupes as $groupe)
                     <option value="{{$groupe->group_name}}">{{$groupe->group_name}}</option>   
                     @endforeach
                 </select>
                </div>   
                
                <select id="student" name="users_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-e-lg border-s-gray-100 dark:border-s-gray-700 border-s-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </select>
            </div>
            <div class="mt-2">
                <label for="exames_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an option</label>
                <select id="groupes" name="exames_id" class="bg-gray-50 border my-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 min-w-[150px]">
                    @foreach ($exames as $exame)
                     <option value="{{$exame->id}}">{{$exame->name}}</option>   
                     @endforeach
                 </select>
            </div>
  
<div class="max-w-sm mx-auto">
    <label for="note" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select a Grade:</label>
    <input type="number" id="note" name="note" min="0" max="40" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="16.75" required />
</div>
<div class="max-w-sm mx-auto">
    <label for="comment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your comment</label>
    <textarea id="comment" name="comment" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your comment here..."></textarea>

</div>

    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-2">Register Record</button>
  </form>
  
</div>
<script>
    let groupe = document.getElementById('groupes'); 
    let studetns = document.getElementById("student") ;
    groupe.addEventListener('change' , function(){
        fetch(`http://localhost:8000/get-students/${this.value}`)
        .then(res => res.json())
        .then(data => {
            // console.log(data[5].group);
            studetns.innerHTML = '';
            for (let std in data ){
                let option = document.createElement('option');
                option.value = data[std].id;
                option.textContent = data[std].name;
                studetns.appendChild(option);
            }
        })
    })
</script>