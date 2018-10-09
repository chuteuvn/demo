@extends('layouts.app')

@section('content')
    {!! Form::open(array('route' => 'product.importdb','method'=>'POST','files'=>'true')) !!}
    <div class="row text-center">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                {!! Form::label('sample_file','Select File to Import:',['class'=>'col-md-3']) !!}
                <div class="col-md-9">
                    {!! Form::file('sample_file', array('class' => 'form-control')) !!}
                    {!! $errors->first('sample_file', '<p class="alert alert-danger">:message</p>') !!}
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            {!! Form::submit('Upload',['class'=>'btn btn-primary']) !!}
        </div>
    </div>
    {!! Form::close() !!}

@stop