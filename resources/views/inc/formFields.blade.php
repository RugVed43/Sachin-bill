<?php
    $appends = null;
    if(!empty($field['required']) && empty($field['disabled'])){
        $appends ='required';
    }
    if(!empty($field['disabled'])){
        $appends ='disabled';
    }
    if(!isset($field['style'])){
        $field['style'] ='';
    }
    if(!isset($field['divStyle'])){
        $field['divStyle'] ='';
    } 
    if(!isset($field['divId'])){
        $field['divId'] =$field['id']."Div";
    } 
   
?>
@if ($field['type']=="string")
<div class="form-group{{ $errors->has($field['key']) ? ' has-error' : '' }}" style="{{ $field['divStyle'] }}"
    id="{{ $field['divId'] }}">
    {!! Form::label($field['key'], $field['name']) !!}
    {!! Form::text($field['key'], $field['editVal'], [
    'class' => 'form-control ' . $field['classes'],
    'id' => $field['id'],
    'style' => $field['style'],
    'placeholder'=>$field['placeholder'],
    $appends
    ]) !!}
    <small class="text-danger">{{ $errors->first($field['key']) }}</small>
    </div>
@endif
@if ($field['type']=="text")
<div class="form-group{{ $errors->has($field['key']) ? ' has-error' : '' }}" style="{{ $field['divStyle'] }}"
    id="{{ $field['divId'] }}">
    {!! Form::label($field['key'], $field['name']) !!}
    {!! Form::textarea($field['key'], $field['editVal'], [
    'class' => 'form-control ' . $field['classes'],
    'id' => $field['id'],
    'style' => $field['style'],
    'placeholder'=>$field['placeholder'],
    $appends
    ])!!}
    <small class="text-danger">{{ $errors->first($field['key']) }}</small>
    </div>
@endif
@if ($field['type']=="select")
<div class="form-group{{ $errors->has($field['key']) ? ' has-error' : '' }}" style="{{ $field['divStyle'] }}"
    id="{{ $field['divId'] }}">
    {!! Form::label($field['key'], $field['name']) !!}
    {!! Form::select($field['key'],$field['selectVar'], $field['editVal'], [
    'class' => 'form-control ' .
    $field['classes'],
    'id' => $field['id'],
    'style' => $field['style'],
    'placeholder'=>'Select a Entry',
    'placeholder'=>$field['placeholder'],
    $appends
    ]) !!}
    <small class="text-danger">{{ $errors->first($field['key']) }}</small>
    </div>
@endif
@if ($field['type']=="date")
<div class="form-group{{ $errors->has($field['key']) ? ' has-error' : '' }}" style="{{ $field['divStyle'] }}"
    id="{{ $field['divId'] }}">
    {!! Form::label($field['key'], $field['name']) !!}
    {!! Form::text($field['key'], $field['editVal'], [
    'class' => 'form-control ' . $field['classes'],
    'id' => $field['id'],
    'style' => $field['style'],
    'placeholder'=>$field['placeholder'],
    $appends
    ]) !!}
    <small class="text-danger">{{ $errors->first($field['key']) }}</small>
    </div>
@endif
@if ($field['type']=="file")
<div class="form-group" style="{{ $field['divStyle'] }}" id="{{ $field['divId'] }}">
    {!! Form::label('photo', $field['name'],['style' =>'color: #000',]) !!}
    <br>
    <div class='fileinput fileinput-new text-center' data-provides='fileinput'>
        <div>
            <span class='btn btn-rose btn-round btn-file'>
                <span class='fileinput-new'>Select image</span>
                <span class='fileinput-exists'>Change</span>
                <input type='file' name="{{ $field['key'] }}" id="{{ $field['key'] }}" style="{{ $field['style'] }}"
                    {{ $appends }} />
            </span>
            <a href='#pablo' class='btn btn-danger btn-round fileinput-exists' data-dismiss='fileinput'><i
                    class='fa fa-times'></i> Remove</a>
            <span class='fileinput-filename'></span>
        </div>
    </div> 
</div>
@endif
@if ($field['type']=="datetime")
<div class="form-group{{ $errors->has($field['key']) ? ' has-error' : '' }}" style="{{ $field['divStyle'] }}"
    id="{{ $field['divId'] }}">
    {!! Form::label($field['key'], $field['name']) !!}
    {!! Form::text($field['key'], $field['editVal'], [
    'class' => 'form-control ' . $field['classes'],
    'id' => $field['id'],
    'style' => $field['style'],
    'placeholder'=>$field['placeholder'],
    $appends
    ]) !!}
    <small class="text-danger">{{ $errors->first($field['key']) }}</small>
    </div>
@endif