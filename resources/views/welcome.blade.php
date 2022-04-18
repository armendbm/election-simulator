<x-app-layout>
    {{-- <div class="p-3 p-md-5 m-md-3 text-center">
        <div class="col-md-5 p-lg-5 mx-auto my-5">
            <h1>Elections To-Go</h1>
            <p class="lead">An election simulator that teaches you about democracy.</p>
            <p class="lead">
                <a href="/documentation" class="btn btn-outline-primary">Learn more</a>
            </p>
        </div>
    </div> --}}
    

    <div class="text-center">
        <div>
            <h1>Beta 1.0 Release</h1>
            <h2>Next Release: Final Release 04/27/2022</h2>
        </div>
    </div>
    @if (count($elections->where('public', 1)) > 0)
    <h3>Admin Elections</h3>
    <ul class="list-group list-group-flush">
        @foreach ($elections->where('public', 1) as $election)
            @if ($election->owner_id == 1)
            <p>
                {{ $election->name }} {{ $election->description }}
                <a href="{{ route('elections.show', ['election' => $election->id]) }}" class="btn btn-primary">View Results</a>
            </p>
            @endif
        @endforeach
    </ul>
    @endif
</x-app-layout>
