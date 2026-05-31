 <div class="mb-3">
     <label class="form-label">{{ $label }}</label>
     <input type="{{ $type == 'null' ? 'text' : $type }}" {{ $attributes }}
         {{ $attributes->class(['form-control ', 'is-invalid' => $errors->first($name)]) }}
         placeholder="{{ $placeholder }}" value="{{ $value }}" name="{{ $name }}">
     @if ($hint)
         <span class= "form-hint">{{ $hint }}</span>
     @endif
 </div>

 <x-input-error :messages="$errors->first($name)" />

 @if ($attributes->has('data-role') && $attributes->get('data-role') == 'tagsinput')
     @push('scripts')
         <script>
             document.addEventListener('DOMContentLoaded', function() {
                 $('input[name="{{ $name }}"]').tagsinput({
                     confirmKeys: [13, 44]
                 });
             });
         </script>
     @endpush
 @endif
