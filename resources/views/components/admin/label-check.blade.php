<label class="form-check form-switch">
    <input name="{{ $name }}" {{ $attributes->merge(['class' => 'form-check-input']) }}
    type="checkbox" @checked($checked) value="1">
    <span class="form-check-label">{{ $label }}</span>
</label>
 <x-input-error :messages="$errors->first($name)" />
