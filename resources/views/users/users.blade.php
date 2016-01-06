@extends('app')

@section('content')
    <div class="text-center">
        <div class="panel">
            <div class="panel-heading orange">{{trans('messages.users')}}</div>
                <div class="body_content ">
                    @include("errors.error")
                    @if (count($users) > 0)
                    <table class="fine-table" id="user-table">
                        <!-- Table Headings -->
                        <thead>
                            <th>{{trans('messages.nickname')}}</th>
                            <th>{{trans('messages.email')}}</th>
                            <th>{{trans('messages.role')}}</th>
                            <th colspan="2">{{trans('messages.actions')}}</th>
                        </thead>
                        <!-- Table Body -->
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                <!-- Tournament Details -->
                                    <td>
                                        <div>{{ $user->nickname }}</div>
                                    </td>
                                    <td>
                                        <div>{{ $user->email }}</div>
                                    </td>
                                    <td>
                                        @if(count($user->roles()->get()) > 0)
                                            @foreach($user->roles()->get() as $role)
                                                <div>{{$role->name}}</div>
                                            @endforeach
                                        @else
                                            {{trans("messages.user")}}
                                        @endif
                                    </td>
                                    @include('users.users-table-actions')
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        {!! $users->render()!!}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
