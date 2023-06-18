@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-12">
            @if (session('info'))
                <div class="alert alert-solid-primary d-flex align-items-center" role="alert">
                    <i class="mdi mdi-check-circle-outline me-2"></i>
                    {{ session('info') }}
                </div>
            @endif
            <div class="card">
                <div class="d-flex justify-content-between align-items-center card-header">
                    <h5 class="mb-0">Tasks List</h5>
                    <div class="d-flex">
                        <form class="me-3 d-inline-block" id="filter_form" method="get" action="{{ route('task.index') }}">
                            <select name="filter_status" onchange="$('#filter_form').submit();" class="form-select">
                                <option value="all">All</option>
                                @foreach (config('status.task_status') as $key => $status)
                                    <option {{ request('filter_status') == $key ? 'selected' : '' }}
                                        value="{{ $key }}">
                                        {{ $status }}</option>
                                @endforeach
                            </select>
                        </form>
                        <a href="{{ route('task.create') }}" class="btn btn-sm btn-primary text-nowrap">
                            <i class="mdi mdi-plus me-2"></i>
                            Create Task
                        </a>
                    </div>
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>User</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($tasks as $task)
                                <tr>
                                    <td>
                                        <strong>{{ $loop->iteration }}</strong>
                                    </td>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ $task->description }}</td>
                                    <td>
                                        <span class="badge bg-label-primary me-1">
                                            {{ $task->user->name ?? 'Not assign' }}
                                        </span>
                                    </td>
                                    <td>
                                        @if ($task->status == 1)
                                            <span class="badge bg-primary me-1">
                                                {{ config("status.task_status.$task->status") }}
                                            </span>
                                        @else
                                            <span class="badge bg-success me-1">
                                                {{ config("status.task_status.$task->status") }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        {{-- user asign modal --}}
                                        <div class="modal fade" id="assignUser{{ $loop->iteration }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-simple modal-enable-otp">
                                                <div class="modal-content p-3 p-md-5">
                                                    <div class="modal-body pt-3 pt-md-0">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                        <div class="text-center">
                                                            <h3 class="mb-2">Assign Task</h3>
                                                            <p>Assign a user to task</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mb-4 pb-2">
                                                        <form action="{{ route('task.assign', $task->id) }}"
                                                            method="post">
                                                            @csrf
                                                            <div class="form-floating form-floating-outline">
                                                                <select class="form-select" name="user_id">
                                                                    @forelse ($users as $user)
                                                                        <option value="{{ $user->id }}">
                                                                            {{ $user->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <label for="select2Basic">Add User</label>
                                                            </div>
                                                            <button class="btn btn-label-primary mt-3">Assign</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" data-bs-target="#assignUser{{ $loop->iteration }}"
                                            data-bs-toggle="modal"
                                            class="btn btn-sm rounded-pill btn-icon btn-label-primary btn-fab demo waves-effect waves-light">
                                            <span class="tf-icons mdi mdi-account"></span>
                                        </button>
                                        <a class="btn btn-sm rounded-pill btn-icon btn-success btn-fab demo waves-effect waves-light"
                                            href="{{ route('task.edit', $task->id) }}"><span
                                                class="tf-icons mdi mdi-pencil"></span></a>
                                        <form action="{{ route('task.destroy', $task->id) }}" method="post"
                                            class="d-inline-block">
                                            @csrf
                                            @method('delete')
                                            <button type="submit"
                                                class="btn btn-sm rounded-pill btn-icon btn-danger btn-fab demo waves-effect waves-light">
                                                <span class="tf-icons mdi mdi-trash-can"></span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="px-3 mt-3">
                    {{ $tasks->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
