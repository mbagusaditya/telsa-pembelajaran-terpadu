<script lang="ts">
    import { DataTable } from '@/components/core/data-table';

    import { columns, type Student } from './student-columns';

    let {
        students,
    }: {
        students: Student[];
    } = $props();
</script>

<DataTable data={students} {columns} />
