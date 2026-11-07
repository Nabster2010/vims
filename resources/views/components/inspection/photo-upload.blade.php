@props(['field', 'title', 'required' => false])

@php
    $photo = $this->form->{$field};
@endphp

<div class="rounded-lg border p-4 space-y-4">

    <flux:heading size="sm">
        {{ $title }}

        @if ($required)
            <span class="text-red-500">*</span>
        @endif
    </flux:heading>

    <div x-data class="space-y-3">

        <input x-ref="file" type="file" class="hidden" accept="image/*" wire:model.live="form.{{ $field }}">

        <div class="aspect-[4/3] overflow-hidden rounded-xl border bg-zinc-50">

            @if ($photo instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile)
                <a href="{{ $photo->temporaryUrl() }}" target="_blank">
                    <img src="{{ $photo->temporaryUrl() }}" class="h-full w-full object-cover">
                </a>
            @elseif(is_string($photo))
                <a href="{{ Storage::url($photo) }}" target="_blank">
                    <img src="{{ Storage::url($photo) }}" class="h-full w-full object-cover">
                </a>
            @else
                <div class="flex h-full items-center justify-center">
                    <flux:icon.camera class="size-12 text-zinc-400" />
                </div>
            @endif

        </div>

        <flux:button type="button" variant="outline" class="w-full" x-on:click="$refs.file.click()">
            {{ is_string($photo) ? 'Replace Photo' : 'Upload Photo' }}
        </flux:button>

        @error("form.$field")
            <p class="text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror

    </div>

</div>
