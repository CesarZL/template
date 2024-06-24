@props(['disabled' => false])

<input type="date" {{ $attributes->merge(['class' => 'form-input w-full']) }} {{ $disabled ? 'disabled' : '' }}>
