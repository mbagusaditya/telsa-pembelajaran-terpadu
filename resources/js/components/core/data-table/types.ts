import type { ColumnDef, RowData } from '@tanstack/svelte-table';
import type { Snippet } from 'svelte';

import type { DataTableFeatures } from './features';

export type DataTableQuery = {
    search: string;
    page: number;
    perPage: number;
};

export type DataTablePagination = {
    current_page: number;
    last_page: number;
    per_page: number;
    total: number;
};

export type DataTableProps<TData extends RowData> = {
    data: TData[];

    columns: ColumnDef<DataTableFeatures, TData>[];

    pagination?: DataTablePagination;

    emptyMessage?: string;

    search?: string;
    searchPlaceholder?: string;

    onQueryChange?: (query: DataTableQuery) => void;

    toolbarActions?: Snippet;

    withRowNumber?: boolean;
};
