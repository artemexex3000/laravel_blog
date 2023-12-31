@props(['comment'])
<article class="flex bg-gray-100 p-6 rounded-xl border border-gray-200">
    <div class="flex-shrink-0">
        <img src="https://i.pravatar.cc/100?id={{ $comment->id }}"
             alt="Error picture :("
             width="60"
             height="60"
             class="rounded-xl">
    </div>

    <div class="ml-3">
        <header class="mb-3">
            <h3 class="font-bold">{{ $comment->author->username }}</h3>
            <p class="text-xs">
                Posted
                <time>{{ $comment->created_at->diffForHumans() }}</time>
            </p>

        </header>

        <p>
            {{ $comment->body }}
        </p>
    </div>
</article>
