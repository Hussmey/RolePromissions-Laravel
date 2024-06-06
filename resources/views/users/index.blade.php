@extends('layouts.app')

@section('content')

<div class="row mt-3 py2">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 class="text-center"> إدارة المستخدمين</h2>
        </div>
        <div class="pull-right">
           
                <a class="btn btn-success" href="{{ route('users.create') }}"> إنشاء مستخدم جديد</a>
          
        </div>
    </div>
</div>
<div class="mt-3">
  <form class="d-flex col-6 " role="search"id="searchForm" method="GET" action="{{ route('users.index') }}">
        <input class="form-control me-2"  type="search" name="search" placeholder="ابحث عن مستخدم" aria-label="Search">
        <button class="btn btn-outline-success" type="submit"><i class="fa-brands fa-searchengin"></i></button>
      </form>  
</div>



@if ($message = Session::get('success'))
<div class="alert alert-success text-center">
  <p>{{ $message }}</p>
</div>
@endif


@if($data->isEmpty())
<div class="card text-center mt-5">
  <div class="card-body bg-warning bg-gradient bg-opacity-50">
    <p class="card-text">لا يوجد مستخدمين باسم مطابق للبحث.</p>
    <p><i class="fa-solid fa-person-circle-plus iconDinger"></i></p>
    <a href="{{ route('users.index') }}" class="btn btn-outline-primary mt-3">عرض جميع المستخدمين</a>
  </div>
</div>
@else
<table class="table table-responsive mt-4">
 <tr>
    <th>No</th>
    <th>الاسم</th>
    <th>البريد الإلكتروني</th>
    <th>الأدوار</th>
    <th width="280px">الإجراء</th>
 </tr>
 @foreach ($data as $key => $user)
  <tr>
    <td>{{ ++$i }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>
      @if(!empty($user->getRoleNames()))
        @foreach($user->getRoleNames() as $v)
           <label class="">{{ $v }}</label>
        @endforeach
      @endif
    </td>
    <td>
       <a href="{{ route('users.show',$user->id) }}" class="btn text-success btnIcon"><i class="fa-solid fa-eye"></i></a>
       <a href="{{ route('users.edit',$user->id) }}" class="btn text-primary btnIcon"><i class="fa-solid fa-pen-to-square"></i></a>
        <a class="btn text-danger btnIcon" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->id }}"><i class="fa-solid fa-trash"></i></a>

        <!-- Modal for delete confirmation -->
        <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">تأكيد الحذف</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>هل أنت متأكد أنك تريد حذف المستخدم {{ $user->name }}؟</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                        
                        <!-- Change the form method to POST and update the action attribute -->
                        {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline;']) !!}
                            {!! Form::submit('حذف', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </td>
  </tr>
 @endforeach
</table>

{!! $data->render() !!}
@endif

@endsection
