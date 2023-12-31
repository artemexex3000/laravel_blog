<x-panel>
    @auth()
        <form action="/posts/{{ $post->slug }}/comment"
              method="post">
            @csrf

            <header class="flex items-center">
                <img src="https://i.pravatar.cc/100?id={{ auth()->id() }}"
                     alt="Error picture :("
                     width="40"
                     height="40"
                     class="rounded-full">
                <h2 class="ml-3">Want to participate?</h2>
            </header>

            <div class="mt-5">
                <textarea
                    name="body"
                    class="w-full text-sm focus:outline-none"
                    cols="30"
                    rows="10"
                    placeholder="Quick, thing of something to say!"
                    required></textarea>

                <x-form.error name="body"/>
            </div>

            <div class="flex justify-end mt-10">
                <x-form.button>Post</x-form.button>
            </div>
        </form>
    @endauth
    @guest()
        <h2>Wanna to comment?
            <a href="/signin" class="text-blue-500 hover:underline">Sign In
            </a> or
            <a href="/register" class="text-blue-500 hover:underline"> Sign Up!
            </a>
        </h2>
    @endguest
</x-panel>
