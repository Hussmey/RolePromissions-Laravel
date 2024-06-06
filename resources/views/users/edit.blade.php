@extends('layouts.app')

@section('content')
<div class="row">
<div class="col-12 d-flex justify-content-between ">
<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb">
  <p class="breadcrumb-item h3 active" aria-current="page"> {{ $user->name }} </p>
  </ol>
</nav>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active " aria-current="page"><a class="d-flex justify-content-around" href="{{ route('users.index') }}"><p class="ps-3">العودة</p>  <i class="fa-solid fa-hand-point-left"></i></a>  </li>
  </ol>
</nav>
   </div>
</div>

</div>
<h2 class="text-center">تعديل المستخدم</h2>

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

{!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
<div class="row p-5">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group mb-3">
            <strong>الاسم:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group mb-3">
            <strong>البريد الإلكتروني:</strong>
            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group mb-3">
            <strong>الرقم السري:</strong>
            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group mb-3">
            <strong>تأكيد الرقم السري:</strong>
            {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group mb-3">
            <strong>الأدوار:</strong>
            {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">تأكيد</button>
    </div>
</div>
{!! Form::close() !!}

@endsection