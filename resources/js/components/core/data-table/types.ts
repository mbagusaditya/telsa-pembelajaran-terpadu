import type {
    ColumnDef,
    PaginationState,
    RowSelectionState,
    SortingState,
    ColumnVisibilityState,
    RowData,
} from '@tanstack/svelte-table';
import type { Snippet } from 'svelte';

export type DataTableProps<TData extends RowData> = {
    data: TData[];
    columns: ColumnDef<typeof import('./features').dataTableFeatures, TData>[];
    pageSize?: number;
    enableSorting?: boolean;
    enableFiltering?: boolean;
    enablePagination?: boolean;
    enableRowSelection?: boolean;
    enableColumnVisibility?: boolean;
    emptyMessage?: string;
    toolbar?: Snippet;
    pagination?: Snippet;
};
export type DataTableState = {
    sorting: SortingState;
    pagination: PaginationState;
    rowSelection: RowSelectionState;
    columnVisibility: ColumnVisibilityState;
};
