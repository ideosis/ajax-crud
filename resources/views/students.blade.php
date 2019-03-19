@extends('layouts.app')
@section('content')
<div class="jumbotron jumbotron-fluid">
    <div class="container text-center">
        <h1 class="display-4">Laravel 5.8 CRUD using Ajax</h1>
    </div>
</div>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#studentModal">
    Add Student
</button>

<table class="table table-hover">
    <thead>
        <tr>
        <th scope="col">S. No</th>
        <th scope="col">Name</th>
        <th scope="col">Course</th>
        <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody id="addRow">
        @foreach ($students as $indexKey => $student)
        <tr>
        <th scope="row" class="col1">{{ ++$indexKey }}</th>
        <td>{{ $student->name }}</td>
        <td>{{ $student->course}}</td>
        <td>
            <div class="btn-group" role="group" aria-label="Action Buttons">
                <button type="button" class="btn btn-info" data-id="{{ $student->id }}" data-name="{{ $student->name }}" data-course="{{ $student->course }}">Edit</button>
                <button type="button" class="btn btn-danger" data-id="{{ $student->id }}">Delete</button>
            </div>
        </td>
        </tr>
        @endforeach

    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="studentModal" tabindex="-1" role="dialog" aria-labelledby="studentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="studentModalLabel">Modal Title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="studentModalForm">
                    <input type="hidden" id="id" name="id">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                    </div>
                    <div class="form-group">
                        <label for="course">Course</label>
                        <input type="text" class="form-control" id="course" name="course" placeholder="Course">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-save">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endsection
