<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>جزئیات سرویس VPN</title>

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/show.css') }}">

</head>

<body>

    <div class="container">

        <div class="vpn-card">

            <div class="vpn-header">
                جزئیات سرویس VPN
            </div>

            <div class="vpn-body">

                <!-- نام سرویس -->
                <div class="info-row">
                    <div class="info-title">
                        نام سرویس
                    </div>

                    <div class="info-value">
                        {{ $access_key->name }}
                    </div>
                </div>


                <!-- ترافیک -->
                <div class="info-row">
                    <div class="info-title">
                        ترافیک
                    </div>

                    <div class="info-value">
                        @if($access_key->limit_traffic)
                        {{ convertEnglishToPersian(number_format($access_key->limit_traffic / 1000  / 1000 / 1000)) }} / {{ convertEnglishToPersian(number_format($access_key->used_traffic / 1000  / 1000 / 1000,2)) }} GB

                        @else
                        ∞ / {{ convertEnglishToPersian(number_format($access_key->used_traffic / 1000  / 1000 / 1000,2)) }} GB
                        @endif

                    </div>
                </div>


                <!-- تاریخ -->
                <div class="info-row">
                    <div class="info-title">
                        تاریخ انقضا
                    </div>

                    <div class="info-value">

                        @if($access_key->expire_at)
                        {{ jalaliDate($access_key->expire_at) }}
                        @else
                        ∞
                        @endif

                    </div>
                </div>


                <!-- وضعیت -->
                <div class="info-row">

                    <div class="info-title">
                        وضعیت
                    </div>

                    <div class="info-value">

                        @switch($access_key->status)
                        @case('active')
                        <span class="status status-active">
                            فعال
                        </span>
                        @break
                        @case('expired')
                        <span class="status status-expired">
                            منقضی شده
                        </span>
                        @break
                        @case('limited')
                        <span class="status status-limit">
                            اتمام حجم
                        </span>
                        @break
                        @case('deleted')
                        <span class="status status-deleted">
                            حذف شده
                        </span>
                        @break
                        @endswitch
                    </div>

                </div>


                <!-- کلید -->
                <div class="info-row">

                    <div class="info-title">
                        کلید اتصال (Key Secret)
                    </div>

                    <div class="info-value">

                        <div class="key-box">
                            @if($access_key->key_secret)

                            {{ $access_key->key_secret }}

                            @else
                            <div class="text-muted">
                                کلیدی وجود ندارد.
                            </div>
                            @endif
                        </div>

                    </div>

                </div>


                <!-- دکمه -->
                <div class="mt-4">

                    @if($access_key->key_secret)

                    <a href="{{ $access_key->key_secret }}#solo"
                        class="btn btn-block btn-outline-connect">

                        اتصال در Outline

                    </a>


                    @else
                    <div class="text-muted">
                        <button class="btn btn-secondary btn-block" disabled>
                            کلید اتصال وجود ندارد
                        </button>
                    </div>
                    @endif
                </div>

            </div>

        </div>

    </div>

</body>

</html>
