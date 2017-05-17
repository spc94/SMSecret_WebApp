
{{'This is a test message for '}} {{$writer}}
<div>
{!! QrCode::size(400)->generate($writer); !!}
</div>

