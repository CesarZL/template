@props(['disabled' => false])

<select {{ $attributes->merge(['class' => 'form-select w-full']) }} {{ $disabled ? 'disabled' : '' }}>
    {{ $slot }}
</select>
