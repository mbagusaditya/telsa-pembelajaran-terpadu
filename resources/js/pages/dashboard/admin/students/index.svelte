<script lang="ts">
    import DashboardLayout from '@/layouts/dashboard.svelte';
    import { type BreadcrumbItem as BreadcrumbItemType } from '@/types/navigation';
    import StudentTable from '@/components/module/dashboard/admin/table/student-table.svelte';
    import { type Student } from '@/types/models';

    let {
        title,
        students,
    }: {
        title: string;
        students: PaginatedResponse<Student[]>;
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
</DashboardLayout>
