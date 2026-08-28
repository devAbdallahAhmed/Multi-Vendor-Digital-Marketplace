<div class="form_box">
    <label for="{{ $name }}" class="form-label mb-2 font-18 font-heading fw-600">{{ $label }}  @if($required) <code>*</code>@endif</label>
    <div>
        <select {{ $attributes->merge(['class' => 'common-input border ']) }} name="{{ $name }}">
            {{ $slot }}
        </select>
        <x-input-error :messages="$errors->get($name)" />
    </div>
</div>
