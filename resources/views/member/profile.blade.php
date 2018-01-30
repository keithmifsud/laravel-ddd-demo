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
                                    Phone Number
                                </label>
                                <div class="col-md-2">
                                    <select name="international_dialling_code"
                                            id="international_dialling_code"
                                            class="form-control">
                                        <option value="">Select...</option>
                                        @foreach($internationalDiallingCodes as $code =>
                                        $internationalDiallingCode)
                                            <option
                                                    value="{{$code}}">+ {{$internationalDiallingCode}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has
                                    ('international_dialling_code'))
                                        <span class="help-block">
                                            <strong>{{$errors->first('international_dialling_code')
                                            }}</strong>
                                        </span>
                                        @endif
                                </div>


                            </div>




                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

