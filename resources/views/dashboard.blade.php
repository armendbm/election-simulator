<x-app-layout>
    <br>
    <h2>
        {{ __('Dashboard') }}
    </h2>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white border-b border-gray-200">
                    <p class="ml-3 my-3 h5"><strong>{{ auth()->user()->name }}'s Information</strong></p>
                </div>
                <div class="p-6 bg-white ">
                    User ID: {{ auth()->user()->id }}  
                </div>
                <div class="p-6 bg-white ">
                    Username: {{ auth()->user()->name }}  <a class="ml-2 link-primary" href="updateUserName/{{ auth()->user()->id }}"><i class="bi bi-vector-pen"></i>edit</a>
                </div>
                <div class="p-6 bg-white ">
                    Email: {{ auth()->user()->email }}  <a class="ml-2 link-primary" href="/updateEmail/{{ auth()->user()->id }}"><i class="bi bi-vector-pen"></i>edit</a>
                </div>
                <div class="p-6 bg-white ">    
                    Password: ********  <a class="ml-2 link-primary" href="updatePassword/{{ auth()->user()->id }}"><i class="bi bi-vector-pen"></i>edit</a>
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
