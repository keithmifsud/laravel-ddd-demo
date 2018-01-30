@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Update Profile</div>
                    <div class="panel-body">
                        <form action="{{route('profile')}}"
                              class="form-horizontal" method="POST">

                            {{  csrf_field() }}

                            <input type="hidden" id="user_identifier"
                                   name="user_identifier" value="{{
                                   $member->user_identifier }}">

                            <div class="form-group {{ $errors->has
                            ('international_dialling_code') ? 'has-error' : ''}}">
                                <label for="international_dialling_code"
                                       class="col-md-4 control-label">

                                </label>


                            </div>

                            @foreach($internationalDiallingCodes as $code =>
                            $internationalDiallingCode)
    {{ $code }} - {{$internationalDiallingCode}} <br>
                            @endforeach

                            @foreach($countries as $code =>
                            $country)
    {{ $code }} - {{$country}} <br>
                            @endforeach
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

