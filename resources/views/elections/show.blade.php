<x-app-layout>
    <h2>
        Election Results: {{ $election->name }}
    </h2>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white border-b border-gray-200">
                    <p class="ml-3 my-3 h5"><strong>Results</strong></p>
                </div>
                
                <table class="table table-striped table-hover table-reflow">
                    <thead>
                        <tr>
                            <th ><strong> Name: </strong></th>
                            <th ><strong> Votes: </strong></th>
                        </tr>
                    </thead>

                    <tbody>
                        @for ($i = 0; $i < count($arrName); $i++)
                            <tr>
                                <td>{{ $arrName[$i] }}</td>
                                <td>{{ $arrVotes[$i] }}</td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
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

    {{-- Below are the codes for creating the pie and bar charts --}}
    <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}
    <script src="{{ $chart2->cdn() }}"></script>
    {{ $chart2->script() }}
    
</x-app-layout>
