<x-app-layout>
    <br>
    <h2>
        Election Manager
    </h2>
    <br>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container">
                    <a href="{{ route('elections.create') }}" class="btn ml-4 mb-4 btn-primary" type="submit">Create Election</a>
                    @if (count(Auth::user()->own_elections()->get()) > 0)
                        <!-- <h3>My Elections</h3> -->
                        <ul class="list-group list-group-flush">
                            @foreach (Auth::user()->own_elections()->get() as $election)
                                <li class="list-group-item">
                                    <table style="border: 1px solid grey; margin: 1rem 1rem 1rem 0;" class="election-table" width="100%">
                                        <thead>
                                            <tr style="border-bottom: 1px dashed grey;">
                                                <td style="padding-left: 0.5rem;" colspan="5">
                                                    <strong>{{ $election->name }}</strong>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr style="border-bottom: 1px dashed grey;">
                                                <td style="padding-left: 0.5rem;" colspan="5">
                                                    <strong>Description</strong>: {{ $election->description ?? "No description"}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:center" width="1rem"><strong>Type</strong></td>
                                                <td style="text-align:center" width="1rem"><strong>Visibility</strong></td>
                                                <td style="text-align:center" width="1rem"><strong>Anonymity</strong></td>
                                                <td style="text-align:center" width="1rem"><strong>Started at</strong></td>
                                                <td style="text-align:center" width="1rem"><strong>Ended at</strong></td>
                                            </tr>
                                            <tr style="border-bottom: 1px dashed grey;">
                                                <td style="text-align:center" width="1rem">{{ strtoupper($election->system->value) }}</td>
                                                <td style="text-align:center" width="1rem">{{ $election->public ? "Public" : "Private"}}</td>
                                                <td style="text-align:center" width="1rem">{{ $election->anonymous ? "Anonymous" : "Not anonymous" }}</td>
                                                <td style="text-align:center" width="1rem">{{ $election->start_at }}</td>
                                                <td style="text-align:center" width="1rem">{{ $election->end_at }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding-left: 0.5rem;" colspan="5">
                                                    <strong>Candidates</strong>:
                                                    {{ count($election->candidates()->get()) ? "" : "None" }}
                                                    @foreach ($election->candidates()->get() as $candidate)
                                                        {{ $candidate->name }} ({{ count($election->votes()->where('data', $candidate->id)->get()) }})
                                                    @endforeach
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <a href="{{ route('elections.edit', ['election' => $election->id]) }}" class="btn btn-primary">Edit</a>
                                    <a href="{{ route('elections.show', ['election' => $election->id]) }}" class="btn btn-primary">View Results</a>
                                    <br><br>
                                    <form method="POST" action="{{ route('elections.destroy', ['election' => $election->id]) }}">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>