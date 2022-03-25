<x-app-layout>
    <h2>
        {{ __('Create your own election') }}
    </h2>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white border-b border-gray-200">
                    <p class="ml-3 my-3 h5"><strong>Manage the election</strong></p>
                </div>
                
                <table class="table table-striped table-hover table-reflow">
                    <thead>
                        <tr>
                            <th ><strong> ID: </strong></th>
                            <th ><strong> Votes: </strong></th>
                            <th ><strong> Actions: </strong></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($votes as $vote)
                            <tr>
                                <td>{{ $vote['id']}}</td>
                                <td>{{ $vote['data']}}</td>
                                <td>
                                    <button type="button" class="btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editmodal">
                                        Edit
                                    </button>
                                    @if (count($votes) > 1)
                                    <button onclick="deleteClick()" class="btn-sm ml-4 btn-danger">
                                        Delete
                                    </button>
                                     @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="float-left mt-4 ">
                    <button type="button" class="btn-sm mx-2 mb-2 btn-primary" data-bs-toggle="modal" data-bs-target="#createmodal">
                        Create new data
                    </button>
                </div> 
            </div> 
        </div>
    </div>

    {{-- Where the charts are created --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="row no-gutters aw-main-wrapper">
                <p class="ml-3 my-3 h5"><strong>Results</strong></p>
                <div class="col-lg-6">
                    {!! $chart2 -> container() !!}
                </div>
                <div class="col-lg-6">
                    {!! $chart -> container() !!}
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit data</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form class="m-4" action="/editData" method="POST">
                    @csrf
                    <div class="input-group input-group-sm my-4">
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">ID</span>
                        </div>
                        <input type="text" name="id" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="{{ $vote['id'] }}">
                    </div>
                    <div class="input-group input-group-sm my-4">
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Votes</span>
                        </div>
                        <input type="text" name="data" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="{{ $vote['data'] }}">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                    </div>

                    @error('id') <span class="ml-4 text-danger error">{{ $message }}</span>@enderror
                    @error('data') <span class="ml-4 text-danger error">{{ $message }}</span>@enderror
                </form>
                
            </div>
        </div>
    </div>
    <!-- Edit Modal Ends-->

    <!-- Create Modal -->
    <div class="modal fade" id="createmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit data</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form class="m-4" action="/createData" method="POST">
                    @csrf
                    <div class="input-group input-group-sm my-4">
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">ID</span>
                        </div>
                        <input type="text" name="id" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="">
                    </div>
                    <div class="input-group input-group-sm my-4">
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Votes</span>
                        </div>
                        <input type="text" name="data" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
                    </div>

                    @error('id') <span class="ml-4 text-danger error">{{ $message }}</span>@enderror
                    @error('data') <span class="ml-4 text-danger error">{{ $message }}</span>@enderror
                </form>
                
            </div>
        </div>
    </div>
    <!-- Create Modal Ends-->
    
    {{-- below provides the func. to delete the row when the delete btn is clicked --}}
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
                    location.href = "deleteVote/{{ $vote['id']}}";
                }
            })
        }
    </script>

    {{-- Below are the codes for creatign the pie and bar charts --}}
    <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}
    <script src="{{ $chart2->cdn() }}"></script>
    {{ $chart2->script() }}
    
</x-app-layout>