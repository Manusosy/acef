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
        .type-badge { display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: bold; text-transform: uppercase; background: #e8f5e9; color: #134712; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>New Involvement Application</h2>
            <div class="type-badge">{{ $data['type'] }}</div>
        </div>
        
        @if($data['type'] === 'volunteer')
            <div class="field">
                <div class="label">Name:</div>
                <div>{{ $data['first_name'] }} {{ $data['last_name'] }}</div>
            </div>
            <div class="field">
                <div class="label">Location:</div>
                <div>{{ $data['location'] }}</div>
            </div>
            <div class="field">
                <div class="label">Interests:</div>
                <div>{{ $data['interest'] }}</div>
            </div>
            <div class="field">
                <div class="label">Motivation:</div>
                <div style="white-space: pre-wrap;">{{ $data['motivation'] }}</div>
            </div>
        @elseif($data['type'] === 'partner')
            <div class="field">
                <div class="label">Organization:</div>
                <div>{{ $data['org_name'] }}</div>
            </div>
            <div class="field">
                <div class="label">Website:</div>
                <div>{{ $data['website'] }}</div>
            </div>
            <div class="field">
                <div class="label">Contact Person:</div>
                <div>{{ $data['contact_person'] }}</div>
            </div>
            <div class="field">
                <div class="label">Partnership Type:</div>
                <div>{{ $data['partnership_type'] }}</div>
            </div>
        @elseif($data['type'] === 'collaborate')
            <div class="field">
                <div class="label">Name:</div>
                <div>{{ $data['name'] }}</div>
            </div>
            <div class="field">
                <div class="label">Role:</div>
                <div>{{ $data['role'] }}</div>
            </div>
            <div class="field">
                <div class="label">Collaboration Type:</div>
                <div>{{ $data['collaboration_type'] }}</div>
            </div>
        @endif

        <div class="field">
            <div class="label">Email:</div>
            <div>{{ $data['email'] }}</div>
        </div>
        
        <div class="field">
            <div class="label">Message:</div>
            <div style="white-space: pre-wrap;">{{ $data['message'] ?? 'N/A' }}</div>
        </div>

        <div class="footer">
            Sent from ACEF Website Get Involved Form
        </div>
    </div>
</body>
</html>
