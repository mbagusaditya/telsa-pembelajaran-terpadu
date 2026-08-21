<script lang="ts" generics="TData extends RowData">
    import {
        createTable,
        FlexRender,
        type RowData,
        type ColumnDef,
    } from '@tanstack/svelte-table';
    import type { Snippet } from 'svelte';

    import * as Table from '@/components/ui/table';

    import DataTableToolbar from './data-table-toolbar.svelte';
    import DataTablePagination from './data-table-pagination.svelte';

    import { dataTableFeatures, type DataTableFeatures } from './features';
    import type { DataTableProps } from './types';

    // Extend props bawaan agar mendukung snippet rowActions
    type Props = DataTableProps<TData> & {
        rowActions?: Snippet<[{ row: TData }]>;
        actionsHeader?: string;
    };

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
        rowActions,
        actionsHeader = 'Aksi',
    }: Props = $props();

    // columns configuration
    const allColumns = $derived.by(() => {
        const cols: ColumnDef<DataTableFeatures, TData>[] = [...columns];

        // 1. Tambah Kolom Nomor Baris (Kiri)
        if (withRowNumber) {
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
            cols.unshift(rowNumberCol);
        }

        // 2. Tambah Kolom Actions (Kanan) jika snippet rowActions diberikan
        if (rowActions) {
            const actionsCol: ColumnDef<DataTableFeatures, TData> = {
                id: '_actions',
                header: () => actionsHeader,
                cell: ({ row }) => row.original, // Kirim row data asli ke cell renderer
                enableSorting: false,
                enableHiding: false,
            };
            cols.push(actionsCol);
        }

        return cols;
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
                            <Table.Head
                                class={header.id === '_actions'
                                    ? 'text-right'
                                    : ''}
                            >
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
                                <Table.Cell
                                    class={cell.column.id === '_actions'
                                        ? 'text-right'
                                        : ''}
                                >
                                    {#if cell.column.id === '_actions' && rowActions}
                                        {@render rowActions({
                                            row: row.original,
                                        })}
                                    {:else}
                                        <FlexRender {cell} />
                                    {/if}
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
