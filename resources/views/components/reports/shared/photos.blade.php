<h2 class="section-title">صور المركبة</h2>
<div class="photo-grid">

    @foreach ($reportData['photos'] as $photo)
        <div class="photo-card">

            <div class="photo-image">

                @if ($photo)
                    <img src="{{ asset('storage/' . $photo->path) }}">
                @endif

            </div>

            <h3 class="photo-title">
                {{ $photo->photo_type->label() }}
            </h3>

        </div>
    @endforeach

</div>
