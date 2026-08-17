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
        Page {pagination.currentPage}
        of {pagination.lastPage}

        <span class="ml-2">
            ({pagination.total} total)
        </span>
    </div>

    <div class="flex items-center gap-2">
        <Button
            variant="outline"
            size="sm"
            disabled={pagination.currentPage <= 1}
            onclick={() => onPageChange?.(pagination.currentPage - 1)}
        >
            <ChevronLeft class="size-4" />
            Previous
        </Button>

        <Button
            variant="outline"
            size="sm"
            disabled={pagination.currentPage >= pagination.lastPage}
            onclick={() => onPageChange?.(pagination.currentPage + 1)}
        >
            Next
            <ChevronRight class="size-4" />
        </Button>
    </div>
</div>
