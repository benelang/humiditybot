@extends('humiditybot.layout')
@section('document__main')
  <div class="col-md-6 login centered">
    {!! BootForm::open() !!}
      {!! BootForm::text('E-Mail', 'email') !!}
      {!! BootForm::password('Passwort', 'password') !!}
      {!! BootForm::submit('Login')->class('btn btn-primary') !!}
    {!! BootForm::close() !!}
  </div>
@stop
