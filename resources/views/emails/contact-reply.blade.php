<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Response to your inquiry - Furnio Support</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
            color: #333333;
            -webkit-text-size-adjust: none;
        }
        .email-wrapper {
            width: 100%;
            background-color: #f4f6f8;
            padding: 40px 0;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border: 1px solid #e5e7eb;
        }
        .email-header {
            background-color: #C06B1F;
            color: #ffffff;
            padding: 24px 30px;
            text-align: center;
        }
        .email-header h1 {
            margin: 0;
            font-size: 22px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        .email-header p {
            margin: 6px 0 0;
            font-size: 14px;
            opacity: 0.9;
        }
        .email-body {
            padding: 30px;
        }
        .reply-box {
            background-color: #ffffff;
            border-left: 4px solid #C06B1F;
            padding: 16px 20px;
            border-radius: 0 6px 6px 0;
            font-size: 15px;
            line-height: 1.6;
            color: #1f2937;
            white-space: pre-wrap;
            margin-bottom: 24px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            border: 1px solid #e5e7eb;
            border-left-width: 4px;
            border-left-color: #C06B1F;
        }
        .original-message-card {
            background-color: #f9fafb;
            border: 1px dashed #d1d5db;
            border-radius: 6px;
            padding: 16px 20px;
            margin-top: 24px;
        }
        .original-title {
            font-weight: 600;
            font-size: 13px;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }
        .original-text {
            font-size: 14px;
            color: #4b5563;
            font-style: italic;
            line-height: 1.5;
            white-space: pre-wrap;
        }
        .email-footer {
            background-color: #f9fafb;
            padding: 20px 30px;
            text-align: center;
            font-size: 12px;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-container">
            <div class="email-header">
                <h1>FURNIO</h1>
                <p>Customer Support Response</p>
            </div>

            <div class="email-body">
                <p style="font-size: 16px; margin-bottom: 16px; color: #1f2937;">Dear <strong>{{ $contact->name }}</strong>,</p>

                <p style="font-size: 15px; margin-bottom: 20px; color: #4b5563;">Thank you for contacting Furnio Support. Here is our response to your inquiry:</p>

                <div class="reply-box">
                    {{ $replyMessage }}
                </div>

                <p style="font-size: 14px; color: #4b5563;">If you have any further questions or require additional assistance, please feel free to reply to this email.</p>

                <div class="original-message-card">
                    <div class="original-title">Your Original Inquiry (Submitted {{ $contact->created_at ? $contact->created_at->format('M j, Y, g:i A') : 'recently' }}):</div>
                    @if($contact->subject)
                        <p style="margin: 0 0 6px; font-weight: 600; font-size: 14px; color: #374151;">Subject: {{ $contact->subject }}</p>
                    @endif
                    <div class="original-text">"{{ $contact->message }}"</div>
                </div>
            </div>

            <div class="email-footer">
                <p style="margin: 0 0 4px; font-weight: 600;">Furnio Customer Support Team</p>
                <p style="margin: 0;">123 Luxury Street, Design District, Mumbai, India | furnio@gmail.com</p>
            </div>
        </div>
    </div>
</body>
</html>
