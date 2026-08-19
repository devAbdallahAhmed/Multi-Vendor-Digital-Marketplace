@props(['src' => ''])

<div class="mb-2">
    <img src="{{ !empty($src) ? $src : 'https://via.placeholder.com/150' }}" alt="Image Preview"
        style="max-width: 150px; max-height: 150px; object-fit: contain; border: 1px solid #ddd; padding: 5px; border-radius: 5px; background: #fff;">
</div>
