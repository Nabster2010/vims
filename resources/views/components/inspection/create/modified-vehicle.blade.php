<flux:card class="space-y-6">
    <flux:heading size="lg"> Modified Vehicle </flux:heading>

    <flux:input wire:model.live.debounce.500ms="form.plate_no" label="Plate No" />

    <flux:input wire:model.live.debounce.500ms="form.modification_center" label="Modification Center" />

    <flux:input wire:model.live.debounce.500ms="form.current_type" label="Current Type" />

    <flux:input wire:model.live.debounce.500ms="form.target_type" label="Target Type" />

    <flux:input wire:model.live.debounce.500ms="form.owner_id" label="Owner ID" />

    <flux:input type='date' wire:model.live.debounce.500ms="form.request_date" label="Request Date" />
    <flux:input wire:model.live.debounce.500ms="form.request_origin" label="Request Origin" />
    <flux:input wire:model.live.debounce.500ms="form.modification_center_report_no"
        label="Modification Center Report No" />
    <flux:input wire:model.live.debounce.500ms="form.modification_description" label="Modification Description" />
    <flux:checkbox wire:model.live.debounce.500ms="form.is_authorized_modification_center"
        label="Is Authorized Modification Center" />
</flux:card>
