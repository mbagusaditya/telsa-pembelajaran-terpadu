<script lang="ts" generics="TData extends RowData">
    import ArrowDown from '@lucide/svelte/icons/arrow-down';
    import ArrowUp from '@lucide/svelte/icons/arrow-up';
    import ChevronsUpDown from '@lucide/svelte/icons/chevrons-up-down';
    import type { Column, RowData } from '@tanstack/svelte-table';
    import { Button } from '@/components/ui/button';

    let { column, title }: { column: Column<any, TData>; title: string } =
        $props();

    const sorted = $derived(column.getIsSorted());
</script>

{#if column.getCanSort()}
    <Button
        variant="ghost"
        class="h-8 px-2 lg:px-3"
        onclick={column.getToggleSortingHandler()}
    >
        {title}
        {#if sorted === 'asc'}
            <ArrowUp class="ms-2 size-4" />
        {:else if sorted === 'desc'}
            <ArrowDown class="ms-2 size-4" />
        {:else}
            <ChevronsUpDown class="ms-2 size-4" />
        {/if}
    </Button>
{:else}
    <span>{title}</span>
{/if}
