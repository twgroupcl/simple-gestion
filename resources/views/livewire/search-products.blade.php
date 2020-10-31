<div>
    <input wire:model="search" type="text" placeholder="Search posts by title...">
    <h1>Search Results:</h1>
    <ul>
        @foreach($products as $post)
            <li>{{ $post->name }}</li>
        @endforeach
    </ul>
</div>
