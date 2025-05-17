@extends('Layouts.AdminLayout')

@section('content')
    <div class="p-6 mt-8">
            <!-- Videos Management Section -->
            <section id="videos" class="mb-12">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold">Video Management</h2>
                <button class=" bg-blue-600 hover:bg-primary-700 text-white px-4 py-2 rounded-md flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Add Video
                    </button>
                </div>

                <div class="bg-gray-800 rounded-lg shadow-md border border-gray-700 overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-700">
                        <thead class="bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Title
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Category
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Duration
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Level
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700">
                        @foreach($videos as $video)
                            <tr class="hover:bg-gray-750">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 bg-gray-700 rounded">
                                            <div class="h-full w-full flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                        <div class="text-sm font-medium">{{ $video->nom }}</div>
                                    </div>
                                    </div>
                                </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $video->cours->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $video->duration }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($video->level == 'Beginner')
                                        bg-green-900 text-green-300
                                    @elseif($video->level == 'Intermediate')
                                        bg-yellow-900 text-yellow-300
                                    @else
                                        bg-red-900 text-red-300
                                    @endif
                                ">
                                    {{ $video->level }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                    <button class="text-indigo-400 hover:text-indigo-300 edit-video" 
                                            data-id="{{ $video->id }}"
                                            data-title="{{ $video->nom }}"
                                            data-category="{{ $video->cours_id }}"
                                            data-level="{{ $video->level }}"
                                            data-duration="{{ $video->duration }}"
                                            title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
                                    <button class="text-blue-400 hover:text-blue-300 view-video" 
                                            data-id="{{ $video->id }}"
                                            data-title="{{ $video->nom }}"
                                            data-duration="{{ $video->duration }}"
                                            data-level="{{ $video->level }}"
                                            data-src="{{ asset('storage/'.$video->video_path) }}"
                                            title="View">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                    <form action="{{route("playlists.destroy" , $video)}}" method="POST"> 
                                        @csrf 
                                        @method("delete")
                                        <button class="text-red-400 hover:text-red-300" title="Delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Add/Edit Video Modal (hidden by default) -->
            <div id="videoModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 hidden">
                <div class="bg-gray-800 rounded-lg shadow-xl max-w-2xl w-full mx-4">
                    <div class="flex justify-between items-center border-b border-gray-700 p-4">
                    <h3 class="text-lg font-semibold" id="modalTitle">Add New Video</h3>
                        <button id="closeModal" class="text-gray-400 hover:text-gray-300 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="p-6">
                    <form id="videoForm" action="{{route('playlists.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" id="formMethod" value="POST">
                            <div class="mb-4">
                                <label class="block text-gray-300 text-sm font-medium mb-2" for="title">
                                    Video Title
                                </label>
                            <input class="bg-gray-700 text-white border border-gray-600 rounded-md w-full py-2 px-3 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent" 
                                  id="title" name="nom" type="text" placeholder="Enter video title">
                            </div>
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-gray-300 text-sm font-medium mb-2" for="category">
                                        Category
                                    </label>
                                <select class="bg-gray-700 text-white border border-gray-600 rounded-md w-full py-2 px-3 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent" 
                                       id="category" name="cours_id">
                                       @foreach ($cours as $cour)
                                       <option value="{{$cour->id}}">{{$cour->name}}</option>
                                       @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-gray-300 text-sm font-medium mb-2" for="level">
                                        Level
                                    </label>
                                <select class="bg-gray-700 text-white border border-gray-600 rounded-md w-full py-2 px-3 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent" 
                                       id="level" name="level">
                                        <option value="Beginner">Beginner</option>
                                        <option value="Intermediate">Intermediate</option>
                                        <option value="Advanced">Advanced</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-300 text-sm font-medium mb-2" for="duration">
                                    Duration (minutes:seconds)
                                </label>
                            <input class="bg-gray-700 text-white border border-gray-600 rounded-md w-full py-2 px-3 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent" 
                                  id="duration" name="duration" type="text" placeholder="12:30">
                            </div>
                            <div class="mb-6">
                                <label class="block text-gray-300 text-sm font-medium mb-2" for="videoUpload">
                                    Upload Video
                                </label>
                                <div class="flex items-center justify-center w-full">
                                    <label class="flex flex-col w-full h-32 border-2 border-dashed border-gray-600 rounded-md hover:border-primary-500 hover:bg-gray-700/50 cursor-pointer">
                                        <div class="flex flex-col items-center justify-center pt-7">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                            </svg>
                                            <p class="pt-1 text-sm text-gray-400">Drag & drop or click to upload</p>
                                        </div>
                                    <input id="videoUpload" name="video_path" type="file" class="opacity-0" accept="video/*" />
                                    </label>
                                </div>
                            </div>
                            <div class="flex justify-end space-x-3">
                                <button type="button" id="cancelModal" class="px-4 py-2 bg-gray-700 text-gray-300 rounded-md hover:bg-gray-600">
                                    Cancel
                                </button>
                            <button type="submit" class=" bg-blue-600  px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700">
                                    Save Video
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        <!-- Video Player Modal -->
        <div id="videoPlayerModal" class="fixed inset-0 bg-black bg-opacity-90 flex items-center justify-center z-50 hidden">
            <div class="bg-gray-800 rounded-lg shadow-xl max-w-4xl w-full mx-4">
                <div class="flex justify-between items-center border-b border-gray-700 p-4">
                    <h3 class="text-lg font-semibold" id="videoPlayerTitle">Video Title</h3>
                    <button id="closeVideoPlayer" class="text-gray-400 hover:text-gray-300 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="p-6">
                    <video id="videoPlayer" controls autoplay class="w-full aspect-video bg-black rounded-md">
                        Your browser does not support the video tag.
                    </video>
                    <div class="flex items-center mt-4 space-x-4">
                        <div class="text-sm text-gray-400" id="videoDuration"></div>
                        <span id="videoLevel" class="px-2 py-0.5 rounded-full text-xs"></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- JavaScript for modals -->
            <script>
                // Get the buttons and modal
                const addVideoBtn = document.querySelector('#videos button');
                const modal = document.getElementById('videoModal');
                const closeModal = document.getElementById('closeModal');
                const cancelModal = document.getElementById('cancelModal');
                
                // Show modal when clicking Add Video button
                addVideoBtn.addEventListener('click', () => {
                    modal.classList.remove('hidden');
                });
                
                // Hide modal when clicking Close or Cancel buttons
                closeModal.addEventListener('click', () => {
                    modal.classList.add('hidden');
                });
                
                cancelModal.addEventListener('click', () => {
                    modal.classList.add('hidden');
                });
                
                // Also hide modal when clicking outside of it
                window.addEventListener('click', (event) => {
                    if (event.target === modal) {
                        modal.classList.add('hidden');
                    }
                });

            // Video Player Modal
            const videoPlayerModal = document.getElementById('videoPlayerModal');
            const videoPlayer = document.getElementById('videoPlayer');
            const videoPlayerTitle = document.getElementById('videoPlayerTitle');
            const videoDuration = document.getElementById('videoDuration');
            const videoLevel = document.getElementById('videoLevel');
            const closeVideoPlayer = document.getElementById('closeVideoPlayer');
            
            // Add event listeners to all view buttons
            document.querySelectorAll('.view-video').forEach(button => {
                button.addEventListener('click', () => {
                    // Set video details
                    const title = button.getAttribute('data-title');
                    const duration = button.getAttribute('data-duration');
                    const level = button.getAttribute('data-level');
                    const videoSrc = button.getAttribute('data-src');
                    
                    // Update modal content
                    videoPlayerTitle.textContent = title;
                    videoDuration.textContent = duration;
                    
                    // Set level badge color
                    videoLevel.textContent = level;
                    if (level === 'Beginner') {
                        videoLevel.className = 'px-2 py-0.5 rounded-full text-xs bg-green-900 text-green-300';
                    } else if (level === 'Intermediate') {
                        videoLevel.className = 'px-2 py-0.5 rounded-full text-xs bg-yellow-900 text-yellow-300';
                    } else {
                        videoLevel.className = 'px-2 py-0.5 rounded-full text-xs bg-red-900 text-red-300';
                    }
                    
                    // Set video source and show modal
                    videoPlayer.src = videoSrc;
                    videoPlayerModal.classList.remove('hidden');
                    videoPlayer.play();
                });
            });
            
            // Close video player
            closeVideoPlayer.addEventListener('click', () => {
                videoPlayerModal.classList.add('hidden');
                videoPlayer.pause();
            });
            
            // Also hide video player when clicking outside of it
            window.addEventListener('click', (event) => {
                if (event.target === videoPlayerModal) {
                    videoPlayerModal.classList.add('hidden');
                    videoPlayer.pause();
                }
            });

            // Edit video functionality
            document.querySelectorAll('.edit-video').forEach(button => {
                button.addEventListener('click', () => {
                    const id = button.getAttribute('data-id');
                    const title = button.getAttribute('data-title');
                    const category = button.getAttribute('data-category');
                    const level = button.getAttribute('data-level');
                    const duration = button.getAttribute('data-duration');

                    // Update modal title
                    document.getElementById('modalTitle').textContent = 'Edit Video';
                    
                    // Update form action and method
                    const form = document.getElementById('videoForm');
                    form.action = `/playlists/${id}`;
                    document.getElementById('formMethod').value = 'PUT';
                    
                    // Fill form fields
                    document.getElementById('title').value = title;
                    document.getElementById('category').value = category;
                    document.getElementById('level').value = level;
                    document.getElementById('duration').value = duration;
                    
                    // Show modal
                    modal.classList.remove('hidden');
                });
            });

            // Reset form when adding new video
            addVideoBtn.addEventListener('click', () => {
                document.getElementById('modalTitle').textContent = 'Add New Video';
                document.getElementById('videoForm').action = "{{route('playlists.store')}}";
                document.getElementById('formMethod').value = 'POST';
                document.getElementById('videoForm').reset();
                modal.classList.remove('hidden');
                });
            </script>
    </div>
@endsection
