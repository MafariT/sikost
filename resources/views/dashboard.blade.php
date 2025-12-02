@extends('layouts.layout_utama')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="fw-bold text-dark">Dashboard</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                    <h5 class="fw-bold text-primary">Status Akun</h5>
                </div>
                <div class="card-body p-4">
                    <div class="alert alert-success d-flex align-items-center" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        <div>
                            login sebagai 
                            <span class="badge bg-secondary text-uppercase">{{ Auth::user()->role }}</span>
                        </div>
                    </div>
                    <p class="mt-3">
                        masuk dengan email: <strong>{{ Auth::user()->email }}</strong>
                    </p>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection