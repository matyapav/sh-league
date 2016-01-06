<td id="action">
    <a href="{{ URL::to('teams/edit/'.$team->id) }}"
       class="@if(!Auth::user()->hasRole('admin') && !Auth::user()->isCaptain($team))) not-visible @endif" >
        <button class="btn-wrap-content orange" >
            <i class="fa fa-pencil"></i>
        </button>
    </a>
</td>
<td id="action">
    <a href="{{ URL::to('teams/show/'.$team->id) }}">
        <button class="btn-wrap-content blue" >
            <i class="fa fa-eye"></i>
        </button>
    </a>
</td>
<td  id="action">
    <form id="delete{{$team->id}}" action="/teams/delete/{{ $team->id }}" method="POST"
          class="@if(!Auth::user()->hasRole('admin') && !Auth::user()->isCaptain($team))not-visible @endif">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type="submit" class="btn-wrap-content red" >
            <i class="fa fa-trash-o"></i>
        </button>
    </form>
    <script>
        confirmDelete({{$team->id}});
    </script>
</td>

<td >
    <a href="{{ URL::to('users/leaveTeam/'.$team->id) }}"
       class="@if(!$team->members()->get()->contains(Auth::user()))not-visible @endif">
        <button class="btn-wrap-content orange" >
            <i class="fa fa-sign-out"></i>
        </button>
    </a>
</td>