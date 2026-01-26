<!DOCTYPE html>
<html>
<head>
    <title>Prescription #{{ $prescription->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        h2 { text-align: center; }
        .details { margin-bottom: 20px; }
    </style>
</head>
<body>
    <h2>Doctor Prescription</h2>

    <div class="details">
        <strong>Patient:</strong> {{ $prescription->patient->patients_name }} <br>
        <strong>Date:</strong> {{ $prescription->created_at->format('d M Y') }}
    </div>

    <div class="medicines">
        <strong>Medicines & Instructions:</strong>
        <p>{!! nl2br(e($prescription->medicines)) !!}</p>
    </div>

    @if($prescription->notes)
    <div class="notes">
        <strong>Notes:</strong>
        <p>{!! nl2br(e($prescription->notes)) !!}</p>
    </div>
    @endif
</body>
</html>
