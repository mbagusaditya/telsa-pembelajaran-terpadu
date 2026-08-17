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

    // let filterTable = $state('all')
</script>

<DashboardLayout {breadcrumbItems} {title}>
    <div>
        <!-- <ToggleGroup.Root type="single" variant="outline" bind>
            <ToggleGroup.Item value="all" aria-label="show all students"
                >Semua</ToggleGroup.Item
            >
            <ToggleGroup.Item value="all" aria-label="show active students"
                >Aktif</ToggleGroup.Item
            >
            <ToggleGroup.Item value="all" aria-label="show graduated students"
                >Lulus</ToggleGroup.Item
            >
        </ToggleGroup.Root> -->
    </div>

    <StudentTable students={students.data} />
    <!-- {JSON.stringify(students)} -->
</DashboardLayout>
