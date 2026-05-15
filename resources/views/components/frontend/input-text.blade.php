
<div class="form_box">
    <label for="{{ $name }}" class="form-label mb-2 font-18 font-heading fw-600">{{ $label }} @if($required) <code>*</code>@endif</label>
    <input type="{{ $type == null ? 'text' : $type }}" name="{{ $name }}" value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}" {{ $attributes->merge(['class' => 'common-input border']) }}>
    <x-input-error :messages="$errors->get($name)" />
</div>
