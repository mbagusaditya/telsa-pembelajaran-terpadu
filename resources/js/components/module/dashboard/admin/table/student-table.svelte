<script lang="ts">
    import { router } from '@inertiajs/svelte';

    import {
        DataTable,
        type DataTableQuery,
    } from '@/components/core/data-table';
    import { Button } from '@/components/ui/button';

    import { columns } from './student-columns';
    import { type Student } from '@/types/models';

    let {
        students,
    }: {
        students: PaginatedResponse<Student>;
    } = $props();

    let search = $state('');

    function onQueryChange(query: DataTableQuery) {
        router.visit('/dashboard/admin/students', {
            data: {
                search: query.search || undefined,

                page: query.page ?? 1,

                perPage: query.perPage ?? 20,
            },

            preserveState: true,
            preserveScroll: true,
        });
    }
</script>

<DataTable
    data={students.data}
    {columns}
    pagination={students.meta}
    bind:search
    searchPlaceholder="Cari dengan nama..."
    {onQueryChange}
>
    {#snippet toolbarActions()}
        <Button variant="default">Tambah siswa</Button>
    {/snippet}
</DataTable>
