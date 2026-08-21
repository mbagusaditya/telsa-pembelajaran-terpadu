<script lang="ts">
    import ChevronLeft from '@lucide/svelte/icons/chevron-left';
    import ChevronRight from '@lucide/svelte/icons/chevron-right';

    import { Button } from '@/components/ui/button';

    import type { DataTablePagination as Pagination } from './types';

    let {
        pagination,
        onPageChange,
    }: {
        pagination: Pagination;

        onPageChange?: (page: number) => void;
    } = $props();
</script>

<div class="flex items-center justify-between px-2 py-4">
    <div class="text-muted-foreground text-sm">
        Page {pagination.current_page}
        of {pagination.last_page}

        <span class="ml-2">
            ({pagination.total} total)
        </span>
    </div>

    <div class="flex items-center gap-2">
        <Button
            variant="outline"
            size="sm"
            disabled={pagination.current_page <= 1}
            onclick={() => onPageChange?.(pagination.current_page - 1)}
        >
            <ChevronLeft class="size-4" />
            Previous
        </Button>

        <Button
            variant="outline"
            size="sm"
            disabled={pagination.current_page >= pagination.last_page}
            onclick={() => onPageChange?.(pagination.current_page + 1)}
        >
            Next
            <ChevronRight class="size-4" />
        </Button>
    </div>
</div>
