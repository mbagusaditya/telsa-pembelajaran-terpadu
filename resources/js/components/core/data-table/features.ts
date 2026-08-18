import {
    columnFilteringFeature,
    columnVisibilityFeature,
    createFilteredRowModel,
    // createPaginatedRowModel,
    createSortedRowModel,
    rowPaginationFeature,
    rowSelectionFeature,
    rowSortingFeature,
    tableFeatures,
} from '@tanstack/svelte-table';

export const dataTableFeatures = tableFeatures({
    rowSortingFeature,
    rowPaginationFeature,
    rowSelectionFeature,
    columnFilteringFeature,
    columnVisibilityFeature,
    sortedRowModel: createSortedRowModel(),
    // paginatedRowModel: createPaginatedRowModel(),
    filteredRowModel: createFilteredRowModel(),
});

export type DataTableFeatures = typeof dataTableFeatures;
