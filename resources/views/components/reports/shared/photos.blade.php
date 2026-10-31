<h2 class="section-title">صور المركبة</h2>
<div class="photo-grid">

    @foreach ($inspection->photos as $photo)
        <div class="photo-card">

            <div class="photo-image">

                @if ($photo)
                    <img src="{{ asset('storage/' . $photo->path) }}">
                @endif

            </div>

            <div class="photo-title">
                {{ $photo->photo_type->label() }}
            </div>

        </div>
    @endforeach

</div>
