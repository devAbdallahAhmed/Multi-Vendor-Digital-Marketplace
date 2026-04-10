   <div class="form_box">
       <label for="country" class="form-label mb-2 font-18 font-heading fw-600">{{ $label }}</label>
       <div>
           <select {{ $attributes->merge(['class' => 'common-input border  select_2']) }} name="{{ $name }}"> >
               <option value =''>{{ __('Select') }}</option>
               {{ $slot }}
           </select>
       </div>
       <x-input-error :messages="$errors->get($name)" />

   </div>
