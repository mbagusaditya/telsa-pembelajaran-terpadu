<script lang="ts" generics="TData extends RowData">
    import type {
        ColumnFiltersState,
        ColumnVisibilityState,
        RowSelectionState,
        SortingState,
        RowData,
    } from '@tanstack/svelte-table';
    import { createTable, FlexRender } from '@tanstack/svelte-table';
    import * as Table from '@/components/ui/table';
    import { dataTableFeatures } from './features';
    import type { DataTableProps } from './types';

    let {
        data,
        columns,
        pageSize = 10,
        // enableSorting = true,
        // enableFiltering = true,
        // enablePagination = true,
        // enableRowSelection = false,
        // enableColumnVisibility = true,
        emptyMessage = 'No results.',
        toolbar,
        pagination,
    }: DataTableProps<TData> = $props();

    let sorting = $state<SortingState>([]);
    let paginationState = $state({ pageIndex: 0, pageSize });
    let rowSelection = $state<RowSelectionState>({});
    let columnVisibility = $state<ColumnVisibilityState>({});
    let columnFilters = $state<ColumnFiltersState>([]);

    const table = $derived.by(() =>
        createTable({
            features: dataTableFeatures,
            get data() {
                return data;
            },
            columns,
            state: {
                get sorting() {
                    return sorting;
                },
                get pagination() {
                    return paginationState;
                },
                get rowSelection() {
                    return rowSelection;
                },
                get columnVisibility() {
                    return columnVisibility;
                },
                get columnFilters() {
                    return columnFilters;
                },
            },
            onSortingChange: (updater) => {
                sorting =
                    typeof updater === 'function' ? updater(sorting) : updater;
            },
            onPaginationChange: (updater) => {
                paginationState =
                    typeof updater === 'function'
                        ? updater(paginationState)
                        : updater;
            },
            onRowSelectionChange: (updater) => {
                rowSelection =
                    typeof updater === 'function'
                        ? updater(rowSelection)
                        : updater;
            },
            onColumnVisibilityChange: (updater) => {
                columnVisibility =
                    typeof updater === 'function'
                        ? updater(columnVisibility)
                        : updater;
            },
            onColumnFiltersChange: (updater) => {
                columnFilters =
                    typeof updater === 'function'
                        ? updater(columnFilters)
                        : updater;
            },
        }),
    );
</script>

<div class="space-y-4">
    {#if toolbar}
        {@render toolbar()}
    {/if}
    <div class="rounded-md border">
        <Table.Root>
            <Table.Header>
                {#each table.getHeaderGroups() as headerGroup (headerGroup.id)}
                    <Table.Row>
                        {#each headerGroup.headers as header (header.id)}
                            <Table.Head>
                                {#if !header.isPlaceholder}
                                    <FlexRender {header} />
                                {/if}
                            </Table.Head>
                        {/each}
                    </Table.Row>
                {/each}
            </Table.Header>
            <Table.Body>
                {#if table.getRowModel().rows.length > 0}
                    {#each table.getRowModel().rows as row (row.id)}
                        <Table.Row
                            data-state={row.getIsSelected()
                                ? 'selected'
                                : undefined}
                        >
                            {#each row.getVisibleCells() as cell (cell.id)}
                                <Table.Cell>
                                    <FlexRender {cell} />
                                </Table.Cell>
                            {/each}
                        </Table.Row>
                    {/each}
                {:else}
                    <Table.Row>
                        <Table.Cell
                            colspan={columns.length}
                            class="h-24 text-center"
                        >
                            {emptyMessage}
                        </Table.Cell>
                    </Table.Row>
                {/if}
            </Table.Body>
        </Table.Root>
    </div>
    {#if pagination}
        {@render pagination()}
    {/if}
</div>
