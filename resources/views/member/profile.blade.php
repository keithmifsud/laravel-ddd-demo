@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$member->first_name}}'s
                        Profile
                    </div>
                    <div class="panel-body">
                        <form action="{{route('profile')}}"
                              class="form-horizontal" method="POST">

                            {{  csrf_field() }}

                            <input type="hidden" id="user_identifier"
                                   name="user_identifier" value="{{
                                   $member->user_identifier }}">

                            <div class="form-group {{ $errors->has
                            ('domestic_phone_number') ? 'has-error' : ''}}">
                                <label for="domestic_phone_number"
                                       class="col-md-4 control-label">
                                    Phone Number
                                </label>
                                <div class="col-md-2">
                                    <select name="international_dialling_code"
                                            id="international_dialling_code"
                                            class="form-control">
                                        <option value="">Select...</option>
                                        @foreach($internationalDiallingCodes as $internationalDiallingCode)
                                            <option
                                                    value="{{$internationalDiallingCode}}"
                                                    @if((old
                                                    ('international_dialling_code')
                                                    == $internationalDiallingCode) ||
                                                     $member->international_dialling_code == $internationalDiallingCode) selected
                                                    @endif>+
                                                {{$internationalDiallingCode}}</option>
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

                                <div class="col-md-4">
                                    <input type="text" class="form-control"
                                           name="domestic_phone_number"
                                           id="domestic_phone_number"
                                           value="{{ old
                                           ('domestic_phone_number', $member->domestic_phone_number)
                                           }}" placeholder="Phone number">
                                    @if($errors->has('domestic_phone_number'))
                                        <span class="help-block">
                                            <strong>{{$errors->first('domestic_phone_number')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has
                            ('street_address') ? 'has-error' : '' }}">
                                <label for="street_address"
                                       class="col-md-4 control-label">
                                    Street
                                </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control"
                                           id="street_address"
                                           name="street_address"
                                           value="{{ old('street_address', $member->street_address) }}"
                                           placeholder="Street address">
                                    @if($errors->has('street_address'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('street_address')
                                            }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has
                            ('city') ? 'has-error' : '' }}">
                                <label for="city"
                                       class="col-md-4 control-label">
                                    City
                                </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control"
                                           id="city"
                                           name="city"
                                           value="{{ old('city', $member->city) }}"
                                           placeholder="City">
                                    @if($errors->has('city'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('city')
                                            }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has
                            ('region') ? 'has-error' : '' }}">
                                <label for="region"
                                       class="col-md-4 control-label">
                                    Region or State
                                </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control"
                                           id="region"
                                           name="region"
                                           value="{{ old('region', $member->region) }}"
                                           placeholder="Region or State">
                                    @if($errors->has('region'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('region')
                                            }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has
                            ('country_code') ? 'has-error' : '' }}">
                                <label for="country_code"
                                       class="col-md-4 control-label">
                                    Country
                                </label>
                                <div class="col-md-6">
                                    <select name="country_code"
                                            id="country_code"
                                            class="form-control">
                                        <option value="">Please select...</option>
                                        @foreach($countries as
                                        $code => $country)
                                            <option
                                                    value="{{$code}}"
                                                    @if((old
                                                    ('country_code')
                                                    == $code) ||
                                                     $member->country_code ==
                                                      $code) selected
                                                    @endif>
                                                {{$country}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('country_code'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('country_code')
                                            }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit"
                                            class="btn btn-primary">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

