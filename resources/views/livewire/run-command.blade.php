<div>
    <div>
        <label for="command">
            <input autofocus id="command" wire:model.defer="command" type="text" wire:keydown.enter="runCommand" />
            <select wire:model.defer="server">
                @foreach ($servers as $server)
                    <option value="{{ $server->uuid }}">{{ $server->name }}</option>
                @endforeach
            </select>
        </label>
        <button wire:click="runCommand">Run command</button>
        <button wire:click="runSleepingBeauty">Run sleeping beauty</button>
        <button wire:click="runDummyProjectBuild">Build DummyProject</button>
    </div>

    <div>
        <input id="manualKeepAlive" name="manualKeepAlive" type="checkbox" wire:model="manualKeepAlive">
        <label for="manualKeepAlive">Real-time logs</label>
        @if ($isKeepAliveOn || $manualKeepAlive)
            Polling...
        @endif
    </div>
    @isset($activity?->id)
        <pre style="width: 100%;overflow-y: scroll;" @if ($isKeepAliveOn || $manualKeepAlive) wire:poll.750ms="polling" @endif>{{ data_get($activity, 'description') }}</pre>
    @endisset
</div>