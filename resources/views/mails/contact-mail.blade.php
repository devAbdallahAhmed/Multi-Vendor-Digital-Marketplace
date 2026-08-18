<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Email</title>
</head>

<body>
    <div style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
        <h2>New Contact Message</h2>
        <p><strong>From:</strong> {{ $name }}</p>
        <p><strong>Subject:</strong> {{ $subjectLine }}</p>
        <hr>
        <p><strong>Message:</strong></p>
        <p>{{ $content }}</p>
    </div>
</body>

</html>
