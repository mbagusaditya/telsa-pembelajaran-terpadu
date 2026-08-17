<script lang="ts">
    import { Input } from '@/components/ui/input';
    import type { Snippet } from 'svelte';
    let {
        search = '',
        searchPlaceholder = 'Search...',
        onSearch,
        children,
    }: {
        search?: string;
        searchPlaceholder?: string;
        onSearch?: (value: string) => void;
        children?: Snippet;
    } = $props();
</script>

<div class="flex items-center justify-between gap-2">
    <Input
        value={search}
        placeholder={searchPlaceholder}
        class="max-w-sm"
        oninput={(event) => {
            const value = event.currentTarget.value;
            onSearch?.(value);
        }}
    />
    {#if children}
        <div class="flex items-center gap-2">{@render children()}</div>
    {/if}
</div>
