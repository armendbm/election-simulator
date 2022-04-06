<x-app-layout>
    <br>
    <h1>
        {{ __('Voting Screen:') }}
    </h1>
    <h2>
        {{$election->name}}
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
                            <input type="hidden" name="ranking" id="ranking">
                            <ul id="sortable" class="list-unstyled">
                                @foreach ($election->candidates()->get() as $candidate)
                                    <li id="ranking_{{ $candidate->id }}" class="ui-state-default user-select-none">{{ $candidate->name }}</li>
                                @endforeach
                            </ul>
                            @break
                        @default <!--First Past The Post-->
                            <div class="mb-3">
                                <label for="vote0" class="form-label">Vote</label>
                                <select name="vote0" id="vote0" class="form-select" aria-label="Vote" required>
                                    <option selected disabled value="">Choose...</option>
                                    @foreach ($election->candidates()->get() as $candidate)
                                        <option value="{{ $candidate->id }}">{{ $candidate->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Please choose a candidate.
                                </div>
                            </div>
                    @endswitch
                    <button type="submit" class="btn btn-primary mb-3">Vote</button>
                </form>
                <!-- May or may not even do anything found it online I'm learning -->
                <?php
                    if(isset($_POST['submit'])){
                    if(!empty($_POST['radio'])) {
                        echo '  ' . $_POST['radio'];
                    } else {
                        echo 'Please select the value.';
                    }
                    }
                ?>
            </div>
        </div>
    </div>

    <script>
        $(function() {
            $("#sortable").sortable({
                placeholder: "ui-state-highlight"
            });
            $("#sortable").disableSelection();
        });
        $("form").submit(function() {
            $("#ranking").val($("#sortable").sortable("serialize"));
        });
    </script>
</x-app-layout>
