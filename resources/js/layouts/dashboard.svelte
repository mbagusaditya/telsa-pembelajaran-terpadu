<script lang="ts">
    import { Toaster } from '@/components/ui/sonner';
    import { SidebarProvider, SidebarTrigger } from '@/components/ui/sidebar';
    import DashboardSidebar from '@/components/layout/sidebar/dashboard-sidebar.svelte';
</script>

<SidebarProvider>
    <DashboardSidebar />

    <div class="grid grid-cols-1 grid-rows-[auto_1fr] w-full">
        <nav class="h-16 flex items-center mb-6">
            <div class="container mx-auto">
                <SidebarTrigger>toggle</SidebarTrigger>
            </div>
        </nav>

        <div class="container mx-auto">
            <slot />
        </div>
    </div>
</SidebarProvider>

<Toaster richColors />
