@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block; text-decoration: none;">
    @php
        $logo = \App\Models\Setting::get('site_logo');
    @endphp
    @if($logo)
        <img src="{{ config('app.url') . '/storage/' . $logo }}" class="logo" alt="ACEF Logo" style="height: 60px; width: auto; max-height: 60px;">
    @else
        <span style="color: #059669; font-size: 28px; font-weight: 900; letter-spacing: 0.1em; text-transform: uppercase;">ACEF</span>
    @endif
    <div style="color: #6b7280; font-size: 10px; font-weight: 700; letter-spacing: 0.15em; text-transform: uppercase; margin-top: 5px;">Africa Climate and Environment Foundation</div>
</a>
</td>
</tr>
