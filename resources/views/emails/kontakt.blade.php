<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontaktanfrage</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #272a2e; color: white; padding: 20px; border-radius: 8px 8px 0 0; }
        .content { background: #f5f5f5; padding: 20px; border: 1px solid #ddd; border-top: none; border-radius: 0 0 8px 8px; }
        .field { margin-bottom: 16px; }
        .label { font-weight: bold; color: #555; font-size: 12px; text-transform: uppercase; }
        .value { margin-top: 4px; }
        .message { white-space: pre-wrap; background: white; padding: 16px; border-radius: 4px; border: 1px solid #e0e0e0; }
        .footer { margin-top: 20px; font-size: 12px; color: #888; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 style="margin: 0; font-size: 1.25rem;">Kontaktanfrage über Website</h1>
            <p style="margin: 8px 0 0 0; opacity: 0.9;">Ansprechpartner: {{ $data['empfaenger_label'] }}</p>
        </div>
        <div class="content">
            @if($data['name'])
                <div class="field">
                    <div class="label">Name</div>
                    <div class="value">{{ $data['name'] }}</div>
                </div>
            @endif

            <div class="field">
                <div class="label">E-Mail</div>
                <div class="value">{{ $data['email'] }}</div>
            </div>

            @if($data['telefon'])
                <div class="field">
                    <div class="label">Telefon</div>
                    <div class="value">{{ $data['telefon'] }}</div>
                </div>
            @endif

            <div class="field">
                <div class="label">Nachricht</div>
                <div class="value message">{{ $data['nachricht'] }}</div>
            </div>

            <div class="footer">
                Diese E-Mail wurde über das Kontaktformular der Website {{ config('app.url') }} gesendet.
                Sie können direkt auf diese E-Mail antworten.
            </div>
        </div>
    </div>
</body>
</html>
