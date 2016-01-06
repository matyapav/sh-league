@extends('app')

@section('content')
    <div class="text-center">
        <div class="panel">
            <div class="panel-heading orange">{{trans("messages.detail-of-tournament")}} {{$tournament->name}}</div>
            <div class="body_content ">

                <div class="info-box">
                    <h3>Info</h3>
                        <table class="info-table">
                        <tr>
                            <td>
                                <strong>{{trans('messages.id')}} :</strong>
                            </td>
                            <td>
                                {{ $tournament->id }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>{{trans('messages.name')}} :</strong>
                            </td>
                            <td>
                                {{ $tournament->name }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>{{trans('messages.min-teams')}} :</strong>
                            </td>
                            <td>
                                {{ $tournament->min_number_of_teams }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>{{trans('messages.max-teams')}} :</strong>
                            </td>
                            <td>
                                {{ $tournament->max_number_of_teams }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>{{trans('messages.type')}} :</strong>
                            </td>
                            <td>
                                {{ $tournament->type }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>{{trans('messages.start-date')}} :</strong>
                            </td>
                            <td>
                                {{ $tournament->start_date }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>{{trans('messages.end-date')}} :</strong>
                            </td>
                            <td>
                                {{ $tournament->end_date }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>{{trans('messages.league')}} :</strong>
                            </td>
                            <td>
                                @if(!is_null($tournament->league))
                                {{ $tournament->league->name }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="info-right">

                <!-- Information based on number of teams -->
                <h3>{{trans('messages.teams-in')}} {{count($tournament->signedTeams()->get())}}/{{$tournament->max_number_of_teams}}</h3>
                @if(count($tournament->signedTeams()->get()) < $tournament->min_number_of_teams)
                   {{trans('messages.less-than-min-teams-1')}}
                   {{$tournament->min_number_of_teams-count($tournament->signedTeams()->get())}}
                   {{trans('messages.less-than-min-teams-2')}}
                   <br>
                @endif
                @if(count($tournament->signedTeams()->get()) >= $tournament->max_number_of_teams)
                   {{trans('messages.more-than-max-teams')}}
                   <br>
                @endif

                <!-- TABLE OF TEAMS IN TOURNAMENT -->
                @if (count($tournament->signedTeams()->get()) > 0)
                <!-- Table Headings -->
                <table class="fine-table">
                    <thead>
                    <th>{{trans('messages.team')}}</th>
                    <th>{{trans('messages.abbreviation')}}</th>
                    <th>{{trans('messages.members-count')}}</th>
                    <th colspan="3">{{trans('messages.actions')}}</th>
                    </thead>
                    <!-- Table Body -->
                    <tbody>
                    @foreach ($tournament->signedTeams()->get() as $team)
                        <tr>
                            <td>
                                <div>{{ $team->name }}</div>
                            </td>
                            <td>
                                <div>{{ $team->abbreviation }}</div>
                            </td>
                            <td>
                                <div>{{ $team->members()->get()->count() }}</div>
                            </td>
                        </tr>
                        @include('teams.teams-table-actions')
                    @endforeach
                    </tbody>
                </table>
                @else
                    {{trans('messages.no-teams')}}
                @endif

                </div>
            </div>
        </div>
    </div>
@endsection
