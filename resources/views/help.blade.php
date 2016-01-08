@extends('app')

@section('content')
    <div class="text-center">
        <div class="panel">
            <div class="panel-heading orange">{{trans('messages.help')}}</div>
            <div class="body_content ">
                @include('errors.error')
                <hr>
                <table class="fine-table">
                    <thead>
                    <th>{{trans('messages.icon')}}</th>
                    <th>{{trans('messages.description')}}</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <button class="btn-wrap-content orange" >
                                    <i class="fa fa-pencil"></i>
                                </button>
                            </td>
                            <td>
                                {{trans('messages.help-edit')}}

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button class="btn-wrap-content blue" >
                                    <i class="fa fa-eye"></i>
                                </button>
                            </td>
                            <td>
                                {{trans('messages.help-show')}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button class="btn-wrap-content red" >
                                    <i class="fa fa-trash-o"></i>
                                </button>
                            </td>
                            <td>
                                {{trans('messages.help-delete')}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button class="btn-wrap-content orange" >
                                    <i class="fa fa-sign-out"></i>
                                </button>
                            </td>
                            <td>
                                {{trans('messages.help-leave')}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button class="btn-wrap-content red" >
                                    <i class="fa fa-user-times"></i>
                                </button>
                            </td>
                            <td>
                                {{trans('messages.help-kick')}}
                            </td>
                        </tr>
                        <tr>
                            <td>

                                <button class="btn-wrap-content blue" >
                                    <i class="fa fa-forward"></i><i class="fa fa-star"></i>
                                </button>
                            </td>
                            <td>
                                {{trans('messages.help-forward')}}
                            </td>
                        </tr>
                    </tbody>
                </table>


                <hr>
            </div>
        </div>
    </div>
@endsection
