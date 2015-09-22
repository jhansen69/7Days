@extends('template.master');

@section('content')
    {{ Auth::user()->id }}
    {!! Form::open(array('url'=>'/import','files'=>true,'method'=>'POST', 'class' => 'form')) !!}

    {!! Form::label('file','File',array('id'=>'','class'=>'form-label')) !!}
    {!! Form::file('file','',array('id'=>'','class'=>'form-input')) !!}
    {!! Form::hidden('test',1) !!}
    <br/>
    <!-- submit buttons -->
    {!! Form::submit('Save', array('class'=>'btn btn-primary')) !!}


    {!! Form::close() !!}
    @endsection