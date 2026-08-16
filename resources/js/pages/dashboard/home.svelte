<script lang="ts">
    import DashboardLayout from '@/layouts/dashboard.svelte';
    import { type BreadcrumbItem as BreadcrumbItemType } from '@/types/navigation';

    const breadcrumbItems: BreadcrumbItemType[] = [
        {
            label: 'Dashboard',
            href: '/dashboard',
        },
        {
            label: 'Home',
        },
    ];
</script>

<DashboardLayout {breadcrumbItems}>
    <!-- <div>hello</div> -->
</DashboardLayout>
