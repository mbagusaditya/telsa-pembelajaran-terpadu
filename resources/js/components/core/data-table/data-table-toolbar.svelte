<script lang="ts">
    import type { Snippet } from 'svelte';

    import { Input } from '@/components/ui/input';

    let {
        search = '',
        searchPlaceholder = 'Search...',
        onSearch,
        toolbarActions,
    }: {
        search?: string;
        searchPlaceholder?: string;

        onSearch?: (value: string) => void;

        toolbarActions?: Snippet;
    } = $props();
</script>

<div class="flex items-center justify-between gap-4">
    <Input
        value={search}
        placeholder={searchPlaceholder}
        class="max-w-sm"
        oninput={(event) => {
            onSearch?.(event.currentTarget.value);
        }}
    />

    {#if toolbarActions}
        <div class="flex items-center gap-2">
            {@render toolbarActions()}
        </div>
    {/if}
</div>
