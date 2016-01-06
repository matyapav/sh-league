
<td id="action">
    <a href="{{ URL::to('tournaments/edit/'.$tournament->id) }}"
       class="@if(!Auth::user()->hasRole('admin')) not-visible @endif" >
        <button class="btn-wrap-content orange" >
            <i class="fa fa-pencil"></i>
        </button>
    </a>
</td>
<td id="action">
    <a href="{{ URL::to('tournaments/show/'.$tournament->id) }}">
        <button class="btn-wrap-content blue" >
            <i class="fa fa-eye"></i>
        </button>
    </a>
</td>
<td id="action">
    <form id="delete{{$tournament->id}}" action="/tournaments/delete/{{ $tournament->id }}" method="POST"
          class="@if(!Auth::user()->hasRole('admin')) not-visible @endif" >
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type="submit" class="btn-wrap-content red" >
            <i class="fa fa-trash-o"></i>
        </button>
    </form>
    <script>
        confirmDelete({{$tournament->id}});
    </script>
</td>