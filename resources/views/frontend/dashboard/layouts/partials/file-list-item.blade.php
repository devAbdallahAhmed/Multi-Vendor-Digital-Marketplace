@foreach ($uploadFiles as $file)
    @php
        $fileIcon = 'bi-file-earmark';
        if (str_starts_with($file->mime_type, 'image/')) {
            $fileIcon = 'bi-file-earmark-image';
        } elseif (str_starts_with($file->mime_type, 'video/')) {
            $fileIcon = 'bi-file-earmark-play';
        } elseif (str_starts_with($file->mime_type, 'audio/')) {
            $fileIcon = 'bi-file-earmark-music';
        } elseif (str_ends_with($file->path, 'pdf')) {
            $fileIcon = 'bi-file-earmark-pdf';
        } elseif (str_starts_with($file->mime_type, 'text/')) {
            $fileIcon = 'bi-file-earmark-text';
        } elseif (str_starts_with($file->mime_type, 'application/')) {
            $fileIcon = 'bi-file-earmark-zip';
        }

        $size = $file->size;
        if ($size === 0) {
            $formattedSize = '0 B';
        } else {
            $i = floor(log($size) / log(1024));
            $formattedSize = round($size / pow(1024, $i), 2) . ' ' . ['B', 'KB', 'MB', 'GB', 'TB'][$i];
        }
    @endphp

    <li class="list-group-item file-list-item d-flex align-items-center justify-content-between"
        id="file-{{ $file->id }}">
        <div class="w-100">
            <div class="d-flex align-items-center mb-2">
                <i class="bi {{ $fileIcon }} fs-3 me-3 text-primary"></i>
                <span>{{ $file->name }} <span class="file-size text-muted">({{ $formattedSize }})</span></span>
            </div>
            <div class="progress me-3" style="width:100%; height: 5px;">
                <div class="progress-bar bg-success" role="progressbar" style="width: 100%;"></div>
            </div>
        </div>
        <button type="button" class="btn btn-danger btn-sm justify-content-end ms-3"
            onclick="removeFile('{{ $file->id }}')">
            <i class="bi bi-trash3"></i>
        </button>
    </li>
@endforeach
