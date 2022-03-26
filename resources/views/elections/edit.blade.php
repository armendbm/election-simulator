<x-app-layout>
    <h2>
        {{ __('Edit Election and Add Candidates') }}
    </h2>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if (count($election->candidates()->get()) > 0)
                    <h3>Candidates</h3>
                    <ul class="list-group list-group-flush">
                        @foreach ($election->candidates()->get() as $candidate)
                            <li class="list-group-item">
                                {{ $candidate->name }}
                                <form method="POST" action="{{ route('elections.candidates.destroy', ['election' => $election->id, 'candidate' => $candidate->id]) }}">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                @endif
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">New Candidate</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Enter the information below.</h6>
                        <form method="POST" action="{{ route('elections.candidates.store', ['election' => $election->id]) }}" class="needs-validation" novalidate>
                            @csrf
                            <div class="mb-3">
                                <label for="name2" class="form-label">Name</label>
                                <input type="text" name="name" id="name2" class="form-control" placeholder="John Sturman" required>
                                <div class="invalid-feedback">
                                    Please enter a name.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="description2" class="form-label">Description</label>
                                <textarea name="description" id="description2" class="form-control" placeholder="Description goes here" rows="3" value="{{ $election->description }}"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mb-3">Add candidate</button>
                        </form>
                    </div>
                </div>
                <form method="POST" action="{{ route('elections.update', ['election' => $election->id]) }}" class="needs-validation" novalidate>
                    @method('put')
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="My Amazing Election" value="{{ $election->name }}" required>
                        <div class="invalid-feedback">
                            Please enter a name.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control" placeholder="Description goes here" rows="3" value="{{ $election->description }}"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="system" class="form-label">System</label>
                        <select name="system" id="system" class="form-select" aria-label="System" required>
                            <option selected value="fptp">FPTP</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a system.
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="public" id="public" value="1"
                                @if ($election->public)
                                    checked
                                @endif
                            >
                            <label for="public" class="form-check-label">Public?</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="anonymous" id="anonymous" value="1"
                                @if ($election->anonymous)
                                    checked
                                @endif
                            >
                            <label for="anonymous" class="form-check-label">Anonymous?</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="start_at" class="form-label">Start Date</label>
                        <input type="datetime-local" name="start_at" id="start_at" class="form-control" value="{{ $election->start_at->format('Y-m-d\TH:i:s') }}" required>
                        <div class="invalid-feedback">
                            Please choose a date.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="end_at" class="form-label">End Date</label>
                        <input type="datetime-local" name="end_at" id="end_at" class="form-control" value="{{ $election->end_at->format('Y-m-d\TH:i:s') }}" required>
                        <div class="invalid-feedback">
                            Please choose a date.
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mb-3">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
