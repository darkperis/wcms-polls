@if($ajax)
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">
                {{ $question }}
            </h3>
        </div>
        <div class="panel-body">
            <ul class="list-group">
                @foreach($options as $id => $name)
                    <li class="list-group-item">
                        <div class="radio">
                            <label>
                                <input value="{{ $id }}" type="checkbox" name="options[]">
                                {{ $name }}
                            </label>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@else
<form method="POST" action="{{ route('poll.vote', $id) }}" >
    @csrf
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">
                {{ $question }}
            </h3>
        </div>
        <div class="panel-body">
            <ul class="list-group">
                @foreach($options as $id => $name)
                    <li class="list-group-item">
                        <div class="radio">
                            <label>
                                <input value="{{ $id }}" type="checkbox" name="options[]">
                                {{ $name }}
                            </label>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="panel-footer mt-4">
            <input type="submit" class="ctab mt-2" value="Ψηφίστε" />
        </div>
    </div>
</form>
@endif