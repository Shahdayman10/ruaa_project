@extends('layouts.app')

@section('title', 'لوحة تحكم المعلم')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">
                <i class="bi bi-person-badge me-2"></i>
                مرحباً {{ $teacher->name }}
            </h2>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <i class="bi bi-journal-text display-4 text-info mb-3"></i>
                    <h5>إدارة المواد</h5>
                    <p class="text-muted">إضافة وتعديل المواد الدراسية</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <i class="bi bi-people display-4 text-warning mb-3"></i>
                    <h5>الطلاب</h5>
                    <p class="text-muted">متابعة الطلاب والدرجات</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <i class="bi bi-clipboard-plus display-4 text-success mb-3"></i>
                    <h5>الواجبات</h5>
                    <p class="text-muted">إنشاء وإدارة الواجبات</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
