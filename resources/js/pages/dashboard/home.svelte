<script lang="ts">
    import HomeCalendar from '@/components/module/dashboard/calendar/home-calendar.svelte';
    import DashboardLayout from '@/layouts/dashboard.svelte';
    import * as Card from '@/components/ui/card';
    import { type BreadcrumbItem as BreadcrumbItemType } from '@/types/navigation';
    import { UsersIcon } from '@lucide/svelte';
    import HomeStats from '@/components/module/dashboard/stats/home-stats.svelte';

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
    <div class="grid grid-cols-1 space-y-4">
        <HomeStats />

        <HomeCalendar />
    </div>
</DashboardLayout>
