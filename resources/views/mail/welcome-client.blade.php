<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <meta http-equiv="X-UA-Compatible" content="ie=edge"> --}}
    <title>Chào mừng khách hàng mới!</title>
    <style>
        .container {
            height: 100vh;
        }

        .d-flex {
            display: flex !important;
        }

        .flex-col {
            flex-direction: column;
        }

        .flex-row {
            flex-direction: row;
        }

        .justify-content-center {
            display: flex;
            justify-content: center !important;
        }

        .align-items-center {
            align-items: center !important;
        }

        .justify-items-center {
            justify-items: center
        }

        .align-self-center {
            align-self: center;
        }

        .text-center {
            text-align: center
        }

        .mt-5 {
            margin-top: 5rem;
        }

        .mb-16px {
            margin-bottom: 16px;
        }

        table {
            border-collapse: collapse;
            color: #777;
        }

        .text__main-color {
           color : #075588; 
        }

        .bg__main-color {
            background-color: #075588;
        }


        table,
        th,
        td {
            border: 1px solid #dee2e6;
        }

        .bg__header-table {
            background-color: #f4f4f4;
        }

        th,
        td {
            padding: 6px 8px;
        }

        .text-success {
            color: forestgreen;
        }

        .text-white {
            color: #fff !important;
        }

        .bg__body-color {
            background-color: #eceef1;
        }

        .bg-white {
            background-color: white;
        }

        .rounded-1 {
            border-radius: .25rem;
        }

        .padding-1 {
            padding: 24px;
        }

        .remove-decoration {
            text-decoration: none;
        }

        .position-relative {
            position: relative;
        }

        .position-absolute {
            position: absolute;
        }

        .position-center-x {
            left: 50%;
            transform: translateX(-50%);
        }

        .mt-0 {
            margin-top: 0 !important;
        }

        .mt-1 {
            margin-top: .25rem !important;
        }

        .mb-1 {
            margin-bottom: .25rem !important;
        }

        .mt-2 {
            margin-top: .5rem !important;
        }

        .mt-3 {
            margin-top: .75rem !important;
        }

        .my-3 {
            margin-top: .75rem !important;
            margin-bottom: .75rem !important;
        }

        .pt-0 {
            padding-top: 0 !important;
        }

        .pt-1 {
            padding-top: .25rem !important;
        }

        .pt-2 {
            padding-top: .5rem !important;
        }

        .pt-3 {
            padding-top: .75rem !important;
        }

        .py-3 {
            padding-top: .75rem !important;
            padding-bottom: .75rem !important;
        }

        .rounded-1 {
            border-radius: .25rem !important;
        }

        .d-inline-block {
            display: inline-block;
        }

        .w-100 {
            width: 100% !important;
        }

        .h-content {
            height: 650px !important;
        }

        .w-content {
            width: 900px !important;
        }
    </style>
</head>

<body class="bg__body-color">
    <div class="d-flex justify-content-center align-items-center text-center w-100 h-content">
        <div>
            <h1 class="text__main-color text-center">THE COLLECTION</h1>
            <div class="rounded-1 bg-white padding-1 text-center">
                <h1 class="mt-0">Email chào mừng</h1>
                <p class="mb-1">Chúc mừng {{ $userInfo['name'] }} đã đăng ký tài khoản thành công!</p>
                <p class="mt-1">Bấm vào nút bên dưới để đăng nhập tài khoản tại The Collection</p>
                <a href="{{ route('login') }}" style="padding: 15px;" class="bg__main-color rounded-1 remove-decoration d-inline-block text-white">Đăng nhập</a>
            </div>
        </div>
    </div>
</body>

</html>
