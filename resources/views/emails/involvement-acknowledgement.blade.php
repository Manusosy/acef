<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Outfit', sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 40px; border: 1px solid #134712; border-radius: 20px; text-align: center; }
        .logo { margin-bottom: 30px; }
        .logo img { height: 60px; }
        .heading { font-size: 24px; color: #134712; font-weight: bold; margin-bottom: 20px; }
        .text { margin-bottom: 30px; color: #555; }
        .button { display: inline-block; padding: 12px 30px; background-color: #134712; color: #ffffff; text-decoration: none; border-radius: 50px; font-weight: bold; }
        .footer { margin-top: 40px; font-size: 12px; color: #999; border-top: 1px solid #eee; padding-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
           <h1>ACEF</h1>
        </div>

        <div class="heading">
            Thank you for reaching out!
        </div>
        
        <div class="text">
            @if($data['type'] === 'volunteer')
                Dear {{ $data['first_name'] }},<br><br>
                Thank you for your interest in volunteering with ACEF. We have received your application and are excited about your motivation to join our cause.
            @elseif($data['type'] === 'partner')
                Hello {{ $data['contact_person'] }},<br><br>
                Thank you for inquiring about a partnership with ACEF. We have received your organization's details and will review your proposal.
            @elseif($data['type'] === 'collaborate')
                Dear {{ $data['name'] }},<br><br>
                Thank you for reaching out to collaborate with us. We have received your message and are thrilled to explore potential synergies.
            @endif
            <br><br>
            Our team is currently reviewing your submission and will get back to you shortly at this email address.
        </div>

        <a href="{{ url('/') }}" class="button">Return to Website</a>

        <div class="footer">
            &copy; {{ date('Y') }} Africa Climate & Environment Foundation. All rights reserved.
        </div>
    </div>
</body>
</html>
