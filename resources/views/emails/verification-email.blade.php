<x-mail::message>
# Verify Your Email

Dear {{$name}}

<x-mail::button :url="'{{$link}}'">
erify Your Email
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
