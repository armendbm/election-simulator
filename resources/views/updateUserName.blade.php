<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white border-b border-gray-200">
                    <p class="ml-3 my-3 h5"><strong>Update {{ auth()->user()->name }}'s Username</strong></p>
                </div>

                <form class="m-4" action="/editUserName" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $data['id'] }}">

                    <div class="input-group input-group-sm my-4">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroup-sizing-sm">Username</span>
                        </div>
                        <input type="text" name="name" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="{{ $data['name'] }}">
                    </div>

                    <div class="float-right border-t border-gray-200">
                        <button class="btn btn-primary mt-3" type="submit">
                                {{ __('Update') }}              
                        </button>
                        
                        <a href="/dashboard" class="btn btn-danger mt-3">
                            {{ __('Cancel') }}    
                        </a>

                        @error('name') <span class="ml-4 text-danger error">{{ $message }}</span>@enderror

                    </div>  
                
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
