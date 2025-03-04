<div class="flex p-4 {{ $loop->last ? '' : 'border-b border-b-gray-400'}}">

    <div class="mr-2 flex-shrink-0">
        <a href="{{ route('profile', $tweet->user)}}">
            <img src={{ $tweet->user->avatar }} class="rounded-full mr-2" width="50" height="50"/>
        </a>
    </div><!--Tweet content: User icon-->

    <div>
        <a href="{{ route('profile', $tweet->user)}}">
            <h5 class="font-bold mb-4">{{ $tweet->user->name }}</h5>
        </a>
        <p class="text-sm">{{ $tweet->body }}</p>
    </div><!--Tweet content: User name and text-->

</div>