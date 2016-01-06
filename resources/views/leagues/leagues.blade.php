@extends('app')

@section('content')
    <div class="text-center">
        <div class="panel">
            <div class="panel-heading orange">{{trans('messages.leagues')}}</div>
            <div class="body_content ">
                @include('errors.error')
                <a href="{{ URL::to('leagues/createForm') }}"
                   class="@if(!Auth::user()->hasRole('admin')) not-visible @else a-over-btn @endif">
                    <button class="btn-common green" >
                        <i class="fa fa-plus"></i>
                        {{trans('messages.new')}}
                    </button>
                </a>
                @if (count($leagues) > 0)
                    <!-- Table Headings -->
                    <table class="fine-table">
                        <thead>
                            <th>{{trans('messages.league')}}</th>
                            <th>{{trans('messages.abbreviation')}}</th>
                            <th>{{trans('messages.tournament-number')}}</th>
                            <th>{{trans('messages.game')}}</th>
                            <th colspan="3">{{trans('messages.actions')}}</th>
                        </thead>
                        <br>
                        <br>
                        <!-- Table Body -->
                        <tbody>
                        @foreach ($leagues as $league)
                        <tr>
                            <!-- Informations -->
                            <td>
                                <div>{{ $league->name }}</div>
                            </td>
                            <td>
                                <div>{{ $league->abbreviation }}</div>
                            </td>
                            <td>
                                <div>{{ $league->tournaments()->get()->count() }}</div>
                            </td>
                            <td>
                                <div>@if(!is_null($league->game)){{$league->game->name}}@else - @endif</div>
                            </td>
                            <!-- Actions -->
                            @include('leagues.leagues-table-actions')
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                    <div>
                        {!! $leagues->render() !!}
                    </div>
                @endif

              </div>
            </div>
    </div>
@endsection
