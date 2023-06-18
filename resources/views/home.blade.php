@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="user-avatar-section">
                            <div class="d-flex align-items-center flex-column">
                                <img class="img-fluid rounded mb-3 mt-4" src="{{ asset('img/avatars/1.png') }}" height="120"
                                    width="120" alt="User avatar">
                                <div class="user-info text-center">
                                    <h4>{{ Auth::user()->name }}</h4>
                                    <span class="badge bg-label-primary">{{ Auth::user()->email }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center flex-wrap my-2 py-3">
                            <div>
                                <h5 class="pb-3 border-bottom mb-3">Details</h5>
                                <div class="info-container">
                                    <ul class="list-unstyled mb-4">
                                        <li class="mb-3">
                                            <span class="fw-semibold text-heading me-2">Username:</span>
                                            <span>{{ Auth::user()->name }}</span>
                                        </li>
                                        <li class="mb-3">
                                            <span class="fw-semibold text-heading me-2">Email:</span>
                                            <span>{{ Auth::user()->email }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="border border-1 border-primary-subtle bg-primary shadow-lg rounded">
                                <div class="d-flex align-items-center flex-wrap gap-2 px-5 justify-content-between">
                                    <div class="avatar me-3">
                                        <div class="avatar-initial bg-label-primary rounded">
                                            <i class="mdi mdi-trending-up mdi-24px"> </i>
                                        </div>
                                    </div>
                                    <div class="card-info p-3">
                                        <div class="d-flex align-items-center">
                                            <h3 class="mb-0 text-white">{{ Auth::user()->tasks()->count() }}</h3>
                                        </div>
                                        <p class="text-white">Your Tasks</p>
                                        <a href="{{ route('task.index') }}" class="btn btn-label-primary">Go To Tasks</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
