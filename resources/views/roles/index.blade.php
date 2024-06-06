@extends('layouts.app')

@section('content')
<div class="row mt-3 py2">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 class="text-center">إدارة الأدوار</h2>
        </div>
        <div class="pull-right">
            @can('role-create')
                <a class="btn btn-success" href="{{ route('roles.create') }}"> إنشاء دور جديد</a>
            @endcan
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success text-center">
        <p>{{ $message }}</p>
    </div>
@endif

<table class="table table-responsive mt-4">
    <tr>
        <th>No</th>
        <th>الاسم</th>
        <th width="280px">الإجراء</th>
    </tr>
    @foreach ($roles as $key => $role)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $role->name }}</td>
            <td>
            <a href="{{ route('roles.show', $role->id) }}" class="btn text-success btnIcon"><i class="fa-solid fa-eye"></i></a>
               
                @can('role-edit')
                <a href="{{ route('roles.edit', $role->id) }}" class="btn text-primary btnIcon"><i class="fa-solid fa-pen-to-square"></i></a>
                @endcan
                @can('role-delete')
                    <a class="btn text-danger btnIcon" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $role->id }}"><i class="fa-solid fa-trash"></i></a>

                    <!-- Modal for delete confirmation -->
                    <div class="modal fade" id="deleteModal{{ $role->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">تأكيد الحذف</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>هل أنت متأكد أنك تريد حذف هذا الدور؟</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                                    
                                    <!-- Change the form method to POST and update the action attribute -->
                                    <form method="POST" action="{{ route('roles.delete-confirm', ['id' => $role->id]) }}" style="display: inline;">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">حذف</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endcan
            </td>
        </tr>
    @endforeach
</table>

{!! $roles->render() !!}

<p class="text-center text-primary"><small>Tutorial by LaravelTuts.com</small></p>
@endsection
