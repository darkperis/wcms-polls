@if(Session::has('errors'))
    <div class="alert alert-danger">
            {{ session('errors') }}
    </div>
@endif
@if(Session::has('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<p class="poll-results bottom-content-title size-5 mb-3">Αποτέλεσμα Δημοσκόπησης: </p>

<div class="poll-results-wrap">
<h4>{{ $question }}</h4>

@foreach($options as $option)
    <div class='result-option-id'>
        <strong>{{ $option->name }}</strong><span class='prog-percent'>{{ number_format($option->percent, 0, '.', '') }}%</span>
        <div class='progress'>
            <div class='progress-bar progress-bar-striped active' role='progressbar' aria-valuenow='{{ $option->percent }}' aria-valuemin='0' aria-valuemax='100' style='height: 28px; width: {{ $option->percent }}%'>
                {{-- <span class='sr-only'>{{ $option->percent }}% ψήφισαν</span> --}}
            </div>
        </div>
    </div>
@endforeach
 <p class="poll-voters">{{count($votes)}}</p>
</div>