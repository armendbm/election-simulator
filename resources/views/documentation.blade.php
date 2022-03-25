<x-app-layout>
    <br>
    <h2>
        {{ __('Documentation') }}
    </h2>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    <p>Total users Result Handler: {{$resultHandler -> getVoteTotal()}} </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
