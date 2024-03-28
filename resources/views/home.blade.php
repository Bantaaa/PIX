@extends('includes.layout')

@section('content')


<div class="container mx-auto flex flex-wrap py-6 test">

    <!-- Posts Section -->
    <section class="w-full md:w-2/3 flex flex-col items-center px-3 ">


        <!-- POST FORM  -->
        @if(session('Fname'))
        <article class="flex flex-col shadow-md my-4 custom-width test2">
            <div class="w-full md:w-2/3 flex flex-col items-center justify-center px-3 custom-width">
                <div class="max-w-md bg-white rounded px-8 pt-6 pb-8 mb-4 custom-width">
                    <h1 class="text-3xl font-bold mb-8 text-center">Create Post</h1>

                    <form action="{{ route('create') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <div class="flex items-center space-x-4">
                                <img src="{{ asset('images/2919906.png') }}" alt="Profile Icon" class="w-8 h-8 rounded-full">
                                <input type="text" id="content" name="content" class="border rounded px-4 py-2 w-full" placeholder="Write something...">
                            </div>
                        </div>

                        <div class="mb-4">
                            <!-- <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Image:</label> -->
                            <label for="file-upload" class="relative cursor-pointer flex items-center justify-center px-3 py-2 border border-gray-300 rounded-md">
                                <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                <span class="ml-2 text-gray-500">Choose a file</span>
                                <input id="file-upload" name="image" type="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                            </label>
                            <!-- <span id="file-name" class="text-gray-500">No file chosen</span> -->
                        </div>

                        <div class="flex items-center justify-center">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </article>
        @endif


        @foreach ($posts as $post)
        <article class="flex flex-col shadow-md my-4 custom-width">
            <div class="bg-white flex flex-col justify-start p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <img src="{{ asset('images/2919906.png') }}" alt="Profile Icon" class="w-8 h-8 rounded-full">
                        <p class="font-semibold">{{$post->user}}</p>
                    </div>

                    @if(session('Fname'))
                    @if(!$followed[$post->id])
                    <form action="{{ route('follow', ['id' => $post->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Follow</button>
                    </form>

                    @endif
                    @endif

                </div>
                <p class="pb-6 mt-2">{{$post->content}}</p>
            </div>
            @if($post->image != 'null')
            <!-- Article Image -->
            <a href="#" class="mx-auto">
                <img src="/images/{{$post->image}}" width="600" height="315">
            </a>
            @endif
            <div class="bg-white flex flex-col justify-start p-6">
                @if(session('Fname'))
                <div class="flex items-center justify-between">
                    <form action="{{ route('post.like', ['id' => $post->id]) }}" method="POST">
                        @csrf

                        @if($existing_like[$post->id])
                        <button type="submit" class="flex items-center gap-1 text-red-500 hover:text-red">

                            <svg id="heart-icon" class="w-4 h-4 text-red-500 fill-current" viewBox="0 0 24 24">
                                <path d="M12 21.35L5.27 17.47C2.67 15.82 1 13.23 1 10.5C1 7.42 3.42 5 6.5 5C8.07 5 9.5 5.77 10.5 7C11.5 5.77 12.93 5 14.5 5C17.58 5 20 7.42 20 10.5C20 13.23 18.33 15.82 15.73 17.47L12 21.35Z" />
                            </svg>
                            @else
                            <button type="submit" class="flex items-center gap-1 text-gray-800 hover:text-black">
                                <svg id="heart-icon" class="w-4 h-4 text-gray-800 fill-current" viewBox="0 0 24 24">
                                    <path d="M12 21.35L5.27 17.47C2.67 15.82 1 13.23 1 10.5C1 7.42 3.42 5 6.5 5C8.07 5 9.5 5.77 10.5 7C11.5 5.77 12.93 5 14.5 5C17.58 5 20 7.42 20 10.5C20 13.23 18.33 15.82 15.73 17.47L12 21.35Z" />
                                </svg>
                                @endif
                                <span>{{ $likes_count[$post->id] }}</span>
                            </button>

                    </form>
                    <!-- <a href="#" class="uppercase text-gray-800 hover:text-black">Continue Reading <i class="fas fa-arrow-right"></i></a> -->
                </div>
                @else
                <div class="flex items-center justify-between">
                    <form action="{{ route('login') }}">
                        @csrf
                        <button type="submit" class="flex items-center gap-1 text-red-500 hover:text-red">

                            <button type="submit" class="flex items-center gap-1 text-gray-800 hover:text-black">
                                <svg id="heart-icon" class="w-4 h-4 text-gray-800 fill-current" viewBox="0 0 24 24">
                                    <path d="M12 21.35L5.27 17.47C2.67 15.82 1 13.23 1 10.5C1 7.42 3.42 5 6.5 5C8.07 5 9.5 5.77 10.5 7C11.5 5.77 12.93 5 14.5 5C17.58 5 20 7.42 20 10.5C20 13.23 18.33 15.82 15.73 17.47L12 21.35Z" />
                                </svg>
                            </button>

                    </form>
                    <!-- <a href="#" class="uppercase text-gray-800 hover:text-black">Continue Reading <i class="fas fa-arrow-right"></i></a> -->
                </div>
                @endif
                <div class="mt-4">
                    <h2 class="text-lg font-bold mb-2">Comments</h2>

                    @if($post->comments->count() > 0)
                    @foreach ($post->comments as $comment)
                    <h2 class="text-lg font-bold mb-2"></h2>

                    <div class="p-4 bg-gray-100 rounded">

                        <div class="flex items-start space-x-4"> <!-- Add mb-2 class for margin-bottom -->
                            <img src="{{ asset('images/2919906.png') }}" alt="User Avatar" class="w-8 h-8 rounded-full">
                            <div>
                                <p class="font-semibold">{{ $comment->user->Fname .' '. $comment->user->Lname }}</p>
                                <p class="text-sm">{{ $comment->content }}</p>
                            </div>
                        </div>

                    </div>
                    @endforeach
                    @else
                    <p>No comments available.</p>
                    @endif

                    @if(session('Fname'))
                    <div class="mt-4">
                        <h2 class="text-lg font-bold mb-2">Add a Comment</h2>
                        <div class="flex items-start space-x-4">
                            <img src="{{ asset('images/2919906.png') }}" alt="User Avatar" class="w-8 h-8 rounded-full">
                            <div class="flex flex-col w-full">
                                <form action="{{ route('post.comment', ['id' => $post->id]) }}" method="POST">
                                    @csrf
                                    <input name="content" type="text" class="border rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500 p-2" placeholder="Write your comment">
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 mt-2 rounded">Post Comment</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

            </div>
        </article>
        @endforeach

        <div class="d-flex justify-content-center mt-3">
            {{ $posts->links() }}
        </div>


        <!-- Pagination -->
        <div class="flex items-center py-8">
            <a href="#" class="h-10 w-10 bg-blue-800 hover:bg-blue-600 font-semibold text-white text-sm flex items-center justify-center">1</a>
            <a href="#" class="h-10 w-10 font-semibold text-gray-800 hover:bg-blue-600 hover:text-white text-sm flex items-center justify-center">2</a>
            <a href="#" class="h-10 w-10 font-semibold text-gray-800 hover:text-gray-900 text-sm flex items-center justify-center ml-3">Next <i class="fas fa-arrow-right ml-2"></i></a>
        </div>

    </section>

    @if(session('Fname'))
    <!-- Sidebar Section -->
    <aside class="w-full md:w-1/3 flex flex-col items-center px-3">

        <!-- Mini Profile Section -->
        <div class="w-full bg-white shadow flex flex-col items-center my-4 p-8">
            <img src="{{ asset('images/2919906.png') }}" alt="Profile Picture" class="h-20 w-20 rounded-full mb-4">
            <h3 class="text-2xl font-semibold">{{ session('username')}}</h3>
        </div>

        <!-- List of Connections Section -->
        @if(session('Fname'))
        <div class="w-full bg-white shadow flex flex-col items-center my-4 p-6">
            <p class="text-xl font-semibold pb-5">Connections</p>
            <ul class="space-y-4 w-96">
                @foreach($followers as $follower)
                <li class="flex items-center">
                    <img src="{{ asset('images/2919906.png') }}" alt="Profile Picture 1" class="h-8 w-8 rounded-full">
                    <h4 class="ml-3">{{ $follower->user->Fname.' '.$follower->user->Lname }}</h4>

                    <div class="ml-auto relative">
                        <form action="{{ route('chat', ['id' => $follower->user->id]) }}" method="GET" class="inline">
                            <button class="bg-blue-800 text-white px-2 py-1 rounded hover:bg-blue-700">
                                Connect
                            </button>
                        </form>
                        <form action="{{ route('unfollow', ['id' => $follower->id]) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-700 text-white px-2 py-1 rounded hover:bg-red-600">
                                Unfollow
                            </button>
                        </form>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- List of Users Section -->
<div class="w-full bg-white shadow flex flex-col items-center my-4 p-6">
    <p class="text-xl font-semibold pb-5">Users</p>
    <form id="searchForm" class="mb-5">
        <input type="text" id="searchInput" name="query" placeholder="Search" class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded ml-2 hover:bg-blue-400">Search</button>
    </form>
    <ul id="userList" class="space-y-4 w-96">
        @foreach($users as $user)
        <li class="flex items-center">
            <img src="{{ asset('images/2919906.png') }}" alt="Profile Picture" class="h-8 w-8 rounded-full">
            <h4 class="ml-3">{{ $user->Fname .' '. $user->Lname }}</h4>
            <div class="ml-auto relative">
                <form action="{{ route('user_follow', ['id' => $user->id]) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded hover:bg-green-400">
                        Follow
                    </button>
                </form>
            </div>
        </li>
        @endforeach
    </ul>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function() {
        $('#searchForm').submit(function(e) {
            e.preventDefault();
            var keyword = $('#searchInput').val();

            $.ajax({
                type: 'GET',
                url: '/search/events',
                data: {
                    title_s: keyword
                },
                success: function(data) {
                    $('#userList').empty();
                    console.log(data);
                    data.forEach(function(user) {
                        var listItem =
                        $('#userList').append(listItem);
                    });
                },
                error: function(error) {
                    console.error("Error during search:", error);
                }
                
            });
        });
    });
</script>
        @endif



</div>
@endsection