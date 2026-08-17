<script lang="ts" generics="TData extends RowData">
    import {
        createTable,
        FlexRender,
        type RowData,
    } from '@tanstack/svelte-table';

    import * as Table from '@/components/ui/table';

    import DataTablePagination from './data-table-pagination.svelte';
    import DataTableToolbar from './data-table-toolbar.svelte';

    import { dataTableFeatures } from './features';

    import type { DataTableProps } from './types';

    let {
        data,
        columns,
        pagination,
        query = {},
        emptyMessage = 'No results.',
        onQueryChange,
    }: DataTableProps<TData> = $props();

    const table = $derived.by(() =>
        createTable({
            features: dataTableFeatures,

            get data() {
                return data;
            },

            columns,
        }),
    );

    function handleSearch(search: string) {
        onQueryChange?.({
            ...query,
            search,
            page: 1,
        });
    }

    function handlePageChange(page: number) {
        onQueryChange?.({
            ...query,
            page,
        });
    }
</script>

<div class="space-y-4">
    <DataTableToolbar search={query.search ?? ''} onSearch={handleSearch} />

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
        <DataTablePagination {pagination} onPageChange={handlePageChange} />
    {/if}
</div>
