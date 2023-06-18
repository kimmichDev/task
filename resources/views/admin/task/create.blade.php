@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Create Task</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('task.store') }}" method="POST">
                        @csrf
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" name="title" value="{{ old('title') }}"
                                class="form-control @error('title') is-invalid @enderror" id="title"
                                placeholder="Create Git Repo">
                            <label for="title">Title</label>
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <p>{{ $message }}</p>
                                </span>
                            @enderror
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <textarea name="description" class="form-control h-px-100 @error('description') is-invalid @enderror" id="description"
                                placeholder="Comments here...">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <p>{{ $message }}</p>
                                </span>
                            @enderror
                            <label for="description">Description</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <select class="form-select @error('status') is-invalid @enderror" name="status"
                                id="exampleFormControlSelect1" aria-label="Default select example">
                                <option selected="" disabled>Open this select menu</option>
                                @foreach (config('status.task_status') as $key => $status)
                                    <option value="{{ $key }}">{{ $status }}</option>
                                @endforeach
                            </select>
                            <label for="exampleFormControlSelect1">Choose Status</label>
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <p>{{ $message }}</p>
                                </span>
                            @enderror
                        </div>
                        <div>
                            <button class="btn btn-label-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
