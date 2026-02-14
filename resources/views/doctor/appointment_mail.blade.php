<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Appointment Confirmation</title>
</head>
<body style="font-family: Arial, sans-serif;">

    <h2>Appointment Confirmation</h2>

    <p>Dear {{ $appointment->full_name }},</p>

    <p>Your appointment has been successfully scheduled.</p>

    <hr>

    <h4>Appointment Details:</h4>

    <p><strong>Doctor:</strong> {{ $appointment->doctor->name ?? 'N/A' }}</p>

    <p><strong>Specialty:</strong> {{ $appointment->specialty->name ?? 'N/A' }}</p>

    <p><strong>Date:</strong> {{ $appointment->appointment_date }}</p>

    <p><strong>Time:</strong> {{ $appointment->appointment_time }}</p>

    <p><strong>Fee:</strong> {{ $appointment->fee }}</p>

    <p><strong>Status:</strong> {{ $appointment->status }}</p>

    <hr>

    <p>If you have any questions, please contact us.</p>

    <p>Thank you,<br>
    Hospital Management Team</p>

</body>
</html>
