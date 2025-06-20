@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Bullfex')
<img src="https://lin-chain.com/assets/logo.png" class="logo" alt="Bullfex Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
