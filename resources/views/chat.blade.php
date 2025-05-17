@extends('Layouts.StudentsLayout') 
@section('content')
<div class="p-4 mt-14 flex-1 flex flex-col h-[calc(100vh-8rem)]">
    <!-- Chat Header -->
    <div class="bg-gray-800 border-b border-gray-700 px-4 py-2 flex items-center justify-between">
        <div class="flex items-center">
            {{-- Mobile sidebar toggle (optional, depends on layout implementation) --}}
            {{-- <button class="md:hidden text-gray-300 hover:text-white mr-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button> --}}
            <h1 class="text-lg font-semibold text-white">{{auth()->user()->group}}</h1>
        </div>
        {{-- Optional: Add other header elements like group members list or settings --}}
    </div>

    <!-- Chat Messages -->
    <div class="flex-1 overflow-y-auto p-4 space-y-4" id="chat-messages">
        <!-- Messages will be loaded here by JavaScript -->
    </div>

    <!-- Chat Input Area -->
    <div class="bg-gray-800 border-t border-gray-700 p-4">
        <form action="{{ route('messages.store') }}" method="POST">
            @csrf
            <div class="flex items-center">
                {{-- File attachment button (optional) --}}
                {{-- <button type="button" class="text-gray-300 hover:text-white mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                    </svg>
                </button> --}}
                <div class="flex-1 bg-gray-700 rounded-lg">
                    <textarea name="body" placeholder="Type your message..." class="w-full bg-transparent border-0 focus:ring-0 text-white placeholder-gray-400 py-2 px-3 resize-none h-10 overflow-hidden rounded-lg"></textarea>
                </div>
                <button type="submit" class="ml-2 bg-blue-600 hover:bg-blue-700 text-white p-2 rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const chatMessages = document.getElementById('chat-messages');
    // Function to fetch messages
    async function fetchMessages() {
        try {
            const response = await fetch('{{ route('messages.api') }}');
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            const data = await response.json();
            renderMessages(data.data);
        } catch (error) {
            console.error('Error fetching messages:', error);
            // Optionally display an error message to the user
        }
    }

    // Function to render messages
    function renderMessages(messages) {
        chatMessages.innerHTML = ''; // Clear existing messages
        const userId = {{ auth()->user()->id }};

        messages.forEach(message => {
            const messageElement = document.createElement('div');
            messageElement.classList.add('flex', 'items-start'); // Base classes

            // Add justify-end only if it's the current user's message
            if (message.user_id === userId) {
                messageElement.classList.add('justify-end');
            }

            let avatarHtml = '';
            if (message.user_id !== userId) {
                 // Assuming a default avatar for other users, replace with actual user avatar if available
                avatarHtml = '<img class="h-8 w-8 rounded-full mr-3" src="{{asset('images/user (1).png')}}" alt="User avatar">';
            }

            const messageContent = document.createElement('div');
            messageContent.classList.add('flex'); // Base flex class

            // Add flex-col or flex-col-reverse based on user
            if (message.user_id === userId) {
                 messageContent.classList.add('flex-col-reverse');
            } else {
                messageContent.classList.add('flex-col');
            }

            const metaInfo = document.createElement('div');
            metaInfo.classList.add('flex', 'items-center', 'mb-1'); // Base meta info classes

             // Add justify-end to meta info only if it's the current user's message
            if (message.user_id === userId) {
                metaInfo.classList.add('justify-end');
            }

            const timeSpan = document.createElement('span');
            timeSpan.classList.add('text-xs', 'text-gray-400', message.user_id === userId ? 'mr-2' : 'ml-2');
            // Format timestamp (basic example, consider a library for better formatting)
            const messageTime = new Date(message.created_at);
            timeSpan.textContent = messageTime.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

            const nameSpan = document.createElement('span');
            nameSpan.classList.add('font-medium', message.user_id === userId ? 'text-blue-500' : (message.user && message.user.role === 'teacher' ? 'text-blue-400' : (message.user && message.user.role === 'admin' ? 'text-red-400' : 'text-green-400'))); // Basic color by role, adjust as needed
             nameSpan.textContent = message.user_id === userId ? 'You' : (message.user ? message.user.name : 'Unknown User'); // Display user name if available

            if (message.user_id === userId) {
                metaInfo.appendChild(timeSpan);
                 metaInfo.appendChild(nameSpan);
            } else {
                metaInfo.appendChild(nameSpan);
                metaInfo.appendChild(timeSpan);
            }

            const bodyDiv = document.createElement('div');
            bodyDiv.classList.add(message.user_id === userId ? 'bg-blue-600' : 'bg-gray-700', 'text-white', 'rounded-lg', 'py-2', 'px-3', 'max-w-md');
            bodyDiv.textContent = message.body; // Display message body

            messageContent.appendChild(metaInfo);
            messageContent.appendChild(bodyDiv);

            messageElement.innerHTML = avatarHtml; // Add avatar HTML
            messageElement.appendChild(messageContent);

            chatMessages.appendChild(messageElement);
        });
         // Scroll to the bottom after rendering new messages
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    // Removed the sendMessage function and associated event listeners

    // Initial fetch and start polling
    fetchMessages(); // Fetch messages on page load
    setInterval(fetchMessages, 5000); // Poll every 5 seconds

</script>
@endsection