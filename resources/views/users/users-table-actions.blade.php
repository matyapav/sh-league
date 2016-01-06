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