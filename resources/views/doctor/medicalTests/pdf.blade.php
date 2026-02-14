<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Medical Test Invoice</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            color: #333;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #0d6efd;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .title {
            font-size: 22px;
            font-weight: bold;
            color: #0d6efd;
        }

        .section {
            margin-bottom: 15px;
        }

        .box {
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table th {
            background: #0d6efd;
            color: white;
            padding: 8px;
            text-align: left;
        }

        table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 11px;
            color: #777;
        }

        .right {
            text-align: right;
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <div class="header">
        <div class="title">Medical Test Report</div>
        <div>Report ID: MT-{{ str_pad($medical_test->id, 6, '0', STR_PAD_LEFT) }}</div>
    </div>

    <!-- PATIENT INFO -->
    <div class="section box">
        <strong>Patient Information</strong><br><br>

        Name: {{ $medical_test->patients_name }} <br>
        Phone: {{ $medical_test->patients_phone }} <br>
        Problem: {{ $medical_test->problem ?? 'N/A' }}
    </div>

    <!-- TEST TABLE -->
    <table>
        <thead>
            <tr>
                <th>Test Name</th>
                <th class="right">Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $medical_test->test_name }}</td>
                <td class="right">{{ number_format($medical_test->amount, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <!-- TOTAL -->
    <table style="margin-top:20px;">
        <tr>
            <td style="width:70%"></td>
            <td class="right">
                <strong>Total: {{ number_format($medical_test->amount, 2) }}</strong>
            </td>
        </tr>
    </table>

    <!-- FOOTER -->
    <div class="footer">
        Generated on {{ now()->format('d M Y, h:i A') }} <br>
        Hospital Management System
    </div>

</body>
</html>
