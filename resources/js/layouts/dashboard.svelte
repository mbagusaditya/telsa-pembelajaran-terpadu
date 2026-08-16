<script lang="ts">
    import * as Sidebar from '@/components/ui/sidebar';
    import DashboardSidebar from '@/components/layout/sidebar/dashboard-sidebar.svelte';
    import DashboardNavbar from '@/components/layout/navbar/dashboard-navbar.svelte';
    import { type BreadcrumbItem as BreadcrumbItemType } from '@/types/navigation';

    type Props = {
        breadcrumbItems: BreadcrumbItemType[];
    };

    const { breadcrumbItems }: Props = $props();
</script>

<Sidebar.Provider>
    <DashboardSidebar />

    <Sidebar.Inset>
        <DashboardNavbar {breadcrumbItems} />

        <div class="flex flex-1 flex-col gap-4 p-4 pt-0">
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <div class="aspect-video rounded-xl bg-muted/50"></div>
                <div class="aspect-video rounded-xl bg-muted/50"></div>
                <div class="aspect-video rounded-xl bg-muted/50"></div>
            </div>
            <div
                class="min-h-screen flex-1 rounded-xl bg-muted/50 md:min-h-min"
            ></div>
        </div>
    </Sidebar.Inset>
</Sidebar.Provider>
