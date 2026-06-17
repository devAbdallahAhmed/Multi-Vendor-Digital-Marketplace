 <div class="mb-3">
     <label for="country" class="form-label mb-2 font-18 font-heading fw-600">{{ $label }}<span
             class="text-danger">*</label>
     <select {{ $attributes->merge(['class' => '  common-input border form-control form-select ']) }}
         name="{{ $name }}">
         <option value=""> {{ __('Select') }} </option>
         {{ $slot }}
     </select>
 </div>
 <x-input-error :messages="$errors->get($name)" />
