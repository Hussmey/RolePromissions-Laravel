@extends('layouts.app')

@section('content')
<div class="container">

<div class="row py-3">
  <div class="col-lg-12 margin-tb">
    <div class="d-flex justify-content-center">
      <h2>ادارة المدونات</h2>
    </div>
    <div class="pull-right">
      <a class="btn btn-success" href="{{ route('posts.create') }}">  انشاء مدونة جديدة</a>
    </div>
  </div>
</div>



@if ($message = Session::get('success'))
<div class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="d-flex">
    <div class="toast-body">
    <p>{{ $message }}</p>
    </div>
    <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
</div>

@endif


<form class="d-flex col-6" role="search"id="searchForm" method="GET" action="{{ route('posts.index') }}">
        <input class="form-control me-2"  type="search" name="search" placeholder="البحث عن" aria-label="Search">
        <button class="btn btn-outline-success" type="submit"><i class="fa-brands fa-searchengin"></i></button>
      </form>



@if($posts->isEmpty())
<div class="card text-center mt-5">
  <div class="card-body bg-warning bg-gradient bg-opacity-50">
    <p class="card-text">لم يتم العثور على أي مدونات تطابق بحثك.</p>
    <p><i class="fa-solid fa-person-circle-plus iconDinger"></i></p>
    <a href="{{ route('posts.index') }}" class="btn btn-outline-primary mt-3">كل المدونات</a>
  </div>
</div>
@else
<table class="table table-responsive mt-4" style="overflow-x: auto;">
  <thead class="text-center">
    <tr>
      <th>العنوان</th>
      <th>الوصف</th>
      <th>المؤلف</th>
      <th> تم الإنشاء في</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach ($posts as $post)
      <tr>
        <td class="col-2 text-center">{{ $post->title }}</td>
        <td class="col" >{{ Str::limit($post->description, 80) }}</td>
        <td class="col">{{ $post->user->name }}</td>
        <td class="col">{{ date('Y-m-d H:i', strtotime($post->created_at))}}</td>
        <td class="col">
          <a href="{{ route('posts.show', $post->id) }}" class="btn text-success btnIcon"><i class="fa-solid fa-eye"></i></a>
          <a href="{{ route('posts.edit', $post->id) }}" class="btn text-primary btnIcon"><i class="fa-solid fa-pen-to-square"></i></a>
          <a href="{{ route('posts.destroy', $post->id) }}" class="btn text-danger btnIcon" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $post->id }}"><i class="fa-solid fa-trash"></i></a>

        </td>

        <!-- Button trigger modal -->



<!-- Modal -->
<div class="modal fade bg-light bg-opacity-50" id="deleteModal{{ $post->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">هل أنت متأكد أنك تريد حذف هذه المدونة ?</h5>
                <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close">
                    <span class="fs-3" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body d-flex justify-content-center">
       <span><i class="fa-solid fa-land-mine-on text-danger iconDinger"></i></span>
      </div>
            <div class="modal-footer d-flex justify-content-between">
            <form class="text-end" method="POST" action="{{ route('posts.destroy', $post->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">تأكيد المسح</button>
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">الغاء</button>
            </div>
        </div>
    </div>
</div>



        
      </tr>
    @endforeach
  </tbody>
</table>
@endif


</div>

@endsection



