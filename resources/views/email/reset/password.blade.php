@component('mail::message')
# This is your new password

Password: {{ $newPassword }}

Please ignore this email, if you never authorize the reset password request.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
