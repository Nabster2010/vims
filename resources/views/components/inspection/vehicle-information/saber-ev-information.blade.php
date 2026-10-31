      <div class="space-y-6">
          <flux:card>
              <flux:heading size="xl">
                  Saber Electric vehicle (EV) Information
              </flux:heading>

              <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">

                  <flux:input wire:model.live="form.model_division" type="text" label="Model Division" />
                  <flux:input wire:model.live="form.manufacturing_year" type="text" label="Manufacturing Year" />

                  <flux:input wire:model.live="form.number_of_doors" type="text" label="Number Of Doors" />
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
                  <flux:select wire:model.live="form.category_id" label="Category">
                      <option value="">Select Body Type</option>

                      @foreach ($this->categories as $category)
                          <option value="{{ $category->id }}">
                              {{ $category->name }}
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
                  <flux:input wire:model.blur="form.number_of_axles" type="text" label="Number Of Axles" />
                  <flux:input wire:model.blur="form.front_axle_weight" type="text" label="Front Axle Weight" />
                  <flux:input wire:model.blur="form.rear_axle_weight" type="text" label="Rear Axle Weight" />
                  <flux:input wire:model.blur="form.front_track_width" type="text" label="Front Track Width" />
                  <flux:input wire:model.blur="form.rear_track_width" type="text" label="Rear Track Width" />
                  <flux:input wire:model.blur="form.gross_weight" type="text" label="Gross Weight" />
                  <flux:input wire:model.blur="form.curb_weight" type="text" label="Curb Weight" />
                  <flux:input wire:model.blur="form.load_weight" type="text" label="Load Weight" />
                  <flux:input wire:model.blur="form.wheelbase" type="text" label="Wheelbase" />
                  <flux:input wire:model.blur="form.width" type="text" label="Width" />
                  <flux:input wire:model.blur="form.height" type="text" label="Height" />

                  <flux:input wire:model.blur="form.length" type="text" label="Length" />

                  <flux:input wire:model.blur="form.service_brake" label="Service Brake" />
                  <flux:input wire:model.blur="form.emergency_brake" label="Emergency Brake" />
              </div>
          </flux:card>

          <flux:card>
              <flux:heading size="xl">
                  Electric Vehicle Information
              </flux:heading>

              <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">

                  <flux:input wire:model.blur="form.electric_motor_power" type="text" label="Electric Motor Power" />

                  <flux:input wire:model.blur="form.battery_type" label="Battery Type" />

                  <flux:input wire:model.blur="form.battery_capacity" type="text" label="Battery Capacity" />

                  <flux:input wire:model.blur="form.battery_voltage" type="text" label="Battery Voltage" />

                  <flux:input wire:model.blur="form.battery_charge_time" type="text" label="Battery Charge Time" />

                  <flux:input wire:model.blur="form.electric_consumption" type="text" label="Electric Consumption" />
                  <flux:input wire:model.blur="form.equivalent_fuel_economy" type="text"
                      label="Equivalent Fuel Economy " />

              </div>
          </flux:card>

          <flux:card>
              <flux:heading size="xl">
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

      </div>
