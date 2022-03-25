<x-app-layout>
    <h2>
        {{ __('Dashboard') }}
    </h2>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container">
                    <div class="bg-white border-b border-gray-200">
                        <p class="ml-3 my-3 h5"><strong>{{ auth()->user()->name }}'s Information</strong></p>
                    </div>
                    <div class="p-6 bg-white ">
                        Id: {{ auth()->user()->id }}  
                    </div>
                    <div class="p-6 bg-white ">
                        Username: {{ auth()->user()->name }}  <a class="ml-2 link-primary" href="updateUserName/{{ auth()->user()->id }}"><i class="bi bi-vector-pen"></i>edit</a>
                    </div>
                    <div class="p-6 bg-white ">
                        Email: {{ auth()->user()->email }}  <a class="ml-2 link-primary" href="/updateEmail/{{ auth()->user()->id }}"><i class="bi bi-vector-pen"></i>edit</a>
                    </div>
                    <div class="p-6 bg-white ">    
                        Password: ********  <a class="ml-2 link-primary" href="updatePassword/{{ auth()->user()->id }}"><i class="bi bi-vector-pen"></i>edit</a>
                    </div>
                    <div class="p-6 bg-white ">    
                        Account created: {{ auth()->user()->created_at }}
                    </div>
                    <div class="p-6 bg-white bg-white border-b border-gray-200">    
                        Last Updated: {{ auth()->user()->updated_at }}
                    </div>

                    <div class="float-right mt-4 ">
                        <button onclick="deleteClick()" class="btn ml-4 mb-4 btn-danger">
                            Delete Account
                        </button>
                    </div>    
                    <a href="{{ route('elections.create') }}" class="btn ml-4 mb-4 btn-primary" type="submit">Create Election</a>
                    @if (count(Auth::user()->own_elections()->get()) > 0)
                        <h3>My Elections</h3>
                        <ul class="list-group list-group-flush">
                            @foreach (Auth::user()->own_elections()->get() as $election)
                                <li class="list-group-item">
                                    {{ $election->name }} {{ $election->description }} {{ $election->system->value }} {{ $election->public }} {{ $election->anonymous }} {{ $election->start_at }} {{ $election->end_at }}
                                    @foreach ($election->candidates()->get() as $candidate)
                                        {{ $candidate->name }} ({{ count($election->votes()->where('data', $candidate->id)->get()) }})
                                    @endforeach
                                    <a href="{{ route('elections.edit', ['election' => $election->id]) }}" class="btn btn-primary">Edit</a>
                                    <form method="POST" action="{{ route('elections.destroy', ['election' => $election->id]) }}">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                    @if (count($elections->where('public', 1)) > 0)
                        <h3>Public Elections</h3>
                        <ul class="list-group list-group-flush">
                            @foreach ($elections->where('public', 1) as $election)
                                <li class="list-group-item">
                                    {{ $election->name }} {{ $election->description }}
                                    <a href="{{ route('elections.votes.create', ['election' => $election->id]) }}" class="btn btn-primary">Vote</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function deleteClick(){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    )
                    location.href = "delete/{{ auth()->user()->id }}";
                }
            })
        }
    </script>
</x-app-layout>
