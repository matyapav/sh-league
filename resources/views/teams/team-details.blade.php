@extends('app')

@section('content')
    <div class="text-center">
        <div class="panel">
            <div class="panel-heading orange">{{trans("messages.detail-of-team")}} {{$team->name}}</div>
            <div class="body_content ">
                @include('errors.error')
                @if(!is_null(Session::get('message')))<span class="green-text">{{Session::get('message')}}</span>@endif
                <!-- INFO -->
                <div class="info-box">
                    <h3>{{trans('messages.info')}}</h3>
                        <table class="info-table">
                        <tr>
                            <td>
                                <strong>{{trans('messages.id')}} :</strong>
                            </td>
                            <td>
                                {{ $team->id }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>{{trans('messages.name')}} :</strong>
                            </td>
                            <td>
                                {{ $team->name }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>{{trans('messages.abbreviation')}} :</strong>
                            </td>
                            <td>
                                {{ $team->abbreviation }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>{{trans('messages.captain')}} :</strong>
                            </td>
                            <td>
                                @if(!is_null($team->captain)){{$team->captain->nickname }}@endif
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>{{trans('messages.description')}} :</strong>
                            </td>
                            <td>
                                {{ $team->description }}
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="info-right">

                <!-- USER INVITATION -->
                @if(Auth::user()->isCaptain($team))
                    <h3>{{trans('messages.invite-user')}}</h3>
                    <form action="{{url('/teams/inviteUser/'.$team->id)}}">
                        <div class="form-group">
                            <label for="user_inv_id" class="input-label">
                                {{trans('messages.select-user')}}
                            </label>
                            <input type="hidden" id="user_inv_id" required>
                            <select name="user_inv_id" id="user_inv_select" class="input-field select">
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->nickname}}</option>
                                @endforeach
                            </select>

                        <button type="submit" class="btn-common orange" name="inv-btn" >
                            <i class="fa fa-user-plus"></i>
                            {{trans('messages.invite')}}
                        </button>
                        </div>
                    </form>
                @endif

                <!-- Tournament JOIN -->
                @if(Auth::user()->isCaptain($team))
                    <h3>{{trans('messages.join-tournament')}}</h3>
                    <form action="{{url('/teams/joinTournament/'.$team->id)}}">
                        <div class="form-group">
                            <label for="tour_join_id" class="input-label">
                                {{trans('messages.select-tournament')}}
                            </label>
                            <input type="hidden" id="tour_join_id" required>
                            <select name="tour_join_id" id="tour_join_select" class="input-field select">
                                @foreach($tournaments as $tournament)
                                    <option value="{{$tournament->id}}">{{$tournament->name}} {{count($tournament->signedTeams()->get())}} / {{$tournament->max_number_of_teams}}</option>
                                @endforeach
                            </select>

                            <button type="submit" class="btn-common orange" name="inv-btn" >
                                <i class="fa fa-sign-in"></i>
                                {{trans('messages.join')}}
                            </button>
                        </div>
                    </form>
                    @endif

                <!-- MEMBERS -->
                <h3>{{trans('messages.members')}}</h3>
                @if (count($team->members()->get()) > 0)
                <table class="fine-table">
                    <thead>
                    <th>{{trans('messages.nickname')}}</th>
                    <th>{{trans('messages.email')}}</th>
                    <th colspan="4" id="actions">{{trans('messages.actions')}}</th>
                    </thead>
                    <tbody>
                    @foreach ($team->members()->get() as $user)
                        <tr>
                            <td>

                                <div>
                                    @if($user->isCaptain($team))
                                        <i class="fa fa-star"></i>
                                    @endif
                                    {{ $user->nickname }}</div>
                            </td>
                            <td>
                                <div>{{ $user->email }}</div>
                            </td>
                            @include('users.users-table-actions')
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <!-- TOURNAMENTS -->
                <h3>{{trans('messages.tournaments')}}</h3>
                @if (count($team->tournaments()->get()) > 0)
                    <table class="fine-table">
                        <thead>
                        <th>{{trans('messages.name')}}</th>
                        <th colspan="4" id="actions">{{trans('messages.actions')}}</th>
                        </thead>
                        <tbody>
                        @foreach ($team->tournaments()->get() as $tournament)
                            <tr>
                                <td>
                                    <div>{{$tournament->name}}</div>
                                </td>
                                @include('tournaments.tournaments-table-actions')
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
                <!-- PAGINATION -->
                @else
                    {{trans('messages.no-members')}}
                @endif

                </div>
            </div>
        </div>
    </div>
@endsection
