<x-app-layout>
    <br>
    <h2>
        Election Results: {{ $election->name }}
    </h2>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div>
                    Winner:
                    @if (count($winners) == 1)
                        {{ $winners[0] }}
                    @else
                        Tie between {{ $winners[0] }}
                        @for ($x = 1; $x < count($winners); $x++)
                        , {{ $winners[$x] }}
                        @endfor
                    @endif
                </div>
                <table class="table table-striped table-hover table-reflow">
                    <thead>
                        <tr>
                            <th><strong> Name: </strong></th>
                            <th><strong> Votes: </strong></th>
                        </tr>
                    </thead>

                    <tbody>
                        @for ($i = 0; $i < count($arrName); $i++)
                            <tr>
                                <td>{{ $arrName[$i] }}</td>
                                <td>{{ $arrVotes[$i] }}</td>
                            </tr>

                        @endfor
                    @endif
                </div>
                
                @if ($election->system->value == 'fptp')
                    <table class="table table-striped table-hover table-reflow">
                        <thead>
                            <tr>
                                <th><strong> Name: </strong></th>
                                <th><strong> Votes: </strong></th>
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
                @endif
                <div class="row no-gutters aw-main-wrapper">
                    <div class="col-lg-6">
                        @if ($election->system->value == 'irv')
                            <iframe height="600" width="600" src="{{ $response['embedUrl'] }}"></iframe>
                        @else
                            {!! $barChart -> container() !!}
                        @endif
                    </div>
                    <div class="col-lg-6">
                        @if ($election->system->value == 'irv')
                            <iframe height="600" width="600" src="{{ $response['embedSankeyUrl'] }}"></iframe>
                        @else
                            {!! $pie -> container() !!}
                        @endif
                    </div>
                </div>
                <div class="row no-gutters aw-main-wrapper">
                    <div class="col-lg-6">
                        {!! $lineChart -> container() !!}
                    </div>
                    <div class="col-lg-6">
                        {!! $lineChart2 -> container() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Below are the codes for creating the pie and bar charts --}}
    @if ($election->system->value == 'fptp')
        <script src="{{ $pie->cdn() }}"></script>
        {{ $pie->script() }}
        <script src="{{ $barChart->cdn() }}"></script>
        {{ $barChart->script() }}
        <script src="{{ $lineChart->cdn() }}"></script>
        {{ $lineChart->script() }}
        <script src="{{ $lineChart2->cdn() }}"></script>
        {{ $lineChart2->script() }}
    @endif
    
</x-app-layout>
