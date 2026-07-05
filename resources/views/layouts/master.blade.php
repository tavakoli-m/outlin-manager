<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.head-tag')
    @yield('head-tag')

</head>

<body dir="rtl">

    @include('layouts.header')



    <section class="body-container">

        @include('layouts.sidebar')


        <section id="main-body" class="main-body">

            @yield('content')

        </section>
    </section>


    @include('layouts.script')
    @yield('script')

    
    @include('alerts.sweetalert.error')
    @include('alerts.sweetalert.success')


</body>
</html>
