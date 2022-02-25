<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight py-1">
            {{ __('Home Page (This part is the header from app.blade.php)') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Update {{ auth()->user()->name }}'s Password
                </div>

                <form class="m-4" action="/edit" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $data['id'] }}">
                    
                    <div class="input-group input-group-sm my-4">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroup-sizing-sm">Password</span>
                        </div>
                        <input type="text" name="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="{{ $data['password'] }}">
                    </div>

                    <div class="float-right border-t border-gray-200">
                        <x-button class="bg-primary mt-3" type="submit">
                                {{ __('Update') }}              
                        </x-button>
                        
                        <x-button class="ml-4 bg-danger">
                            <a href="/dashboard">
                                {{ __('Cancel') }}    
                            </a>
                        </x-button>
                    </div>  
                
                </form>

            </div>
        </div>
    </div>
    



    
</x-app-layout>
