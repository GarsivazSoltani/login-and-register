<x-mail::message>
# Forget Password


<x-mail::button :url="$link">
Reset Your Password
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
