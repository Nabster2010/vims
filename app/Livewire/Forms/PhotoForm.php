<?php

namespace App\Livewire\Forms;

use App\Models\Inspection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Form;

class PhotoForm extends Form
{

    public array $photos = [];


    public function rules(): array
    {
        return [
            'photos.*' => ['nullable', 'image', 'max:5120'],
        ];
    }



    public function save(Inspection $inspection): void
    {
        $this->validate();

        foreach ($this->photos as $type => $photo) {

            if (! $photo) {
                continue;
            }

            $existing = $inspection->photos()
                ->where('photo_type', $type)
                ->first();

            if ($existing?->path && Storage::disk('public')->exists($existing->path)) {
                Storage::disk('public')->delete($existing->path);
            }

            $filename = $type . '.' . $photo->getClientOriginalExtension();

            $path = $photo->storeAs(
                "inspections/{$inspection->id}",
                $filename,
                'public'
            );

            $inspection->photos()->updateOrCreate(
                [
                    'photo_type' => $type,
                ],
                [
                    'path' => $path,
                    'uploaded_by' => Auth::id(),
                ]
            );
        }
    }
}
