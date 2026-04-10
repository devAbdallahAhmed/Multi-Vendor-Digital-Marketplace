 <label class="form-label">{{ $label }}</label>
<textarea rows="5" name="{{ $name }}" {{ $attributes->merge(['class' => 'form-control']) }} placeholder="{{ $placeholder }}">
{{ $value }}
</textarea>
<x-input-error :messages="$errors->get($name)" />