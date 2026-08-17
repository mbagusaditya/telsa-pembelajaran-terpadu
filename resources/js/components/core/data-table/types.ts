import type { ColumnDef, RowData } from '@tanstack/svelte-table';

import type { DataTableFeatures } from './features';

export type DataTableQuery = {
    search?: string;
    page?: number;
    perPage?: number;
};

export type DataTablePagination = {
    currentPage: number;
    lastPage: number;
    perPage: number;
    total: number;
};

export type DataTableProps<TData extends RowData> = {
    data: TData[];

    columns: ColumnDef<DataTableFeatures, TData>[];

    pagination?: DataTablePagination;

    query?: DataTableQuery;

    emptyMessage?: string;

    onQueryChange?: (query: DataTableQuery) => void;
};
