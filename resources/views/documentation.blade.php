
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Documentation') }}
        </h2>
    </x-slot>
    
    @php
    $username = 'Guest';
    $electionSet = [];
    if (auth()->user() != null)
    {
        $username = auth()->user()->name;
        //$VoteHandler->createElection(auth()->user()->id, $now, $now);
        if (auth()->user()->own_elections() != null)
        {
            $electionSet = auth()->user()->own_elections()->getResults();
        }
    }
    @endphp
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white border-b border-gray-200">
                    <p class="ml-3 my-3 h5"><strong>{{ $username }}'s Elections:</strong></p>
                </div>
                <div class="p-2 bg-white border-b border-gray-200">
                    @foreach($electionSet as $election)
                        <p>{{$election->name}} is owned by user {{$election->owner_id}} at {{$election->created_at}}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="py-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-2 bg-white border-b border-gray-200">
                    <p>Total users: {{$ResultHandler -> getUserTotal()}} </p>
                    <p>Total elections: {{$ResultHandler->getElectionTotal()}}
                    <p>Total votes: {{$ResultHandler->getVoteTotal()}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>