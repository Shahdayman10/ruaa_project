@extends('layouts.app')

@section('title', 'لوحة تحكم الطالب')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">
                <i class="bi bi-person-circle me-2"></i>
                مرحباً {{ $student->name }}
            </h2>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <i class="bi bi-book display-4 text-primary mb-3"></i>
                    <h5>المواد الدراسية</h5>
                    <p class="text-muted">عرض المواد المسجل بها</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <i class="bi bi-clipboard-check display-4 text-success mb-3"></i>
                    <h5>الواجبات</h5>
                    <p class="text-muted">متابعة الواجبات والمهام</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
