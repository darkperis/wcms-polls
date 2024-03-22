@if($ajax)
    @php $poll_id = $id; @endphp
    <div class="panel" id="res-repl">
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
                                <input value="{{ $id }}" type="radio" name="options">
                                {{ $name }}
                            </label>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    
    <script type="text/javascript">
        $('input[name=options]').on('change', function () {
            console.log('vote');
            var id = $(this).val();
            $.ajax({
                url: '{{ route('poll.vote', $poll_id) }}',
                type: "post",
                data: { options:id, _token:'{{ csrf_token() }}' },
                success: function(data) {
                    //postDiv.append(data);
                    //alert(id);
                    $('#res-repl').html(data);
                }
            });
        });
    </script>
@else
<form method="POST" action="{{ route('poll.vote', $id) }}" >
    @csrf
    <div class="panel">
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
    </div>
</form>
@endif