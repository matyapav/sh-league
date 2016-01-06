<td id="action">
    <a href="{{ URL::to('users/show/'.$user->id) }}">
        <button class="btn-wrap-content blue" >
            <i class="fa fa-eye"></i>
        </button>
    </a>
</td>
<td  id="action">
    <form id="delete{{$user->id}}" action="/users/delete/{{ $user->id }}" method="POST"
          class="@if(!Auth::user()->hasRole('admin')) not-visible @endif">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type="submit" class="btn-wrap-content red" >
            <i class="fa fa-trash-o"></i>
        </button>
    </form>
    <script>
        confirmDelete({{$user->id}});
    </script>
</td>
@if(isset($team))
<td  id="action">
    <form id="kick-form" action="/users/kickUser/{{$user->id}}"
          class="@if(!Auth::user()->hasRole('admin') && !Auth::user()->isCaptain($team) || $user->isCaptain($team)) not-visible @endif">
        <input type="hidden" name="kicked_from_id" value="{{$team->id}}">
        <button type="submit" class="btn-wrap-content red" >
            <i class="fa fa-user-times"></i>
        </button>
    </form>
</td>

<td  id="action">
    <form id="kick-form" action="/users/forwardCaptainRole/{{$user->id}}"
          class="@if(!Auth::user()->hasRole('admin') && !Auth::user()->isCaptain($team) || $user->isCaptain($team)) not-visible @endif">
        <input type="hidden" name="fwd_cpt_team_id" value="{{$team->id}}">
        <button type="submit" class="btn-wrap-content blue" >
            <i class="fa fa-forward"></i><i class="fa fa-star"></i>
        </button>
    </form>
</td>
@endif