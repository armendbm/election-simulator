<x-app-layout>
    <br>
    <h2>
        Voting Screen
    </h2>
    <br>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container">
                    @if (count(Auth::user()->own_elections()->get()) > 0)
                        <h3 class="mt-3">My Elections</h3>
                        <table class="table table-striped">
                            <thead>
                              <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Held by</th>
                                <th scope="col">Start date</th>
                                <th scope="col">End date</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach (Auth::user()->own_elections()->get() as $election)
                                    <tr>
                                        <td>{{ $election->name }}</td>
                                        <td>{{ $election->description }}</td>
                                        <td>Not sure how to find the person's name who held the election</td>
                                        <td>{{ $election->start_at }}</td>
                                        <td>{{ $election->end_at }}</td>
                                        <td>
                                            <a href="{{ route('elections.votes.create', ['election' => $election->id]) }}" class="btn btn-primary">Vote</a>
                                            <a href="{{ route('elections.show', ['election' => $election->id]) }}" class="btn btn-primary">View Results</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                    <br>
                    @if (count($elections->where('public', 1)) > 0)
                        <h3 class="mt-3">Public Elections</h3>
                        <table class="table table-striped">
                            <thead>
                              <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Held by</th>
                                <th scope="col">Start date</th>
                                <th scope="col">End date</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($elections->where('public', 1) as $election)
                                    @if ($election->name != 'AAA')
                                        <tr>
                                            <td>{{ $election->name }}</td>
                                            <td>{{ $election->description }}</td>
                                            <td>{{ $election->start_at }}</td>
                                            <td>{{ $election->end_at }}</td>
                                            <td>
                                                <a href="{{ route('elections.votes.create', ['election' => $election->id]) }}" class="btn btn-primary">Vote</a>
                                                <a href="{{ route('elections.show', ['election' => $election->id]) }}" class="btn btn-primary">View Results</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
