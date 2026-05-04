<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Support Ticket Created</title>
</head>

<body style="margin: 0; padding: 0; background-color: #f4f6f8; font-family: Arial, Helvetica, sans-serif; color: #333333;">

    {{-- Hidden preview text shown in some email inboxes --}}
    <div style="display: none; max-height: 0; overflow: hidden; color: transparent;">
        Your support ticket has been created successfully. Reference: {{ $ticket->ref }}
    </div>

    {{-- Main email container --}}
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f4f6f8; padding: 30px 0;">
        <tr>
            <td align="center">

                {{-- Email card --}}
                <table width="650" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border: 1px solid #dddddd; border-radius: 8px; overflow: hidden;">

                    {{-- Header --}}
                    <tr>
                        <td style="background-color: #198754; padding: 22px 28px;">
                            <h2 style="margin: 0; color: #ffffff; font-size: 22px; font-weight: bold;">
                                Support Ticket Created
                            </h2>
                        </td>
                    </tr>

                    {{-- Body --}}
                    <tr>
                        <td style="padding: 28px;">

                            <p style="font-size: 15px; margin-top: 0;">
                                Hi {{ $ticket->customer_name }},
                            </p>

                            <p style="font-size: 15px; line-height: 1.6;">
                                Your support ticket has been created successfully. Please keep your reference number safe, as you can use it later to check your ticket status.
                            </p>

                            {{-- Ticket details --}}
                            <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse; margin-top: 20px; font-size: 14px;">
                                <tr>
                                    <td style="padding: 12px; border: 1px solid #dddddd; background-color: #f8f9fa; font-weight: bold; width: 35%;">
                                        Reference
                                    </td>
                                    <td style="padding: 12px; border: 1px solid #dddddd;">
                                        {{ $ticket->ref }}
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding: 12px; border: 1px solid #dddddd; background-color: #f8f9fa; font-weight: bold;">
                                        Customer Name
                                    </td>
                                    <td style="padding: 12px; border: 1px solid #dddddd;">
                                        {{ $ticket->customer_name }}
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding: 12px; border: 1px solid #dddddd; background-color: #f8f9fa; font-weight: bold;">
                                        Email
                                    </td>
                                    <td style="padding: 12px; border: 1px solid #dddddd;">
                                        {{ $ticket->email }}
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding: 12px; border: 1px solid #dddddd; background-color: #f8f9fa; font-weight: bold;">
                                        Phone
                                    </td>
                                    <td style="padding: 12px; border: 1px solid #dddddd;">
                                        {{ $ticket->phone ?: 'N/A' }}
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding: 12px; border: 1px solid #dddddd; background-color: #f8f9fa; font-weight: bold;">
                                        Subject
                                    </td>
                                    <td style="padding: 12px; border: 1px solid #dddddd;">
                                        {{ $ticket->subject }}
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding: 12px; border: 1px solid #dddddd; background-color: #f8f9fa; font-weight: bold;">
                                        Description
                                    </td>
                                    <td style="padding: 12px; border: 1px solid #dddddd; line-height: 1.5;">
                                        {!! nl2br(e($ticket->description)) !!}
                                    </td>
                                </tr>
                            </table>

                            {{-- CTA button --}}
                            <p style="margin-top: 25px;">
                                <a href="{{ route('tickets.show', $ticket->id) }}"
                                   style="display: inline-block; background-color: #198754; color: #ffffff; padding: 11px 18px; text-decoration: none; border-radius: 5px; font-size: 14px;">
                                    View Ticket
                                </a>
                            </p>

                            <p style="font-size: 15px; line-height: 1.6; margin-top: 25px; margin-bottom: 0;">
                                Thank you,<br>
                                Online Support Team
                            </p>

                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td style="background-color: #f8f9fa; padding: 16px 28px; font-size: 12px; color: #777777;">
                            This is an automated email from the support system. Please do not reply directly to this email.
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>