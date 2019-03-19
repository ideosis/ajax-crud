@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12">
        <button type="button" class="btn btn-success mb-2" id="create-new-user">Add User</button>
        <a href="https://www.tutsmake.com/jquery-submit-form-ajax-php-laravel-5-7-without-page-load/" class="btn btn-secondary mb-2 float-right">Back to Post</a>
        <table class="table table-hover">
        <thead>
            <tr>
                <th>S. No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="users-crud">
            @foreach($users as $indexKey => $u_info)
            <tr id="user_id_{{ $u_info->id }}">
                <th class="col1">{{ ++$indexKey  }}</th>
                <td>{{ $u_info->name }}</td>
                <td>{{ $u_info->email }}</td>
                <td>
                    <div class="btn-group" role="group" aria-label="Action">
                    <button type="button" class="btn btn-info" id="edit-user" data-id="{{ $u_info->id }}"><i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-danger" id="delete-user" data-id="{{ $u_info->id }}"><i class="fa fa-trash"></i></button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
        {{ $users->links() }}
    </div>
</div>

{{-- Create and Update Modal --}}
<div class="modal fade" id="ajax-crud-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="userCrudModal"></h4>
            </div>
            <form id="userForm" name="userForm" class="form-horizontal">
            <div class="modal-body">
                <input type="hidden" name="user_id" id="user_id">
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-12">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="" required="">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="btn-save" value="create">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

{{-- Delete Modal --}}
<div class="modal fade" id="ajax-delete-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete User</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this?</p>
                </div>
                <div class="modal-footer">
                    <form>
                        <input type="hidden" id="id_delete">
                        <button type="submit" class="btn btn-danger" id="btn-confirm">Yes, delete it!</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
