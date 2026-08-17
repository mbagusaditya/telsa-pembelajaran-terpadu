<script lang="ts">
    import ChevronLeft from '@lucide/svelte/icons/chevron-left';
    import ChevronRight from '@lucide/svelte/icons/chevron-right';
    import { Button } from '@/components/ui/button';
    import type { SvelteTable } from '@tanstack/svelte-table';

    let { table }: { table: SvelteTable<any, any> } = $props();

    const pagination = $derived(table.atoms.pagination.get());
    const pageIndex = $derived(pagination?.pageIndex ?? 0);
    const pageCount = $derived(table.getPageCount());
    const canPreviousPage = $derived(table.getCanPreviousPage());
    const canNextPage = $derived(table.getCanNextPage());
</script>

<div class="flex items-center justify-between px-2 py-4">
    <div class="text-muted-foreground text-sm">
        Page {pageIndex + 1} of {pageCount}
    </div>
    <div class="flex items-center gap-2">
        <Button
            variant="outline"
            size="sm"
            disabled={!canPreviousPage}
            onclick={() => table.previousPage()}
        >
            <ChevronLeft class="size-4" /> Previous
        </Button>
        <Button
            variant="outline"
            size="sm"
            disabled={!canNextPage}
            onclick={() => table.nextPage()}
        >
            Next <ChevronRight class="size-4" />
        </Button>
    </div>
</div>
