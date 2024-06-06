
@extends('layouts.app')

@section('content')


<div class="container py-2">
<div class="col-12 d-flex justify-content-between ">
<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb">
  <p class="breadcrumb-item h3 active" aria-current="page"></p>
  </ol>
</nav>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active " aria-current="page"><a class="d-flex justify-content-around" href="{{ route('posts.index') }}"><p class="ps-3">العودة</p>  <i class="fa-solid fa-hand-point-left"></i></a>  </li>
  </ol>
</nav>
   </div>
        <h1 class="text-center">Create Post</h1>

        <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">العنوان</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter post title">
                @error('title')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">الوصف</label>
                <textarea class="form-control" id="description" name="description" rows="5"></textarea>
                @error('description')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">صورة</label>
                <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
    @endsection