  @props(['module', 'href', 'moduleStatuses'])



  @php
      $status = $moduleStatuses[$module->value];
  @endphp
  <flux:button :href="$href" wire:navigate class="justify-between ">
      <div class="flex items-center gap-3">

          @if ($status === \App\Enums\InspectionModuleStatus::Completed)
              <flux:icon.check-circle class="size-6 text-green-500" />
          @else
              <flux:icon.minus-circle class="size-6 text-zinc-400" />
          @endif

          <span>{{ $module->label() }}</span>

      </div>

      <flux:badge size="sm"
          color="{{ $status === \App\Enums\InspectionModuleStatus::Completed ? 'green' : 'zinc' }}">
          {{ $status->name }}
      </flux:badge>

  </flux:button>
