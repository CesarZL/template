@props(['disabled' => false, 'value' => ''])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'form-textarea w-full']) !!}>
{{ $value ?? $slot }}
</textarea>
