<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{ auth()->user()->name }}'s Information
                </div>
                <div class="p-6 bg-white ">
                    Id: {{ auth()->user()->id }}
                </div>
                <div class="p-6 bg-white ">
                    Username: {{ auth()->user()->name }}
                </div>
                <div class="p-6 bg-white ">
                    Email: {{ auth()->user()->email }}
                </div>
                <div class="p-6 bg-white ">    
                    Password: {{ auth()->user()->password }}
                </div>
                <div class="p-6 bg-white ">    
                    Account created: {{ auth()->user()->created_at }}
                </div>
                <div class="p-6 bg-white bg-white border-b border-gray-200">    
                    Last Updated: {{ auth()->user()->updated_at }}
                </div>

                <div class="float-right mt-4 ">
                    <x-button class="ml-4 mb-4 bg-primary">
                        <a href="update/{{ auth()->user()->id }}">
                            {{ __('Update Info') }}
                        </a>
                    </x-button>

                    <x-button class="ml-4 mb-4 bg-primary">
                        <a href="updatepassword/{{ auth()->user()->id }}">
                            {{ __('Update Password') }}
                        </a>
                    </x-button>
    
                    <x-button id="click" class="ml-4 mb-4 bg-danger">
                        <a href="delete/{{ auth()->user()->id }}">
                            Delete    
                        </a>
                    </x-button>
                </div>    
            </div>
        </div>
    </div>
</x-app-layout>
