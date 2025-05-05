<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; color: #333; }
        .container { max-width:600px; margin:auto; padding:20px; }
        .header { background:#ff0055; color:#fff; padding:10px; }
        .content { margin-top:20px; }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Antwort zu Ticket {{ $ticket->ticket_nr }}</h1>
    </div>
    <div class="content">
        <p>Hallo {{ $ticket->name }},</p>
        <p>hier unsere Antwort auf Deine Anfrage:</p>
        <blockquote style="background:#f9f9f9;padding:10px;border-left:4px solid #ff0055;">
            {!! nl2br(e($ticket->response)) !!}
        </blockquote>
        <p>Vielen Dank für Deine Geduld.</p>
        <p>– Dein ILLEGALACT Team</p>
    </div>
</div>
</body>
</html>
