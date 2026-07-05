@extends('layouts.master')

@section('head-tag')
<title>کلید های دسترسی</title>
@endsection

@section('content')



<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    کلید های دسترسی
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('app.access-key.create') }}" class="btn btn-info btn-sm">ایجاد کلید دسترسی جدید</a>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>نام </th>
                            <th>توضیحات</th>
                            <th>ترافیک</th>
                            <th>تاریخ انقضا</th>
                            <th>وضعیت</th>
                            <th>تاریخ حذف کلید</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($access_keys as $key => $access_key)

                        <tr>
                            <th>{{ $key + 1 }}</th>
                            <td>{{ $access_key->name }}</td>
                            <td>{{ $access_key->description ?? '-' }}</td>
                            <td>
                                @if($access_key->limit_traffic)
                                {{ convertEnglishToPersian(number_format($access_key->limit_traffic / 1000  / 1000 / 1000)) }} / {{ convertEnglishToPersian(number_format($access_key->used_traffic / 1000  / 1000 / 1000,2)) }} GB

                                @else
                                ∞ / {{ convertEnglishToPersian(number_format($access_key->used_traffic / 1000  / 1000 / 1000,2)) }} GB
                                @endif
                            </td>
                            <td>{{ $access_key->expire_at ? jalaliDate($access_key->expire_at) : '-' }}</td>
                            <td>
                                @switch($access_key->status)
                                @case('active')
                                <span class="badge badge-success">فعال</span>
                                @break
                                @case('expired')
                                <span class="badge badge-warning">منقضی شده</span>
                                @break
                                @case('limited')
                                <span class="badge badge-warning">اتمام حجم</span>
                                @break
                                @case('deleted')
                                <span class="badge badge-danger">حذف شده</span>
                                @break
                                @endswitch
                            </td>
                            <td>{{ $access_key->deleted_at ? jalaliDate($access_key->deleted_at) : '-' }}</td>

                            <td class="width-22-rem text-left">
                                @if ($access_key->status === 'active')
                                <form class="d-inline"
                                    action="{{ route('app.access-key.delete', $access_key->id) }}"
                                    method="post">
                                    @csrf
                                    {{ method_field('delete') }}
                                    <button class="btn btn-danger btn-sm delete" type="submit"><i
                                            class="fa fa-trash-alt"></i> حذف</button>
                                </form>
                                @endif
                                <a href="{{ route('show',$access_key->public_id) }}" class="btn btn-primary btn-sm text-white"><i
                                        class="fa fa-eye"></i> نمایش</a>
                            </td>
                        </tr>

                        @endforeach


                    </tbody>
                </table>
            </section>

        </section>
    </section>
</section>

@endsection


@section('script')

@include('alerts.sweetalert.delete-confirm', ['className' => 'delete'])


@endsection