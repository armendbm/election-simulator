<x-app-layout>
    <br>
    <h2>
        <!-- {{ __('Dashboard') }} -->
        Account Settings
    </h2>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container">
                    <div class="bg-white border-b border-gray-200">
                        <p class="ml-3 my-3 h5"><strong>{{ auth()->user()->name }}'s Information</strong></p>
                    </div>
                    <div class="p-6 bg-white ">
                        User ID: {{ auth()->user()->id }}
                    </div>
                    <div class="p-6 bg-white ">
                        Username: {{ auth()->user()->name }}  <a class="ml-2 link-primary" data-bs-toggle="modal" data-bs-target="#editUsernameModal" href=""><i class="bi bi-vector-pen"></i>edit</a>
                    </div>
                    <div class="p-6 bg-white ">
                        Email: {{ auth()->user()->email }}  <a class="ml-2 link-primary" data-bs-toggle="modal" data-bs-target="#editEmail" href=""><i class="bi bi-vector-pen"></i>edit</a>
                    </div>
                    <div class="p-6 bg-white ">    
                        Password: ********  <a class="ml-2 link-primary" data-bs-toggle="modal" data-bs-target="#editPasswordModal" href=""><i class="bi bi-vector-pen"></i>edit</a>
                    </div>
                    <div class="p-6 bg-white ">
                        Account created: {{ auth()->user()->created_at }}
                    </div>
                    <div class="p-6 bg-white bg-white border-b border-gray-200">
                        Last Updated: {{ auth()->user()->updated_at }}
                    </div>

                    <div class="float-right mt-4 ">
                        <button onclick="deleteClick()" class="btn ml-4 mb-4 btn-danger">
                            Delete Account
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Username Modal -->
    <div class="modal fade" id="editUsernameModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Username</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form class="m-4" action="/editUserName" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ auth()->user()->id }}">

                    <div class="input-group input-group-sm my-4">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroup-sizing-sm">Username</span>
                        </div>
                        <input type="text" name="name" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="{{ auth()->user()->name }}">
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
    <!-- Username Modal Ends-->  
    
    <!-- Email Modal -->
    <div class="modal fade" id="editEmail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Email</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form class="m-4" action="/editEmail" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ auth()->user()->id }}">

                    <div class="input-group input-group-sm my-4">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroup-sizing-sm">Email</span>
                        </div>
                        <input type="text" name="email" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="{{ auth()->user()->email }}">
                    </div>

                    <div class="float-right border-t border-gray-200">
                        <button class="btn btn-primary mt-3" type="submit">
                                {{ __('Update') }}              
                        </button>
                        
                        <a href="/dashboard" class="btn btn-danger mt-3">
                            {{ __('Cancel') }}    
                        </a>

                        @error('email') <span class="ml-4 text-danger error">{{ $message }}</span>@enderror

                    </div>  
                </form>

            </div>
        </div>
    </div>
    <!-- Email Modal Ends-->

    <!-- Password Modal -->
    <div class="modal fade" id="editPasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Password</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form class="m-4" action="/editPassword" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                    
                    <div class="input-group input-group-sm my-4">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroup-sizing-sm">Password</span>
                        </div>
                        <input type="password" name="password1" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="">
                    </div>

                    <div class="input-group input-group-sm my-4">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroup-sizing-sm">Confirm</span>
                        </div>
                        <input type="password" name="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="">
                    </div>

                    <div class="float-right border-t border-gray-200">
                        <button class="btn btn-primary mt-3" type="submit">
                                {{ __('Update') }}              
                        </button>
                        
                        <a href="/dashboard" class="btn btn-danger mt-3">
                            {{ __('Cancel') }}    
                        </a>

                        @error('password') <span class="ml-4 text-danger error">{{ $message }}</span>@enderror
                    </div>                  
                </form>

            </div>
        </div>
    </div>
    <!-- Password Modal Ends-->
    
    <script>
        function deleteClick(){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    )
                    location.href = "delete/{{ auth()->user()->id }}";
                }
            })
        }
    </script>
</x-app-layout>
