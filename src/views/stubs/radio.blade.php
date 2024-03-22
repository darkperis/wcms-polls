<form method="POST" action="{{ route('poll.vote', $id) }}" >
    <esi:include src='/lscache-gen-csr' cache-control='no-cache'></esi:include>
    <esi:remove>@csrf</esi:remove>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">
                <span class="glyphicon glyphicon-arrow-right"></span> {{ $question }}
            </h3>
        </div>
    </div>
    <div class="panel-body">
        <ul class="list-group">
            @foreach($options as $id => $name)
                <li class="list-group-item">
                    <div class="radio">
                        <label>
                            <input value="{{ $id }}" type="radio" name="options">
                            {{ $name }}
                        </label>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="panel-footer mt-4">
        <input type="submit" class="ctab " value="Ψηφίστε" />
    </div>
</form>
