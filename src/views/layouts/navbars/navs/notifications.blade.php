@foreach ($notifications as $notification)
    @if ($notification->readed == 0)
        <a href="{{ $notification->url }}" class="dropdown-item"
            style="font-weight:bold;cursor:pointer;font-size:13.5px" data-id="{{ $notification->id }}">
            <span>{{ $notification->notification }}</span>
        </a>
    @endif
@endforeach
