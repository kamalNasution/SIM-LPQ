@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level == 'error')
# Ups!
@else
# Assalamu`alaikum!
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Action Button --}}
@if (isset($actionText))
<?php
    switch ($level) {
        case 'success':
            $color = 'green';
            break;
        case 'error':
            $color = 'red';
            break;
        default:
            $color = 'blue';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endif

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

<!-- Salutation -->
@if (! empty($salutation))
{{ $salutation }}
@else
Sistem Informasi Manajemen<br />
LPQ Al Hurriyyah IPB
@endif

<!-- Subcopy -->
@if (isset($actionText))
@component('mail::subcopy')
Apabila Anda tidak dapat menge-klik tombol "{{ $actionText }}",
salin dan kunjungi alamat berikut.<br />
[{{ $actionUrl }}]({{ $actionUrl }})
@endcomponent
@endif
@endcomponent
