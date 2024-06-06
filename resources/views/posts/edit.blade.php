
@extends('layouts.app')

@section('content')

<div class="container">

<div class="col-12 d-flex justify-content-between ">
<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb">
  <p class="breadcrumb-item h3 active" aria-current="page"> {{ $post->title }} </p>
  </ol>
</nav>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active " aria-current="page"><a class="d-flex justify-content-around" href="{{ route('posts.index') }}"><p class="ps-3">العودة</p>  <i class="fa-solid fa-hand-point-left"></i></a>  </li>
  </ol>
</nav>
   </div>


        <h1 class="text-center"> تعديل المدونة</h1>

        <form class="p-4" action="{{ route('posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group py-2">
                <label for="title">العنوان</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
                @error('title')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group py-3 ">
                <label for="description">وصف</label>
                <textarea class="form-control textAreaInput" id="description" name="description" rows="5">{{ $post->description }}</textarea>

                @error('description')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>  

            <div class="form-group py-4">
                <label for="image">صورة </label>
                <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
                @if ($post->image)
                    <img src="{{ asset($post->image_path) }}" alt="{{ $post->title }}" style="max-width: 100px;" />
                @endif
            </div>

            <button type="submit" class="btn btn-primary">تحديث <i class="fa-solid fa-file-pen"></i></button>
        </form>
    </div>

    @endsection