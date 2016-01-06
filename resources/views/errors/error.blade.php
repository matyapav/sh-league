@if (count($errors) > 0)
    <div class="error text-center" id="errordiv">
        <div class="btn-close-onlyicon">
            <i class="fa fa-times" onclick="hideErrors()"></i>
        </div>
        <img src="{{ asset('images/yoda2.png') }}" alt="master-yoda"><br>
        {{trans('messages.yoda-err-msg')}}
        <br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

