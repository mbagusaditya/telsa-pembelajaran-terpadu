<script lang="ts">
    import DashboardLayout from '@/layouts/dashboard.svelte';
    import * as ToggleGroup from '@/components/ui/toggle-group';
    import { type BreadcrumbItem as BreadcrumbItemType } from '@/types/navigation';
    import StudentTable from '@/components/module/dashboard/admin/table/student-table.svelte';

    let {
        title,
        students,
    }: {
        title: string;
        students: Pagination<
            {
                id: number;
                name: string;
            }[]
        >;
    } = $props();

    const breadcrumbItems: BreadcrumbItemType[] = [
        {
            label: 'Dashboard',
            href: '/dashboard',
        },
        {
            label: 'Manajemen siswa',
        },
    ];
</script>

<DashboardLayout {breadcrumbItems} {title}>
    <StudentTable {students} />
    <!-- {JSON.stringify(students.data)} -->
</DashboardLayout>
