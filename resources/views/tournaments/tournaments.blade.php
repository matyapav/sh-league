@extends('app')

@section('content')
    <div class="text-center">
        <div class="panel">
            <div class="panel-heading orange">{{trans('messages.tournaments')}}</div>
                <div class="body_content ">
                    @include('errors.error')
                    <a href="{{ URL::to('tournaments/createForm') }}"
                        class="@if(!Auth::user()->hasRole('admin')) not-visible @else a-over-btn @endif">
                    <button class="btn-common green" >
                        <i class="fa fa-plus"></i>
                        {{trans('messages.new')}}
                    </button>
                    </a>
                    <br>
                    @if (count($tournaments) > 0)
                    <table class="fine-table" id="tournament-table">
                        <!-- Table Headings -->
                        <thead>
                            <th>{{trans('messages.tournament')}}</th>
                            <th>{{trans('messages.min-teams')}}</th>
                            <th>{{trans('messages.max-teams')}}</th>
                            <th>{{trans('messages.teams-in')}}</th>
                            <th>{{trans('messages.league')}}</th>
                            <th colspan="3" id="actions">{{trans('messages.actions')}}</th>
                        </thead>
                        <!-- Table Body -->
                        <tbody>
                            @foreach ($tournaments as $tournament)
                                <tr>
                                <!-- Tournament Details -->
                                    <td>
                                        <div>{{ $tournament->name }}</div>
                                    </td>
                                    <td>
                                        <div>{{ $tournament->min_number_of_teams }}</div>
                                    </td>
                                    <td>
                                        <div>{{ $tournament->max_number_of_teams }}</div>
                                    </td>
                                    <td>
                                       <div>{{ $tournament->signedTeams()->get()->count() }}</div>
                                    </td>
                                    <td>
                                    <div>
                                        @if(!is_null($tournament->league))
                                            <a href="{{ URL::to('leagues/show/'.$tournament->league->id)}}">
                                                {{ $tournament->league->name}}
                                            </a>
                                        @else -
                                        @endif
                                    </div>
                                    </td>
                                    @include('tournaments.tournaments-table-actions')
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        {!! $tournaments->render()!!}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
