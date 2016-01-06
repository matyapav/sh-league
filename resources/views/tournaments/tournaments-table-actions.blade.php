
<td class="@if(!Auth::user()->hasRole('admin')) not-visible @endif">
    <a href="{{ URL::to('tournaments/edit/'.$tournament->id) }}">
        <button class="btn-wrap-content orange" >
            <i class="fa fa-pencil"></i>
        </button>
    </a>
</td>
<td>
    <a href="{{ URL::to('tournaments/show/'.$tournament->id) }}">
        <button class="btn-wrap-content blue" >
            <i class="fa fa-eye"></i>
        </button>
    </a>
</td>
<td class="@if(!Auth::user()->hasRole('admin')) not-visible @endif">
    <form id="delete{{$tournament->id}}" action="/tournaments/delete/{{ $tournament->id }}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type="submit" class="btn-wrap-content red" >
            <i class="fa fa-trash-o"></i>
        </button>
    </form>
    <script>
        confirmDelete({{$tournament->id}});
    </script>
</td>