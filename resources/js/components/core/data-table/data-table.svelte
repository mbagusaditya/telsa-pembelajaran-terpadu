<script lang="ts" generics="TData extends RowData">
    import {
        createTable,
        FlexRender,
        type RowData,
    } from '@tanstack/svelte-table';

    import * as Table from '@/components/ui/table';

    import DataTableToolbar from './data-table-toolbar.svelte';
    import DataTablePagination from './data-table-pagination.svelte';

    import { dataTableFeatures } from './features';

    import { onDestroy } from 'svelte';

    import type {
        DataTablePagination as Pagination,
        DataTableProps,
    } from './types';

    let {
        data,
        columns,

        pagination,

        emptyMessage = 'No results.',

        search = $bindable(''),

        onQueryChange,

        toolbarActions,
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
                perPage: pagination?.perPage ?? 10,
            });
        }, 400);
    }

    function handlePageChange(page: number) {
        onQueryChange?.({
            search,
            page,
            perPage: pagination?.perPage ?? 10,
        });
    }

    onDestroy(() => {
        if (debounceTimer) {
            clearTimeout(debounceTimer);
        }
    });
</script>

<div class="space-y-4">
    <DataTableToolbar {search} {toolbarActions} onSearch={handleSearch} />

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
