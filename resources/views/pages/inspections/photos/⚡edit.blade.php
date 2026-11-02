<?php

use App\Livewire\Forms\PhotoForm;
use App\Livewire\Pages\BasePage;
use App\Models\Inspection;
use App\Services\Inspection\InspectionLockService;
use App\Services\ToastService;
use Livewire\WithFileUploads;
use Flux\Flux;

new class extends BasePage {
    use WithFileUploads;

    public Inspection $inspection;

    public PhotoForm $form;

    public array $photoTypes = [
        'front' => 'Front View',
        'rear' => 'Rear View',
        'left' => 'Left Side',
        'right' => 'Right Side',
        'dashboard' => 'Dashboard',
        'vin' => 'VIN Plate',
        'engine' => 'Engine',
        'odometer' => 'Odometer',
    ];

    public function mount(Inspection $inspection): void
    {
        $this->authorize('performInspection', $inspection);

        $this->inspection = $inspection->loadMissing('photos');
    }

    public function save(): void
    {
        app(InspectionLockService::class)->ensureUnlocked($this->inspection);

        $this->form->save($this->inspection);

        Flux::toast(variant: 'success', text: 'Inspection photos saved successfully.');

        $this->redirectRoute('inspections.show', $this->inspection, navigate: true);
    }
};

?>

<x-ui.page>

    <flux:heading size="xl">
        Inspection {{ $inspection->inspection_no }} Photos
    </flux:heading>

    <form wire:submit="save" class="mt-6 space-y-6">

        <flux:card class="space-y-6">

            <flux:heading size="lg">
                Vehicle Photos
            </flux:heading>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-4">

                @foreach ($photoTypes as $type => $title)
                    <div class="rounded-lg border p-4 space-y-4">

                        <flux:heading size="sm">
                            {{ $title }}
                        </flux:heading>

                        <div x-data class="space-y-3">

                            <input x-ref="file" type="file" class="hidden" accept="image/*"
                                wire:model.live="form.photos.{{ $type }}">

                            {{-- Image Preview --}}
                            <div class="aspect-[4/3] overflow-hidden rounded-xl border bg-zinc-50">

                                @php
                                    $uploaded = $form->photos[$type] ?? null;
                                    $photo = $inspection->photos->firstWhere('photo_type', $type);
                                @endphp

                                @if ($uploaded instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile)
                                    <a href="{{ $uploaded->temporaryUrl() }}" target="_blank">
                                        <img src="{{ $uploaded->temporaryUrl() }}"
                                            class="h-full w-full object-cover cursor-zoom-in hover:opacity-90 transition">
                                    </a>
                                @elseif($photo)
                                    <a href="{{ Storage::url($photo->path) }}" target="_blank">
                                        <img src="{{ Storage::url($photo->path) }}"
                                            class="h-full w-full object-cover cursor-zoom-in hover:opacity-90 transition">
                                    </a>
                                @else
                                    <div class="flex h-full flex-col items-center justify-center gap-3">
                                        <flux:icon.camera class="size-12 text-zinc-400" />

                                        <div class="text-center">
                                            <p class="font-medium text-zinc-700">
                                                No Image
                                            </p>

                                            <p class="text-sm text-zinc-500">
                                                Upload vehicle photo
                                            </p>
                                        </div>
                                    </div>
                                @endif

                            </div>

                            {{-- Upload Button --}}
                            <flux:button type="button" variant="outline" class="w-full"
                                x-on:click="$refs.file.click()">

                                <flux:icon.arrow-up-tray class="size-4" />

                                {{ $inspection->photos->firstWhere('photo_type', $type) ? 'Replace Photo' : 'Upload Photo' }}

                            </flux:button>

                        </div>



                    </div>
                @endforeach

            </div>

        </flux:card>

        <div class="flex justify-end">

            <flux:button variant="primary" type="submit" :disabled="$inspection->is_locked">

                Save Photos

            </flux:button>

        </div>

    </form>

</x-ui.page>
