<x-app-layout>
    <br>
    <h2>
        {{ __('Voting Screen') }}
    </h2>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg text-center">
                <form method="POST" action="{{ route('elections.votes.store', ['election' => $election->id]) }}">
                    <p style="padding: 1rem;">Select Candidate:</p>
                    @csrf
                    <!--Voting interface changes based on $election->system->value-->
                    @switch($election->system->value) 
                        @case("irv") <!--Instant Runoff-->
                            @foreach ($election->candidates()->get() as $candidate)
                            <div class="mb-3">
                                <!-- <label for="vote" class="form-label">Rank Your Candidates</label> -->
                                @foreach ($election->candidates()->get() as $candidate)
                                    <div style="padding: 1.5rem;">
                                        <input type="radio" name="candidate" id="{{ $candidate->id }}" value="{{ $candidate->id }}" />
                                        <label for="{{ $candidate->id }}">{{ $candidate->name }}</label><br>
                                    </div>
                                @endforeach
                                <div class="invalid-feedback">
                                    Please choose a candidate.
                                </div>
                            </div>
                            @endforeach
                            @break
                        @default <!--First Past The Post-->
                            <div class="mb-3">
                                <!-- <label for="vote" class="form-label">Rank Your Candidates</label> -->
                                @foreach ($election->candidates()->get() as $candidate)
                                    <div style="padding: 1.5rem;">
                                        <input type="radio" name="candidate" id="{{ $candidate->id }}" value="{{ $candidate->id }}" />
                                        <label for="{{ $candidate->id }}">{{ $candidate->name }}</label><br>
                                    </div>
                                @endforeach
                                <div class="invalid-feedback">
                                    Please choose a candidate.
                                </div>
                            </div>
                    @endswitch
                    <button type="submit" class="btn btn-primary mb-3">Vote</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
