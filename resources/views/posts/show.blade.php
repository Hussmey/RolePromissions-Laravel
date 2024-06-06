@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12">
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




    <div class="card border border-0 mb-3">
        <div class="image-showTopPage p-5">
           <img  src="{{ asset($imageUrl) }}"  class="card-img-top img-fluid " alt="{{ $post->title }}">   
        </div>


<hr class="border border-danger border-2 opacity-50">
<h2 class="card-title text-center">{{ $post->title }}</h2>
<hr class="border border-primary border-3 opacity-75">
  
         <div class="card-body">

    <p class="card-text">{{ $post->description }}</p>
    <div class="d-flex justify-content-between ">
    <p class="card-text"><small class="text-body-secondary">{{ date('Y-m-d H:i', strtotime($createdAt)) }}</small></p>
    <p class="card-text">كتب من<small class="text-body-secondary"> {{ $post->user->name }} <i class="fa-solid fa-calendar-days"></i></small></p>
    </div>
    
    </div>
    </div>
    </div>
  </div>
</div>


@endsection

<style>

</style>