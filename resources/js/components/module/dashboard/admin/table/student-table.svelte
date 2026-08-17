<script lang="ts">
    import { router } from '@inertiajs/svelte';

    import {
        DataTable,
        type DataTableQuery,
    } from '@/components/core/data-table';

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

    let query = $state<DataTableQuery>({
        search: '',
        page: students.current_page,
        perPage: students.per_page,
    });

    function onQueryChange(nextQuery: DataTableQuery) {
        query = nextQuery;

        router.visit('/dashboard/admin/students', {
            data: {
                search: nextQuery.search || undefined,

                page: nextQuery.page ?? 1,

                perPage: nextQuery.perPage ?? students.per_page,
            },

            preserveState: true,
            preserveScroll: true,
        });
    }
</script>

<DataTable
    data={students.data}
    {columns}
    pagination={{
        currentPage: students.current_page,

        lastPage: students.last_page,

        perPage: students.per_page,

        total: students.total,
    }}
    {query}
    {onQueryChange}
/>
