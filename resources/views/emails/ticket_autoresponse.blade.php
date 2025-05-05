<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; color: #333; }
        .container { max-width:600px; margin:auto; padding:20px; border:1px solid #eee; }
        h1 { color: #ff0055; }
        .ticket { background:#f9f9f9; padding:10px; margin:20px 0; }
        .btn { display:inline-block; padding:10px 20px; background:#ff0055; color:#fff; text-decoration:none; border-radius:5px; }
    </style>
</head>
<body>
<div class="container">
    <h1>Danke für Deine Nachricht!</h1>
    <p>Wir haben Dein Ticket erhalten. Deine Ticket‑Nummer lautet:</p>
    <div class="ticket"><strong>{{ $ticket->ticket_nr }}</strong></div>
    <p>Wir melden uns so schnell wie möglich bei Dir.</p>
    <p>– Dein ILLEGALACT Team</p>
</div>
</body>
</html>
