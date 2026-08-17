<script lang="ts">
    import DashboardLayout from '@/layouts/dashboard.svelte';
    import { type BreadcrumbItem as BreadcrumbItemType } from '@/types/navigation';

    const { title } = $props();

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
    <h1>asd</h1>
</DashboardLayout>
