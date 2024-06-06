@extends('layouts.app')

@section('content')
<div class="row">
<div class="col-12 d-flex justify-content-between ">
<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb">
  <p class="breadcrumb-item h3 active" aria-current="page"> {{ $role->name }} </p>
  </ol>
</nav>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active " aria-current="page"><a class="d-flex justify-content-around" href="{{ route('roles.index') }}"><p class="ps-3">العودة</p>  <i class="fa-solid fa-hand-point-left"></i></a>  </li>
  </ol>
</nav>
   </div>
</div>
       <h2 class="text-center">تعديل الدور </h2>     
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> كانت هناك بعض المشاكل مع المدخلات الخاصة بك.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif
{!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
<div class="row p-4">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>الاسم:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Permission:</strong>
            <div class="row">
                @foreach($permission as $value)
                    <div class="col-2 mb-2">
                        <label class="d-flex flex-column align-items-center">
                            {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                            <span class="badge rounded-pill text-bg-warning mt-1">{{ $value->name }}</span>
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}


@endsection
<p class="text-center text-primary"><small>Tutorial by LaravelTuts.com</small></p>