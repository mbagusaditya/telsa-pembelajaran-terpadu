<script lang="ts" generics="TData extends RowData">
    import {
        createTable,
        FlexRender,
        type RowData,
        type ColumnDef,
    } from '@tanstack/svelte-table';

    import * as Table from '@/components/ui/table';

    import DataTableToolbar from './data-table-toolbar.svelte';
    import DataTablePagination from './data-table-pagination.svelte';

    import { dataTableFeatures, type DataTableFeatures } from './features';

    import type { DataTableProps } from './types';

    let {
        data,
        columns,

        pagination,

        emptyMessage = 'No results.',

        search = $bindable(''),
        searchPlaceholder = 'Search...',

        onQueryChange,

        toolbarActions,

        withRowNumber = true,
    }: DataTableProps<TData> = $props();

    // columns configuration
    const allColumns = $derived.by(() => {
        const rowNumberCol: ColumnDef<DataTableFeatures, TData> = {
            id: '_row_number',
            header: () => '#',
            cell: ({ row }) => {
                const currentPage = pagination?.current_page ?? 1;
                const perPage = pagination?.per_page ?? 20;
                return (currentPage - 1) * perPage + row.index + 1;
            },
            enableSorting: false,
            enableHiding: false,
        };

        return withRowNumber ? [rowNumberCol, ...columns] : columns;
    });

    const table = $derived.by(() =>
        createTable({
            features: dataTableFeatures,

            get data() {
                return data;
            },

            columns: allColumns,

            manualPagination: true,
            pageCount: pagination?.last_page ?? -1,
            rowCount: pagination?.total,
            initialState: {
                pagination: {
                    pageIndex: (pagination?.current_page ?? 1) - 1, // TanStack index mulai dari 0
                    pageSize: pagination?.per_page ?? 20,
                },
            },
        }),
    );

    // debounce setting for searching
    let debounceTimer: ReturnType<typeof setTimeout> | undefined;

    function handleSearch(value: string) {
        search = value;

        if (debounceTimer) {
            clearTimeout(debounceTimer);
        }

        debounceTimer = setTimeout(() => {
            onQueryChange?.({
                search,
                page: 1,
                perPage: pagination?.per_page ?? 20,
            });
        }, 400);
    }

    function handlePageChange(page: number) {
        onQueryChange?.({
            search,
            page,
            perPage: pagination?.per_page ?? 20,
        });
    }

    $effect(() => {
        // onDestroy
        return () => {
            if (debounceTimer) {
                clearTimeout(debounceTimer);
            }
        };
    });
</script>

<div class="space-y-4">
    <DataTableToolbar
        {search}
        {toolbarActions}
        onSearch={handleSearch}
        {searchPlaceholder}
    />

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
                        <Table.Row>
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
                            colspan={allColumns.length}
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
        <DataTablePagination {pagination} onPageChange={handlePageChange} />
    {/if}
</div>
