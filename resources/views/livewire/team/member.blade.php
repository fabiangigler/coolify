<tr @class([
    'text-white bg-coolblack hover:bg-coolgray-100',
    'bg-coolgray-100' => $member->id == auth()->user()->id,
])>
    <td class="px-5 py-4 text-sm whitespace-nowrap">
        {{ $member->name }}
    </td>
    <td class="px-5 py-4 text-sm whitespace-nowrap">
        {{ $member->email }}
    </td>
    <td class="px-5 py-4 text-sm whitespace-nowrap">
        {{ data_get($member, 'pivot.role') }}
    </td>
    <td class="px-5 py-4 text-sm whitespace-nowrap">
        @if (auth()->user()->isAdminFromSession())
            @if ($member->id !== auth()->user()->id)
                @if (auth()->user()->isOwner())
                    @if (data_get($member, 'pivot.role') === 'owner')
                        <x-forms.button wire:click="makeAdmin">To Admin</x-forms.button>
                        <x-forms.button wire:click="makeReadonly">To Member</x-forms.button>
                        <x-forms.button isError wire:click="remove">Remove</x-forms.button>
                    @endif
                    @if (data_get($member, 'pivot.role') === 'admin')
                        <x-forms.button wire:click="makeOwner">To Owner</x-forms.button>
                        <x-forms.button wire:click="makeReadonly">To Member</x-forms.button>
                        <x-forms.button isError wire:click="remove">Remove</x-forms.button>
                    @endif
                    @if (data_get($member, 'pivot.role') === 'member')
                        <x-forms.button wire:click="makeOwner">To Owner</x-forms.button>
                        <x-forms.button wire:click="makeAdmin">To Admin</x-forms.button>
                        <x-forms.button isError wire:click="remove">Remove</x-forms.button>
                    @endif
                @elseif (auth()->user()->isAdmin())
                    @if (data_get($member, 'pivot.role') === 'admin')
                        <x-forms.button wire:click="makeReadonly">To Member</x-forms.button>
                        <x-forms.button isError wire:click="remove">Remove</x-forms.button>
                    @endif
                    @if (data_get($member, 'pivot.role') === 'member')
                        <x-forms.button wire:click="makeAdmin">To Admin</x-forms.button>
                        <x-forms.button isError wire:click="remove">Remove</x-forms.button>
                    @endif
                @endif
            @else
                <div class="text-neutral-500">(This is you)</div>
            @endif
        @endif
    </td>
</tr>
