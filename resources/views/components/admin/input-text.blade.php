 <div class="mb-3">
     <label class="form-label">{{ $label }}</label>
     <input type="{{ $type == 'null' ? 'text' : $type }}" 
     {{ $attributes }}
     {{ $attributes->class([ 'form-control ' ,'is-invalid' => $errors->first($name) ]) }}
         placeholder="{{ $placeholder }}" value="{{ $value }}" name="{{ $name }}">
 </div>
 <x-input-error :messages="$errors->first($name)" />
