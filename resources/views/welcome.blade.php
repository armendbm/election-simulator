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
            <h1>VISUAL OVERHAUL TO BE RELEASED</h1>
            <h2>This version is for functional testing only</h2>
            <p>Current version is merely for basic functional testing and site layout. All UI is to be overhauled between beta and final release.</p>
            <h2>Next Release: Beta Midnight 04/08/22</h2>
            <h2>Version: Alpha 1.2</h2>
            <p>--Updated Site Layout--</p>
        </div>
    </div>
    @if (count($elections->where('public', 1)) > 0)
    <h3>Public Elections</h3>
    <ul class="list-group list-group-flush">
        @foreach ($elections->where('public', 1) as $election)
        <p>
            {{ $election->name }} {{ $election->description }}
            <a href="{{ route('elections.show', ['election' => $election->id]) }}" class="btn btn-primary">View Results</a>
        </p>
        @endforeach
    </ul>
    @endif
</x-app-layout>
