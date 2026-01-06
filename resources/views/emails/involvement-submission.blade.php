<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Outfit', sans-serif; line-height: 1.6; color: #333; background-color: #f9fafb; margin: 0; padding: 0; }
        .wrapper { width: 100%; background-color: #f9fafb; padding: 40px 0; }
        .container { max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 40px; border: 1px solid #0b3d32; border-radius: 20px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); }
        .logo { margin-bottom: 30px; text-align: center; }
        .logo h1 { color: #0b3d32; margin: 0; font-size: 32px; letter-spacing: -1px; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #f3f4f6; padding-bottom: 20px; }
        .header h2 { color: #0b3d32; margin: 0 0 10px 0; font-size: 24px; }
        .badge { display: inline-block; padding: 6px 16px; background-color: #13a759; color: white; border-radius: 50px; font-size: 12px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; }
        
        .data-grid { display: table; width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        .row { display: table-row; border-bottom: 1px solid #f3f4f6; }
        .label { display: table-cell; padding: 12px 0; color: #6b7280; font-weight: bold; width: 140px; vertical-align: top; }
        .value { display: table-cell; padding: 12px 0; color: #111827; font-weight: 500; }
        
        .message-box { background-color: #f9fafb; border-radius: 12px; padding: 20px; margin-top: 10px; border: 1px solid #e5e7eb; }
        .message-label { font-size: 11px; text-transform: uppercase; color: #6b7280; letter-spacing: 1px; font-weight: bold; margin-bottom: 8px; }
        .message-content { white-space: pre-wrap; color: #374151; }

        .actions { text-align: center; margin-top: 40px; }
        .btn { display: inline-block; padding: 12px 32px; background-color: #0b3d32; color: #ffffff; text-decoration: none; border-radius: 50px; font-weight: bold; font-size: 14px; transition: background-color 0.2s; }
        .btn:hover { background-color: #13a759; }

        .footer { margin-top: 40px; text-align: center; font-size: 12px; color: #9ca3af; border-top: 1px solid #f3f4f6; padding-top: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="logo">
                <h1>ACEF</h1>
            </div>

            <div class="header">
                <h2>New Website Submission</h2>
                <span class="badge">{{ $data['type'] }}</span>
            </div>
            
            <div class="data-grid">
                @if($data['type'] === 'volunteer')
                    <div class="row">
                        <div class="label">Name</div>
                        <div class="value">{{ $data['first_name'] }} {{ $data['last_name'] }}</div>
                    </div>
                    <div class="row">
                        <div class="label">Email</div>
                        <div class="value"><a href="mailto:{{ $data['email'] }}" style="color: #13a759; text-decoration: none;">{{ $data['email'] }}</a></div>
                    </div>
                    <div class="row">
                        <div class="label">Location</div>
                        <div class="value">{{ $data['location'] }}</div>
                    </div>
                    <div class="row">
                        <div class="label">Interests</div>
                        <div class="value">{{ $data['interest'] }}</div>
                    </div>
                    <div class="row">
                        <div class="label">Motivation</div>
                        <div class="value">{{ $data['motivation'] }}</div>
                    </div>
                @elseif($data['type'] === 'partner')
                    <div class="row">
                        <div class="label">Organization</div>
                        <div class="value">{{ $data['org_name'] }}</div>
                    </div>
                    <div class="row">
                        <div class="label">Website</div>
                        <div class="value"><a href="{{ $data['website'] }}" target="_blank" style="color: #13a759;">{{ $data['website'] }}</a></div>
                    </div>
                    <div class="row">
                        <div class="label">Contact Person</div>
                        <div class="value">{{ $data['contact_person'] }}</div>
                    </div>
                    <div class="row">
                        <div class="label">Email</div>
                        <div class="value"><a href="mailto:{{ $data['email'] }}" style="color: #13a759; text-decoration: none;">{{ $data['email'] }}</a></div>
                    </div>
                    <div class="row">
                        <div class="label">Type</div>
                        <div class="value">{{ $data['partnership_type'] }}</div>
                    </div>
                @elseif($data['type'] === 'collaborate')
                    <div class="row">
                        <div class="label">Name</div>
                        <div class="value">{{ $data['name'] }}</div>
                    </div>
                    <div class="row">
                        <div class="label">Email</div>
                        <div class="value"><a href="mailto:{{ $data['email'] }}" style="color: #13a759; text-decoration: none;">{{ $data['email'] }}</a></div>
                    </div>
                    <div class="row">
                        <div class="label">Role</div>
                        <div class="value">{{ $data['role'] }}</div>
                    </div>
                    <div class="row">
                        <div class="label">Type</div>
                        <div class="value">{{ $data['collaboration_type'] }}</div>
                    </div>
                @endif
            </div>

            @if(isset($data['message']) && $data['message'])
            <div class="message-box">
                <div class="message-label">Additional Message</div>
                <div class="message-content">{{ $data['message'] }}</div>
            </div>
            @endif

            <div class="actions">
                <a href="mailto:{{ $data['email'] }}?subject=Re: ACEF Involvement Application" class="btn">Reply to {{ $data['first_name'] ?? $data['name'] ?? 'Sender' }}</a>
            </div>

            <div class="footer">
                &copy; {{ date('Y') }} Africa Climate & Environment Foundation<br>
                Admin Notification System
            </div>
        </div>
    </div>
</body>
</html>
