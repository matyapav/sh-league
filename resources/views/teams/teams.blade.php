@extends('app')

@section('content')
    <div class="text-center">
        <div class="panel">
            <div class="panel-heading orange">{{trans('messages.teams')}}</div>
            <div class="body_content ">
                @include('errors.error')
                <a href="{{ URL::to('teams/createForm') }}"
                   class="a-over-btn">
                    <button class="btn-common green" >
                        <i class="fa fa-plus"></i>
                        {{trans('messages.new')}}
                    </button>
                </a>
                <br>
                @if (count($teams) > 0)
                <table class="fine-table" id="tournament-table">
                    <!-- Table Headings -->
                    <thead>
                        <th>{{trans('messages.team')}}</th>
                        <th>{{trans('messages.abbreviation')}}</th>
                        <th>{{trans('messages.members-count')}}</th>
                        <th colspan="3">{{trans('messages.actions')}}</th>
                    </thead>
                    <!-- Table Body -->
                    <tbody>
                    @foreach ($teams as $team)
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
                        @include('teams.teams-table-actions')
                    </tr>
                    @endforeach

                </tbody>
                </table>
                <div>
                {!! $teams->render()!!}
                </div>
                @endif

              </div>

            </div>
    </div>
@endsection
