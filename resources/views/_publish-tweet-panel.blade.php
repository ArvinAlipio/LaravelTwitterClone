<div class="border border-blue-400 rounded-lg px-8 py-6 mb-8">
    <form method="POST" action="/tweets">
        @csrf

        <textarea name="body" class="w-full" placeholder="What's on your mind?"></textarea>
        
        <hr class="my-4">

        <footer class="flex justify-between">
            <img src="{{ auth()->user()->avatar }}" class="rounded-full mr-2" width="50" height="50">
            <button type="submit" class="bg-blue-500 rounded-lg shadow py-2 px-2 text-white">Post Tweet</button>
        </footer>

    </form>

    @error('body')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
    @enderror

</div>