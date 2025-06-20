@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Bullfex')
<img src="{{ asset('assets/logo.png') }}" alt="Bullfex Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
