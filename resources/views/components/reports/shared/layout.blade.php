<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

    <meta charset="utf-8">

    <style>
        @page {
            size: A4;
            margin: 10mm;
        }

        * {
            box-sizing: border-box;
        }

        body {
            direction: rtl;
            font-family: "IBM Plex Sans Arabic", sans-serif;
            font-size: 12px;
            color: #111827;
            margin: 0;
            padding: 0;
            background: white;
        }

        .page {
            width: 100%;
            min-height: 277mm;
        }

        .page-break {
            page-break-after: always;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px 7px;
            vertical-align: middle;
        }

        th {
            background: #f3f4f6;
            font-weight: 700;
        }

        .label {
            background: #f8f8f8;
            font-weight: 600;
            width: 20%;
        }

        .value {
            background: #fff;
        }

        .ltr {
            direction: ltr;
            text-align: left;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .title {
            font-size: 18px;
            font-weight: bold;
        }

        .subtitle {
            font-size: 10px;
            color: #555;
        }
    </style>

</head>

<body>

    {{ $slot }}

</body>

</html>
