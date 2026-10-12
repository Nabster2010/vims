      <flux:card class="space-y-6">
          <flux:heading size="xl">
              Saber Plug-in Hybrid vehicle (PHEV) Information
          </flux:heading>


          <flux:input wire:model.live="form.model_division" label="Model Division" />

          <flux:input wire:model.live="form.manufacturing_year" type="number" label="Manufacturing Year" />
          <flux:input wire:model.live="form.number_of_doors" type="number" label="Number Of Doors" />
          <flux:select wire:model.live="form.shipment_country_id" label="Shipment Country">
              <option value="">Select Country</option>

              @foreach ($this->countries as $country)
                  <option value="{{ $country->id }}">
                      {{ $country->name }}
                  </option>
              @endforeach
          </flux:select>
          <flux:select wire:model.live="form.production_country_id" label="Production Country">
              <option value="">Select Country</option>

              @foreach ($this->countries as $country)
                  <option value="{{ $country->id }}">
                      {{ $country->name }}
                  </option>
              @endforeach
          </flux:select>

          <flux:select wire:model.live="form.body_type" label="Body Type">
              <option value="">Select Body Type</option>

              @foreach ($this->bodyTypes as $bodyType)
                  <option value="{{ $bodyType->value }}">
                      {{ $bodyType->value }}
                  </option>
              @endforeach
          </flux:select>
          <flux:select wire:model.live="form.air_intake" label="Air Intake">
              <option value="">Select Air Intake</option>
              @foreach ($this->airIntakes as $airIntake)
                  <option value="{{ $airIntake->value }}">
                      {{ $airIntake->value }}
                  </option>
              @endforeach
          </flux:select>

          <flux:select wire:model.live="form.drive_line" label="Drive Line">

              <option value="">Select Drive Line</option>

              @foreach ($this->driveLines as $driveLine)
                  <option value="{{ $driveLine->value }}">
                      {{ $driveLine->value }}
                  </option>
              @endforeach
          </flux:select>
          <flux:input wire:model.live="form.engine_displacement" label="Engine Displacement" />

          <flux:input wire:model.live="form.engine_power" label="Engine Power" />
          <flux:input wire:model.live="form.number_of_cylinders" label="Number Of Cylinders" />
          <flux:input wire:model.live="form.number_of_axles" type="number" label="Number Of Axles" />
          <flux:input wire:model.live="form.front_axle_weight" type="number" label="Front Axle Weight" />
          <flux:input wire:model.live="form.rear_axle_weight" type="number" label="Rear Axle Weight" />
          <flux:input wire:model.live="form.front_track_width" type="number" label="Front Track Width" />
          <flux:input wire:model.live="form.rear_track_width" type="number" label="Rear Track Width" />

          <flux:input wire:model.live="form.gross_weight" type="number" label="Gross Weight" />
          <flux:input wire:model.live="form.curb_weight" type="number" label="Curb Weight" />
          <flux:input wire:model.live="form.load_weight" type="number" label="Load Weight" />


          <flux:input wire:model.live="form.wheelbase" type="number" label="Wheelbase" />

          <flux:input wire:model.live="form.width" type="number" label="Width" />

          <flux:input wire:model.live="form.height" type="number" label="Height" />

          <flux:input wire:model.live="form.length" type="number" label="Length" />

          <flux:input wire:model.live="form.service_brake" label="Service Brake" />
          <flux:input wire:model.live="form.emergency_brake" label="Emergency Brake" />



          <flux:heading size="lg">
              Electric Vehicle Information
          </flux:heading>

          <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">

              <flux:input wire:model.live="form.electric_motor_power" type="number" label="Electric Motor Power" />

              <flux:input wire:model.live="form.battery_type" label="Battery Type" />

              <flux:input wire:model.live="form.battery_capacity" type="number" label="Battery Capacity" />

              <flux:input wire:model.live="form.battery_voltage" type="number" label="Battery Voltage" />

              <flux:input wire:model.live="form.battery_charge_time" type="number" label="Battery Charge Time" />

              <flux:input wire:model.live="form.electric_consumption" type="number" label="Electric Consumption" />

          </div>


          <flux:heading size="lg">
              Compliance
          </flux:heading>

          <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

              <flux:select wire:model.live="form.energy_efficiency_compliance" label="Energy Efficiency Compliance">
                  <option value="">Select</option>

                  @foreach (\App\Enums\ComplianceStatus::cases() as $status)
                      <option value="{{ $status->value }}">
                          {{ $status->label() }}
                      </option>
                  @endforeach
              </flux:select>
              <flux:select wire:model.live="form.vehicle_age_compliance" label="Vehicle Age Compliance">
                  <option value="">Select</option>

                  @foreach (\App\Enums\ComplianceStatus::cases() as $status)
                      <option value="{{ $status->value }}">
                          {{ $status->label() }}
                      </option>
                  @endforeach
              </flux:select>
              <flux:select wire:model.live="form.fuel_economy_compliance" label="Fuel Economy Compliance">
                  <option value="">Select</option>

                  @foreach (\App\Enums\ComplianceStatus::cases() as $status)
                      <option value="{{ $status->value }}">
                          {{ $status->label() }}
                      </option>
                  @endforeach
              </flux:select>
              <flux:select wire:model.live="form.is_vehicle_rare" label="Is Vehicle Rare">
                  <option value="">Select</option>

                  @foreach (\App\Enums\ComplianceStatus::cases() as $status)
                      <option value="{{ $status->value }}">
                          {{ $status->label() }}
                      </option>
                  @endforeach
              </flux:select>


          </div>


      </flux:card>
