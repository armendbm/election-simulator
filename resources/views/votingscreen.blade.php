<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Voting Screen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg text-center">
                <form>
                    <p style="padding: 1rem;">Select Candidate: (Template)</p>
                    <div style="padding: 1.5rem;">
                        <input type="radio" name="candidate" id="one" value="One" />
                        <label for="one">Candidate 1</label><br>
                    </div>
                    <div style="padding: 1.5rem;">
                        <input type="radio" name="candidate" id="two" value="Two" />
                        <label for="two">Candidate 2</label><br>
                    </div>
                    <div style="padding: 1.5rem;">
                        <input type="radio" name="candidate" id="three" value="Three" />
                        <label for="three">Candidate 3</label><br>
                    </div>
                    <button type="submit" class="bg-green-500 
                    shadow-5xl mb-10 p-2 w-80 uppercase font-bold">Submit</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
