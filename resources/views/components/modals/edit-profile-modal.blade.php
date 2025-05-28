<!-- Edit Profile Modal -->
<flux:modal name="edit-profile" class="md:w-96">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Update profile</flux:heading>
            <flux:text class="mt-2">Make changes to your personal details.</flux:text>
        </div>
        <flux:input label="Name" wire:model="name" placeholder="Your name" :value="auth()->user()->name" />
        <flux:input label="Email" type="email" wire:model="email" :value="auth()->user()->email" />
        <div class="flex">
            <flux:spacer />
            <flux:button class="cursor-pointer" type="submit" wire:click.prevent="updateProfile" variant="primary">Save changes</flux:button>
        </div>
    </div>
</flux:modal>
