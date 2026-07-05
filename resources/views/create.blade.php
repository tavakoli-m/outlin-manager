@extends('layouts.master')

@section('head-tag')
<title>ایجاد کلید دسترسی جدید</title>
<link rel="stylesheet" href="{{ asset('assets/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection

@section('content')



<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    یجاد کلید دسترسی جدید
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('app.access-key.index') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{ route('app.access-key.store') }}" method="post" enctype="multipart/form-data" id="form">
                    @csrf
                    <section class="row">

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="name">نام کلید دسترسی</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control form-control-sm" id="name">
                            </div>
                            @error('name')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="description">توضیحات</label>
                                <input type="description" name="description" value="{{ old('description') }}" class="form-control form-control-sm" id="description">
                            </div>
                            @error('description')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="limit_traffic">محدود ترافیک (GB) (اختیاری)</label>
                                <input type="text" name="limit_traffic" value="{{ old('limit_traffic') }}" class="form-control form-control-sm" id="limit_traffic">
                            </div>
                            @error('limit_traffic')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                            @enderror
                        </section>


                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">تاریخ انقضا</label>
                                <input type="text" name="expire_at" id="expire_at" class="form-control form-control-sm d-none">
                                <input type="text" id="expire_at_view" class="form-control form-control-sm" value="{{ old('expire_at') ? date('Y-m-d H:i:s',substr(old('expire_at'),0,10)) : date('Y-m-d H:i:s') }}">
                            </div>
                            @error('expire_at')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                            @enderror
                        </section>
                        <section class="col-12">
                            <button class="btn btn-primary btn-sm">ثبت</button>
                        </section>
                    </section>
                </form>
            </section>

        </section>
    </section>
</section>

@endsection


@section('script')

<script src="{{ asset('assets/jalalidatepicker/persian-date.min.js') }}"></script>
<script src="{{ asset('assets/jalalidatepicker/persian-datepicker.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#expire_at_view').persianDatepicker({
            format: 'YYYY/MM/DD H:m:s',
            altField: '#expire_at',
            timePicker: {
                enabled: true
            }
        })
    });
</script>

@endsection