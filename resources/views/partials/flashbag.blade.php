@if (session()->has("success"))
    <x-alert type="success">
        {{ session("success") }}
    </x-alert>
@elseif (session()->has("error"))
    <x-alert type="error">
        {{ session("error") }}
    </x-alert>
@endif