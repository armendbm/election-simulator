<x-app-layout>
    <h2>
        {{ __('Create an Election') }}
    </h2>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('elections.store') }}" class="needs-validation" novalidate>
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="My Amazing Election" required>
                        <div class="invalid-feedback">
                            Please enter a name.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control" placeholder="Description goes here" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="system" class="form-label">System</label>
                        <select name="system" id="system" class="form-select" aria-label="System" required>
                            <option selected disabled value="">Choose...</option>
                            <option value="fptp">FPTP</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a system.
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="public" id="public" value="1" checked>
                            <label for="public" class="form-check-label">Public?</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="anonymous" id="public" value="1" checked>
                            <label for="public" class="form-check-label">Anonymous?</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="start_at" class="form-label">Start Date</label>
                        <input type="date" name="start_at" id="start_at" class="form-control" required>
                        <div class="invalid-feedback">
                            Please choose a date.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="end_at" class="form-label">End Date</label>
                        <input type="date" name="end_at" id="end_at" class="form-control" required>
                        <div class="invalid-feedback">
                            Please choose a date.
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mb-3">Create election</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
