<script lang="ts">
    import * as Sidebar from '@/components/ui/sidebar';
    import { Toaster } from '@/components/ui/sonner';
    import DashboardSidebar from '@/components/layout/sidebar/dashboard-sidebar.svelte';
    import DashboardNavbar from '@/components/layout/navbar/dashboard-navbar.svelte';
    import { type BreadcrumbItem as BreadcrumbItemType } from '@/types/navigation';
    import { ModeWatcher } from 'mode-watcher';
    import { type Snippet } from 'svelte';

    type Props = {
        title?: string;
        breadcrumbItems: BreadcrumbItemType[];
        children: Snippet<[]>;
    };

    const { title, breadcrumbItems, children }: Props = $props();
</script>

<svelte:head>
    <title>{title}</title>
</svelte:head>

<Sidebar.Provider>
    <DashboardSidebar />

    <Sidebar.Inset>
        <DashboardNavbar {breadcrumbItems} />

        <div class="flex flex-1 flex-col gap-4 p-4 pt-0">
            {@render children?.()}
        </div>
    </Sidebar.Inset>
</Sidebar.Provider>

<Toaster richColors />

<ModeWatcher />
