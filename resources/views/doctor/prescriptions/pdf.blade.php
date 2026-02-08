<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescription - {{ $prescription->id }}</title>
   <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 12px;
            color: #333;
            line-height: 1.6;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header */
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            border-radius: 10px 10px 0 0;
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .header p {
            font-size: 14px;
            margin: 3px 0;
        }

        /* Prescription Info Bar */
        .prescription-info {
            background-color: #f8f9fa;
            padding: 15px;
            border-left: 4px solid #667eea;
            margin-bottom: 20px;
        }

        .prescription-info p {
            margin: 5px 0;
            font-size: 11px;
        }

        .prescription-info strong {
            color: #667eea;
        }

        /* Patient & Doctor Info Section */
        .info-section {
            display: table;
            width: 100%;
            margin-bottom: 25px;
        }

        .info-box {
            display: table-cell;
            width: 50%;
            padding: 15px;
            vertical-align: top;
        }

        .info-box.patient {
            background-color: #e3f2fd;
            border-left: 4px solid #2196F3;
        }

        .info-box.doctor {
            background-color: #f3e5f5;
            border-left: 4px solid #9c27b0;
        }

        .info-box h3 {
            font-size: 14px;
            margin-bottom: 10px;
            color: #333;
            font-weight: bold;
        }

        .info-box p {
            margin: 5px 0;
            font-size: 11px;
        }

        .info-box .label {
            font-weight: bold;
            color: #555;
            display: inline-block;
            width: 100px;
        }

        /* Medicine Section */
        .medicine-section {
            margin-top: 30px;
        }

        .section-title {
            background-color: #667eea;
            color: white;
            padding: 12px 15px;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 15px;
            border-radius: 5px;
        }

        .medicine-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .medicine-table thead {
            background-color: #f8f9fa;
        }

        .medicine-table th {
            padding: 12px 10px;
            text-align: left;
            font-weight: bold;
            font-size: 11px;
            border-bottom: 2px solid #667eea;
            color: #333;
        }

        .medicine-table td {
            padding: 12px 10px;
            border-bottom: 1px solid #e0e0e0;
            font-size: 11px;
        }

        .medicine-table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .medicine-table tbody tr:hover {
            background-color: #f0f0f0;
        }

        .medicine-number {
            font-weight: bold;
            color: #667eea;
            width: 30px;
        }

        /* Notes Section */
        .notes-section {
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin-top: 20px;
            border-radius: 5px;
        }

        .notes-section h3 {
            font-size: 14px;
            margin-bottom: 10px;
            color: #856404;
            font-weight: bold;
        }

        .notes-section p {
            font-size: 11px;
            color: #856404;
            white-space: pre-wrap;
        }

        /* Signature Section */
        .signature-section {
            margin-top: 40px;
            text-align: right;
        }

        .signature-line {
            border-top: 2px solid #333;
            width: 250px;
            margin-left: auto;
            margin-top: 50px;
            padding-top: 5px;
        }

        .signature-line p {
            font-size: 11px;
            margin: 2px 0;
        }

        /* Footer */
        .footer {
            margin-top: 40px;
            padding-top: 15px;
            border-top: 2px solid #e0e0e0;
            text-align: center;
            font-size: 10px;
            color: #666;
        }

        .footer p {
            margin: 3px 0;
        }

        /* Watermark */
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 80px;
            color: rgba(0, 0, 0, 0.05);
            z-index: -1;
            font-weight: bold;
        }

        /* Page Break */
        .page-break {
            page-break-after: always;
        }

        /* Print Specific */
        @media print {
            body {
                margin: 0;
                padding: 0;
            }
        }
    </style> 
</head>
<body>
    <div class="watermark">PRESCRIPTION</div>
    
    <div class="container">
        {{-- Header --}}
        <div class="header">
            <h1>Medical Prescription</h1>
            <p>Professional Healthcare Services</p>
            <p>📞 Contact: +880-XXX-XXXXXX | 📧 Email: info@hospital.com</p>
        </div>

        {{-- Prescription Info Bar --}}
        <div class="prescription-info">
            <p><strong>Date Issued:</strong> {{ $prescription->created_at->format('d F Y, h:i A') }}</p>
            <p><strong>Appointment Date:</strong> {{ \Carbon\Carbon::parse($prescription->appointment->appointment_date)->format('d F Y') }}</p>
        </div>

        {{-- Patient & Doctor Info --}}
        <div class="info-section">
            <div class="info-box patient">
                <h3>👤 Patient Information</h3>
                <p><span class="label">Name:</span> {{ $prescription->appointment->full_name }}</p>
                <p><span class="label">Email:</span> {{ $prescription->appointment->email_address }}</p>
                <p><span class="label">Phone:</span> {{ $prescription->appointment->number }}</p>
                <p><span class="label">Specialty:</span> {{ $prescription->appointment->specialty->specialty_name ?? 'N/A' }}</p>
            </div>

            <div class="info-box doctor">
                <h3>👨‍⚕️ Doctor Information</h3>
                <p><span class="label">Name:</span> Dr. {{ $prescription->appointment->doctor->name ?? 'N/A' }}</p>
                <p><span class="label">Specialty:</span> {{ $prescription->appointment->specialty->specialty_name ?? 'N/A' }}</p>
            </div>
        </div>

        {{-- Medicines Section --}}
        <div class="medicine-section">
            <div class="section-title">💊 Prescribed Medicines</div>
            
            @if($prescription->medicines->count() > 0)
                <table class="medicine-table">
                    <thead>
                        <tr>
                            <th style="width: 30px;">#</th>
                            <th style="width: 30%;">Medicine Name</th>
                            <th style="width: 20%;">Dose</th>
                            <th style="width: 30%;">Time/Frequency</th>
                            <th style="width: 20%;">Duration</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($prescription->medicines as $index => $medicine)
                        <tr>
                            <td class="medicine-number">{{ $index + 1 }}</td>
                            <td><strong>{{ $medicine->name }}</strong></td>
                            <td>{{ $medicine->dose }}</td>
                            <td>{{ $medicine->time }}</td>
                            <td>{{ $medicine->duration }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p style="text-align: center; padding: 20px; color: #999;">No medicines prescribed</p>
            @endif
        </div>

        {{-- Notes Section --}}
        @if($prescription->notes)
        <div class="notes-section">
            <h3>📝 Additional Notes & Instructions</h3>
            <p>{{ $prescription->notes }}</p>
        </div>
        @endif

    </div>
</body>
</html>