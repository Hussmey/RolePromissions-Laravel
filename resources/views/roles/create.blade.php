@extends('layouts.app')

@section('content')
<div class="row">
<div class="col-12 d-flex justify-content-between ">
<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb">
  <p class="breadcrumb-item h3 active" aria-current="page"></p>
  </ol>
</nav>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active " aria-current="page"><a class="d-flex justify-content-around" href="{{ route('roles.index') }}"><p class="ps-3">العودة</p>  <i class="fa-solid fa-hand-point-left"></i></a>  </li>
  </ol>
</nav>
   </div>
   <h2 class="text-center">انشاء دور جديد</h2>

@if (count($errors) > 0)
    <div class="alert alert-danger text-center">
        <strong>عفوًا!</strong> كانت هناك بعض المشاكل مع المدخلات الخاصة بك.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif

{!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
<div class="row mt-3 p-4">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong class="mb-2">الاسم:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-12 mt-3">
    <div class="form-group">
        <strong>الأذونات:</strong>
        <div class="row">
            @foreach($permission as $value)
                <div class="col-2 mb-2">
                    <label class="form-check-label">
                        {{ Form::checkbox('permission[]', $value->id, false, array('class' => 'form-check-input')) }}
                        <span class="badge rounded-pill bg-info text-dark fs-6">{{ $value->name }}</span>
                    </label>
                </div>
            @endforeach
        </div>
    </div>
</div>


    <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-5">
        <button type="submit" class="btn btn-primary">موافق</button>
    </div>
</div>
{!! Form::close() !!}


@endsection