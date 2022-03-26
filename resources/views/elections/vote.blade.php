<x-app-layout>
    <h2>
        {{ __('Voting Screen') }}
    </h2>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg text-center">
                <form method="POST" action="{{ route('elections.votes.store', ['election' => $election->id]) }}">
                    @csrf
                    <div class="mb-3">
                        <label for="vote" class="form-label">Vote</label>
                        <select name="vote" id="vote" class="form-select" aria-label="Vote" required>
                            <option selected disabled value="">Choose...</option>
                            @foreach ($election->candidates()->get() as $candidate)
                                <option value="{{ $candidate->id }}">{{ $candidate->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please choose a candidate.
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mb-3">Vote</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>