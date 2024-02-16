<article class="flex flex-col shadow-md my-4 custom-width">
    <div class="bg-white flex flex-col justify-start p-6">
        <div class="flex items-center space-x-4">
            <img src="{{ asset('images/2919906.png') }}" alt="Profile Icon" class="w-8 h-8 rounded-full">
            <p class="font-semibold">Bilal Ez-zaim</p>
        </div>
        <a href="#" class="pb-6 mt-2">{{$item->content}}</a>
    </div>
    @if($item->image != 'null')
    <!-- Article Image -->
    <a href="#" class="mx-auto">
        <img src="/images/{{$item->image}}" width="600" height="315">
    </a>
    @endif
    <div class="bg-white flex flex-col justify-start p-6">
        <div class="flex items-center justify-between">
        <form action="{{ route('post.like', ['id' => $item->id]) }}" method="POST">
                    @csrf
            <button type="submit" class="flex items-center gap-1 text-gray-800 hover:text-black">
                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C6.11 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-4.11 6.86-8.55 11.54L12 21.35z" />
                </svg>
                <span>42</span>
            </button>
            
            </form>
            <a href="#" class="uppercase text-gray-800 hover:text-black">Continue Reading <i class="fas fa-arrow-right"></i></a>
        </div>
        <div class="mt-4">
            <h2 class="text-lg font-bold mb-2">Comments</h2>
            <div class="p-4 bg-gray-100 rounded">
                <div class="flex items-start space-x-4">
                    <img src="{{ asset('images/2919906.png') }}" alt="User Avatar" class="w-8 h-8 rounded-full">
                    <div>
                        <p class="font-semibold">John Doe</p>
                        <p class="text-sm">This is a great article! Thanks for sharing.</p>
                    </div>
                </div>
                <div class="flex items-start mt-4 space-x-4">
                    <img src="{{ asset('images/2919906.png') }}" alt="User Avatar" class="w-8 h-8 rounded-full">
                    <div>
                        <p class="font-semibold">Jane Smith</p>
                        <p class="text-sm">I found this very informative. Keep up the good work!</p>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <h2 class="text-lg font-bold mb-2">Add a Comment</h2>
                <div class="flex items-start space-x-4">
                    <img src="{{ asset('images/2919906.png') }}" alt="User Avatar" class="w-8 h-8 rounded-full">
                    <div class="flex flex-col w-full">
                    <form action="{{ route('post.comment', ['id' => $item->id]) }}" method="POST">
                            @csrf
                            <input name="content" type="text" class="border rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500 p-2" placeholder="Write your comment">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 mt-2 rounded">Post Comment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>