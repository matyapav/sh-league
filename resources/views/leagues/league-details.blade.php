@extends('app')

@section('content')
    <div class="text-center">
        <div class="panel">
            <div class="panel-heading orange">{{trans('messages.detail-of-league')}} - {{$league->name}}</div>
            <div class="body_content ">
                <div class="info-box">
                    <h3>Info</h3>
                        <table class="info-table">
                        <tr>
                            <td>
                                <strong>{{trans('messages.id')}} :</strong>
                            </td>
                            <td>
                                {{ $league->id }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>{{trans('messages.name')}} :</strong>
                            </td>
                            <td>
                                {{ $league->name }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>{{trans('messages.abbreviation')}} :</strong>
                            </td>
                            <td>
                                {{ $league->abbreviation }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>{{trans('messages.description')}} :</strong>
                            </td>
                            <td>
                                {{ $league->description }}
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <strong>{{trans('messages.game')}} :</strong>
                            </td>
                            <td>
                                @if(!is_null($league->game))
                                {{ $league->game->name }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>{{trans('messages.creator')}} :</strong>
                            </td>
                            <td>
                               @if(!is_null($league->creator)){{$league->creator->nickname}}@endif
                            </td>
                        </tr>
                    </table>
                </div>
                <div>

                <h3>{{trans('messages.tournaments-in-league')}}</h3>
                @if (count($league->tournaments()->get()) > 0)
                        <!-- Table Headings -->
                        <table class="fine-table">
                            <thead>
                            <th>{{trans('messages.tournament')}}</th>
                            <th>{{trans('messages.min-teams')}}</th>
                            <th>{{trans('messages.max-teams')}}</th>
                            <th>{{trans('messages.teams-in')}}</th>
                            <th colspan="3">{{trans('messages.actions')}}</th>
                            </thead>
                            <!-- Table Body -->
                            <tbody>
                            @foreach ($league->tournaments()->get() as $tournament)
                                <tr>
                                    <!-- Informations -->
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
                                        <div>
                                            {{ $tournament->signedTeams()->get()->count() }}
                                        </div>
                                    </td>
                                   <!-- Actions -->
                                   @include('tournaments.tournaments-table-actions')
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                @else
                    {{trans('messages.no-tournaments')}}
                @endif
                </div>
            </div>
        </div>
    </div>
@endsection
