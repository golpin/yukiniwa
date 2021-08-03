@if ($post->id == $like->post_id && Auth::user()->id == $like->user_id)
            <form action="{{ route('user.unlike', $post) }}" method="POST">
                @csrf
                <button type="submit">
                    <svg class="w-6 h-6 mr-6 text-pink-500 fill-current " fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                        </path>
                    </svg>
                </button>
            </form>
            @else
            <form action="{{ route('user.like', $post) }}" method="POST">
                @csrf
                <button type="submit">
                    <svg class="w-6 h-6 mr-6 text-gray-400 fill-current" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                        </path>
                    </svg>
                </button>
            </form>
            @endif