<script lang="ts">
    import { router } from '@inertiajs/svelte';

    import {
        DataTable,
        type DataTableQuery,
    } from '@/components/core/data-table';
    import { Button } from '@/components/ui/button';

    import { columns, type Student } from './student-columns';

    type StudentPagination = {
        data: Student[];

        current_page: number;
        last_page: number;
        per_page: number;
        total: number;
    };

    let {
        students,
    }: {
        students: StudentPagination;
    } = $props();

    let dataTable = $derived.by(() => {
        const { data, ...pagination } = students;
        return {
            data,
            pagination,
        };
    });

    let search = $state('');

    function onQueryChange(query: DataTableQuery) {
        router.visit('/dashboard/admin/students', {
            data: {
                search: query.search || undefined,

                page: query.page ?? 1,

                perPage: query.perPage ?? students.per_page ?? 20,
            },

            preserveState: true,
            preserveScroll: true,
        });
    }
</script>

<DataTable
    data={dataTable.data}
    {columns}
    pagination={dataTable.pagination}
    bind:search
    searchPlaceholder="Cari dengan nama..."
    {onQueryChange}
>
    {#snippet toolbarActions()}
        <Button variant="default">Tambah siswa</Button>
    {/snippet}
</DataTable>
