<?php

namespace App\Livewire\Forms;

use App\Models\Inspection;
use App\Services\Inspection\InspectionWorkflowService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class PhotoForm extends Form
{
    public mixed $front = null;

    public mixed $rear = null;

    public mixed $left = null;

    public mixed $right = null;

    public mixed $vin = null;

    public mixed $dashboard = null;

    public mixed $engine = null;

    public mixed $odometer = null;

    public function fillFromInspection(Inspection $inspection): void
    {
        // output [front=>path, rear=>path, left=>path, right=>path, vin=>path, dashboard=>path, engine=>path, odometer=>path]
        foreach ($inspection->photos as $photo) {
            $this->{$photo->photo_type->value} = $photo->path;
        }
    }
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'front' => $this->front instanceof TemporaryUploadedFile
                ? ['required', 'image', 'max:500']
                : ['required'],
            'rear' => $this->rear instanceof TemporaryUploadedFile
                ? ['required', 'image', 'max:500']
                : ['required'],
            'left' => $this->left instanceof TemporaryUploadedFile
                ? ['required', 'image', 'max:500']
                : ['required'],
            'right' => $this->right instanceof TemporaryUploadedFile
                ? ['required', 'image', 'max:500']
                : ['required'],
            'vin' => $this->vin instanceof TemporaryUploadedFile
                ? ['required', 'image', 'max:500']
                : ['required'],

            'dashboard' => ['nullable', 'image', 'max:500'],
            'engine' => ['nullable', 'image', 'max:500'],
            'odometer' => ['nullable', 'image', 'max:500'],
        ];
    }

    public function save(Inspection $inspection): void
    {
        $this->validate();

        foreach ($this->data() as $type => $photo) {

            if (! $photo instanceof TemporaryUploadedFile) {
                continue;
            }

            $existing = $inspection->photos()
                ->where('photo_type', $type)
                ->first();

            if ($existing?->path && Storage::disk('public')->exists($existing->path)) {
                Storage::disk('public')->delete($existing->path);
            }

            $path = $photo->storeAs(
                "inspections/{$inspection->id}",
                "{$type}.{$photo->getClientOriginalExtension()}",
                'public'
            );

            $inspection->photos()->updateOrCreate(
                ['photo_type' => $type],
                [
                    'path' => $path,
                    'uploaded_by' => Auth::id(),
                ]
            );
        }

        app(InspectionWorkflowService::class)->sync($inspection);
    }
    /**
     * @return array<string, mixed>
     */
    public function data(): array
    {
        return [
            'front' => $this->front,
            'rear' => $this->rear,
            'left' => $this->left,
            'right' => $this->right,
            'vin' => $this->vin,
            'dashboard' => $this->dashboard,
            'engine' => $this->engine,
            'odometer' => $this->odometer,
        ];
    }
}
