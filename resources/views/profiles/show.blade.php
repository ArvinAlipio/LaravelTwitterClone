{{-- @extends('layouts.app')

@section('content') --}}
<x-app>
    <header class="mb-6 relative">
       <div class="relative">
            <img src="https://images.unsplash.com/photo-1468186402854-9a641fd7a7c4?ixlib=rb-1.2.1&auto=format&fit=crop&w=700&h=223" class="mb-2"/>
            
            <img src="{{ $user->avatar }}" class="rounded-full mr-2 absolute bottom-0 transform -translate-x-1/2 translate-y-1/2" style="left:50%"  width="150">
            {{-- left: calc(50% - 75px); top: 138px --}}
       </div>
        

        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="font-bold text-2xl mb-0">{{ $user->name }}</h2>
                <p class="text-sm">Joined {{ $user->created_at->diffForHumans() }}</p>
            </div>

            <div class="flex">
                @can('edit', $user)
                <a href="{{ $user->path('edit') }}" class="rounded-full border border-gray-300 py-2 px-4 text-black text-sm mr-2">Edit Profile</a>
                @endcan

               <x-follow-button :user="$user"></x-follow-button>
            </div>
        </div>
        
        <p class="text-sm">Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla auctor augue sed porttitor interdum. In porttitor sapien quis erat tempor, ac pulvinar orci molestie. Etiam et purus sit amet erat semper convallis. Integer ultricies ornare justo sit amet lobortis.</p>
       
    </header>
    <hr>

    @include('_timeline', [
        'tweets' => $user->tweets
    ])

</x-app>
{{-- @endsection --}}