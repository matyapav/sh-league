@extends('app')

@section('content')
    <div class="text-center">
        <div class="panel">
            <div class="panel-heading orange">{{trans("messages.detail-of-user")}} {{$user->nickname}}</div>
            <div class="body_content ">
                @include('errors.error')
                <div class="info-box">
                    <h3>{{trans('messages.info')}}</h3>
                        <table class="info-table">
                        <tr>
                            <td>
                                <strong>{{trans('messages.id')}} :</strong>
                            </td>
                            <td>
                                {{ $user->id }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>{{trans('messages.nickname')}} :</strong>
                            </td>
                            <td>
                                {{ $user->nickname }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>{{trans('messages.email')}} :</strong>
                            </td>
                            <td>
                                {{ $user->email }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>{{trans('messages.name')}} :</strong>
                            </td>
                            <td>
                                {{ $user->name }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>{{trans('messages.city')}} :</strong>
                            </td>
                            <td>
                                {{ $user->city }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>{{trans('messages.state')}} :</strong>
                            </td>
                            <td>
                                {{ $user->state }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>{{trans('messages.birthdate')}} :</strong>
                            </td>
                            <td>
                                {{ $user->birthdate }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>{{trans('messages.role')}} :</strong>
                            </td>
                            <td>
                                @foreach($user->roles()->get() as $role)
                                    {{$role->name}}<br>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>{{trans('messages.avatar')}} :</strong>
                            </td>
                            <td>
                                <img class="user-info-image" src="@if(!is_null($user->avatar) && !empty($user->avatar)){{ asset('images/'.$user->avatar)}}@else{{asset('images/guest.png')}}@endif" alt="user avatar">
                            </td>
                        </tr>
                    </table>
                </div>
                <br>
                <div class="info-right">
                    <!-- TEAMS ASSOCIATED WITH USER -->
                    <h2>{{trans('messages.user-teams')}}</h2>
                    <table class="fine-table" id="teams-table">
                        <!-- Table Headings -->
                        <thead>
                        <th>{{trans('messages.team')}}</th>
                        <th>{{trans('messages.abbreviation')}}</th>
                        <th>{{trans('messages.members-count')}}</th>
                        <th>{{trans('messages.user-role-in-team')}}</th>
                        <th colspan="4">{{trans('messages.actions')}}</th>
                        </thead>
                        <!-- Table Body -->
                        <tbody>
                        @foreach ($user->teams()->get() as $team)
                            <tr>
                                <!-- Team Details -->
                                <td>
                                    <div>{{ $team->name }}</div>
                                </td>
                                <td>
                                    <div>{{ $team->abbreviation }}</div>
                                </td>
                                <td>
                                    <div>{{ $team->members()->get()->count() }}</div>
                                </td>
                                <td>
                                    <div>
                                        @if(!is_null($team->captain) && $team->captain->id == $user->id)
                                            Captain
                                        @else
                                            Member
                                        @endif
                                    </div>
                                </td>
                                @include('teams.teams-table-actions')
                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                    <!-- INVITATIONS FROM TEAMS -->
                    @if(Auth::user()->id == $user->id)
                        <h2>{{trans('messages.inv-to-teams')}}</h2>
                        <table class="fine-table" id="invitations-table">
                            <!-- Table Headings -->
                            <thead>
                            <th>{{trans('messages.team')}}</th>
                            <th>{{trans('messages.captain')}}</th>
                            <th colspan="2">{{trans('messages.actions')}}</th>
                            </thead>
                            <!-- Table Body -->
                            <tbody>
                            @foreach ($user->invitations()->get() as $invitation)
                                <tr>
                                    <!-- Invitation Details -->
                                    <td>
                                        <div>{{ $invitation->name }}</div>
                                    </td>
                                    <td>
                                        <div>{{ $invitation->captain->name }}</div>
                                    </td>
                                    <td>
                                        <a href="{{ URL::to('users/acceptInvitation/'.$invitation->id) }}">
                                            <button class="btn-common green" >
                                                <i class="fa fa-check"></i>
                                                {{trans('messages.accept')}}
                                            </button>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ URL::to('users/declineInvitation/'.$invitation->id) }}">
                                            <button class="btn-common red" >
                                                <i class="fa fa-times"></i>
                                                {{trans('messages.decline')}}
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
