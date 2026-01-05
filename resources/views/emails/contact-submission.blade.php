<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #eee; border-radius: 10px; }
        .header { border-bottom: 2px solid #134712; padding-bottom: 10px; margin-bottom: 20px; }
        .field { margin-bottom: 15px; }
        .label { font-weight: bold; color: #134712; }
        .footer { margin-top: 30px; font-size: 12px; color: #777; border-top: 1px solid #eee; padding-top: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>New Contact Inquiry</h2>
        </div>
        
        <div class="field">
            <div class="label">Topic:</div>
            <div>{{ $data['topic'] }}</div>
        </div>
        
        <div class="field">
            <div class="label">Name:</div>
            <div>{{ $data['name'] }}</div>
        </div>
        
        <div class="field">
            <div class="label">Email:</div>
            <div>{{ $data['email'] }}</div>
        </div>
        
        @if(!empty($data['organization']))
        <div class="field">
            <div class="label">Organization:</div>
            <div>{{ $data['organization'] }}</div>
        </div>
        @endif
        
        <div class="field">
            <div class="label">Message:</div>
            <div style="white-space: pre-wrap;">{{ $data['message'] }}</div>
        </div>

        <div class="footer">
            Sent from ACEF Website Contact Form
        </div>
    </div>
</body>
</html>
