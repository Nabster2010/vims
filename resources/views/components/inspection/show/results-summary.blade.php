  {{-- faild items --}}

  <flux:callout variant="danger" class="space-y-4 mt-4">

      <flux:heading size="lg">
          Failed Items
      </flux:heading>

      @foreach ($inspectionResult['failedItems'] as $item)
          <div>{{ $item }}</div>
      @endforeach


      </flux:card>

      {{-- failed modules --}}
      <flux:callout variant="danger" class="space-y-4 mt-4">
          <flux:heading size="lg">
              Failed Modules
          </flux:heading>

          @foreach ($inspectionResult['failedModules'] as $module)
              <div>{{ $module->label() }}</div>
          @endforeach




      </flux:callout>
