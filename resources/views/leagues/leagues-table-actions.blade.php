<td class="@if(!Auth::user()->hasRole('admin')) not-visible @endif" id="action">
    <a href="{{ URL::to('leagues/edit/'.$league->id) }}">
        <button class="btn-wrap-content orange" >
            <i class="fa fa-pencil"></i>
        </button>
    </a>
</td>
<td id="action">
    <a href="{{ URL::to('leagues/show/'.$league->id) }}">
        <button class="btn-wrap-content blue" >
            <i class="fa fa-eye"></i>
        </button>
    </a>
</td>
<td class="@if(!Auth::user()->hasRole('admin')) not-visible @endif" id="action">
    <form id="delete{{$league->id}}" action="/leagues/delete/{{$league->id}}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <button type="submit" class="btn-wrap-content red" >
            <i class="fa fa-trash-o"></i>
        </button>
    </form>
    <script>
        confirmDelete({{$league->id}});
    </script>
</td>