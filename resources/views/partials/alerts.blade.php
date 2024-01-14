@if (session('success'))
    <div class="alert alert-success">
        ثبت موفق عملیات
    </div>
@endif

@if(session('failed'))
    <div class="alert alert-danger">
        ثبت ناموفق عملیات
    </div>
@endif