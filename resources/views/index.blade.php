@extends('layouts.bootstrap')
@section('title')
    The Converter
@endsection 

@section('content')

<div class="card">
  <div class="card-header">
    Convert from CSV
  </div>
  <div class="card-body">
    <h5 class="card-title">New content in few clicks...</h5>
    <p>A valid csv file needs to have 5 columns: <strong>name|address|stars|contact|phone|url</strong></p>
    
   <div id="loading-badge"></div>
   @if (count($errors) > 0)
    <div class="alert alert-danger">        
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if( Session::has( 'success' ))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {!! Session::get( 'success' ) !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">x</span>
            </button>
        </div>        
    @elseif( Session::has( 'error' ))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error: </strong> {!! Session::get( 'error' ) !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">x</span>
            </button>
        </div>        
    @endif

    <div class="row">
    <div class="col-sm-12">
        {!! Form::open(['url' => '', 'files' => true, 'method' => 'POST','class' => 'form-inline','id' => 'form-converter']) !!}
    
        <div class="col-sm-8">
            <div class="custom-file">                                       
                {!! Form::file('file',['id' => 'file','required','class' => 'custom-file-input']) !!}
                {!! Form::label('file','Choose CSV file...',['class' => 'custom-file-label']) !!}                    
            </div>
        </div>

        <div class="col-sm-2">            
            <div class="form-group">
                {!! Form::select('formats', ['html' => 'HTML', 'json' => 'JSON'], null, ['placeholder' => 'Convert to format...','class' => 'custom-select', 'required']) !!}              
            </div>
        </div>
        <div class="col-sm-2">  
            <div class="form-group">          
                <button type="submit" class="btn btn-primary btn-convert" >Convert</button>
            </div>
        </div>
    </div>
    </form>    
  </div>
</div>

@endsection