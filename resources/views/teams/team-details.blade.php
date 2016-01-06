@extends('app')

@section('content')
    <div class="text-center">
        <div class="panel">
            <div class="panel-heading orange">{{trans("messages.detail-of-team")}} {{$team->name}}</div>
            <div class="body_content ">
                @include('errors.error')
                @if(!is_null(Session::get('message')))<span class="green-text">{{Session::get('message')}}</span>@endif
                <div class="info-box">
                    <h3>Info</h3>
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
                    <form action="{{url('/teams/inviteUser/'.$team->id)}}">
                        <div class="form-group">
                            <label for="user_inv_id" class="input-label">
                                {{trans('messages.user')}}
                            </label>
                            <input type="hidden" id="user_inv_id" required>
                            <select name="user_inv_id" id="user_inv_select" class="input-field select">
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->nickname}}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn-common orange">
                                <i class="fa fa-user-plus"></i>
                                Invite user
                            </button>
                        </div>

                    </form>
                @endif

                <!-- TABLE OF USERS IN TEAM -->
                @if (count($team->members()->get()) > 0)
                <!-- Table Headings -->
                <table class="fine-table">
                    <thead>
                    <th>{{trans('messages.nickname')}}</th>
                    <th>{{trans('messages.email')}}</th>
                    <th colspan="3">{{trans('messages.actions')}}</th>
                    </thead>
                    <!-- Table Body -->
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

                @else
                    {{trans('messages.no-members')}}
                @endif

                </div>
            </div>
        </div>
    </div>
@endsection
