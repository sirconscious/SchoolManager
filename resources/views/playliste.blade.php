@extends('Layouts.StudentsLayout')

@section('content')
    <div class="container mx-auto p-4 mt-5 md:p-8">
        {{-- <h1 class="text-3xl font-bold text-center mb-8 text-white">Educational Platform</h1> --}}
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            @foreach($courses as $course)
                <button
                    class="category-btn px-4 py-3 rounded-md transition-colors text-left flex items-center
                    {{ $loop->first ? 'bg-primary-600 text-white font-medium' : 'bg-gray-800 text-gray-300 hover:bg-gray-700' }}"
                    data-category="{{ $course->name }}"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M5 4h14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2z"></path>
                        <path d="M8 2v4"></path>
                        <path d="M16 2v4"></path>
                        <path d="M3 10h18"></path>
                    </svg>
                    {{ $course->name }}
                </button>
            @endforeach
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Video List Column -->
            <div class="lg:col-span-1">
                <div class="bg-gray-800 rounded-lg shadow-md p-4 md:p-6">
                    <h2 id="category-title" class="text-xl font-semibold mb-4 flex items-center">
                        <svg id="category-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 4h14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2z"></path>
                            <path d="M8 2v4"></path>
                            <path d="M16 2v4"></path>
                            <path d="M3 10h18"></path>
                        </svg>
                        <span id="category-name">Select a Category</span>
                    </h2>
                    <div id="video-list" class="space-y-3">
                        <!-- Videos will be populated here by JavaScript -->
                    </div>
                </div>
            </div>
            
            <!-- Video Player Column -->
            <div class="lg:col-span-2">
                <div class="bg-gray-800 rounded-lg shadow-md p-4 md:p-6 h-full">
                    <h2 id="video-title" class="text-xl font-semibold mb-4">Select a Video</h2>
                    <div id="video-container" class="flex flex-col items-center justify-center">
                        <div class="w-full aspect-video bg-gray-900 rounded-md mb-4 flex items-center justify-center">
                            <p class="text-gray-500" id="video-placeholder">Select a video to start watching</p>
                            <video id="video-player" class="w-full aspect-video hidden rounded-md" controls>
                                Your browser does not support the video tag.
                            </video>
                        </div>
                        <div id="video-info" class="w-full hidden">
                            <div class="flex items-center text-sm text-gray-400">
                                <span id="video-duration"></span>
                                <span class="mx-2">•</span>
                                <span id="video-level" class="px-2 py-0.5 rounded-full text-xs"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Convert PHP data to JavaScript object
        const courseData = @json($groupedPlaylists);
        
        // Function to display videos for a selected category
        function displayVideos(category) {
            document.getElementById('category-name').textContent = `${category} Videos`;
            
            const videoListElement = document.getElementById('video-list');
            videoListElement.innerHTML = '';
            
            if (courseData[category]) {
                courseData[category].forEach(video => {
                    const videoElement = document.createElement('div');
                    videoElement.className = 'p-3 border border-gray-700 rounded-md hover:bg-gray-700 cursor-pointer transition-colors';
                    videoElement.innerHTML = `
                        <h3 class="font-medium text-lg">${video.nom}</h3>
                        <div class="flex items-center text-sm text-gray-400 mt-1">
                            <span>${video.duration}</span>
                            <span class="mx-2">•</span>
                            <span class="px-2 py-0.5 rounded-full text-xs ${
                                video.level === 'Beginner' ? 'bg-green-900 text-green-300' :
                                video.level === 'Intermediate' ? 'bg-yellow-900 text-yellow-300' : 'bg-red-900 text-red-300'
                            }">${video.level}</span>
                        </div>
                    `;
                    
                    videoElement.addEventListener('click', () => playVideo(video));
                    videoListElement.appendChild(videoElement);
                });
            } else {
                videoListElement.innerHTML = '<p class="text-gray-400">No videos available for this category.</p>';
            }
            
            // Reset video player
            document.getElementById('video-title').textContent = 'Select a Video';
            document.getElementById('video-player').classList.add('hidden');
            document.getElementById('video-placeholder').classList.remove('hidden');
            document.getElementById('video-info').classList.add('hidden');
        }
        
        // Function to play selected video
        function playVideo(video) {
            // Update video title and info
            document.getElementById('video-title').textContent = video.nom;
            document.getElementById('video-duration').textContent = video.duration;
            document.getElementById('video-level').textContent = video.level;
            document.getElementById('video-level').className = `px-2 py-0.5 rounded-full text-xs ${
                video.level === 'Beginner' ? 'bg-green-900 text-green-300' :
                video.level === 'Intermediate' ? 'bg-yellow-900 text-yellow-300' : 'bg-red-900 text-red-300'
            }`;
            
            // Show video player and info
            document.getElementById('video-player').classList.remove('hidden');
            document.getElementById('video-placeholder').classList.add('hidden');
            document.getElementById('video-info').classList.remove('hidden');
            
            // Set video source and play
            const videoPlayer = document.getElementById('video-player');
            videoPlayer.src = `/storage/${video.video_path}`;
            videoPlayer.pause();
            videoPlayer.currentTime = 0;
            videoPlayer.play();
        }
        
        // Set up event listeners for category buttons
        document.querySelectorAll('.category-btn').forEach(button => {
            button.addEventListener('click', function() {
                // Remove selected state from all buttons
                document.querySelectorAll('.category-btn').forEach(btn => {
                    btn.classList.remove('bg-primary-600', 'text-white', 'font-medium');
                    btn.classList.add('bg-gray-800', 'text-gray-300', 'hover:bg-gray-700');
                });
                
                // Add selected state to clicked button
                this.classList.remove('bg-gray-800', 'text-gray-300', 'hover:bg-gray-700');
                this.classList.add('bg-primary-600', 'text-white', 'font-medium');
                
                // Display videos for selected category
                const category = this.getAttribute('data-category');
                displayVideos(category);
            });
        });
        
        // Initialize with first category if available
        const firstCategory = document.querySelector('.category-btn');
        if (firstCategory) {
            firstCategory.click();
        }
    </script>
@endsection
