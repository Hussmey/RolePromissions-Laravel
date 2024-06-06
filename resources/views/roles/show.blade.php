@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12 d-flex justify-content-between">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <p class="breadcrumb-item h3 active" aria-current="page">{{ $role->name }}</p>
            </ol>
        </nav>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active " aria-current="page">
                    <a class="d-flex justify-content-around" href="{{ route('roles.index') }}">
                        <p class="ps-3">العودة</p> <i class="fa-solid fa-hand-point-left"></i>
                    </a>
                </li>
            </ol>
        </nav>
    </div>
</div>

<h2 class="text-center">الأذونات</h2>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group text-center">
            <h4>{{ $role->name }}</h4>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 mt-5">
        <div class="form-group">
            <strong>الأذونات:</strong>
            @if(!empty($rolePermissions))
                <div class="row">
                    @foreach($rolePermissions as $index => $v)
                        <div class="col-md-{{ ($index + 1) % 5 == 0 ? '2' : '2' }}"> <!-- Adjust the column size as needed -->
                            <span class="badge rounded-pill bg-success">{{ $v->name }}</span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
