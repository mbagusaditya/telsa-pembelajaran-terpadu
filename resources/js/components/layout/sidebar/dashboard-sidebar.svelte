<script lang="ts">
    import * as Sidebar from '@/components/ui/sidebar';
    import NavGroup from './dashboard-sidebar/nav-group.svelte';
    import NavUser from './dashboard-sidebar/nav-user.svelte';
    import Header from './dashboard-sidebar/header.svelte';
    import type { ComponentProps } from 'svelte';
    import { page } from '@inertiajs/svelte';
    import { type DashboardItem } from '@/types/navigation';
    import StudentItems from './dashboard-sidebar/items/student';
    import TeacherItems from './dashboard-sidebar/items/teacher';
    import AdminItems from './dashboard-sidebar/items/admin';

    let {
        ref = $bindable(null),
        collapsible = 'icon',
        ...restProps
    }: ComponentProps<typeof Sidebar.Root> = $props();

    const items = {
        student: StudentItems,
        teacher: TeacherItems,
        admin: AdminItems,
    };

    let dashboardItems: Record<string, DashboardItem[]> =
        items[page.props.auth.user?.role ?? 'student'];
</script>

<Sidebar.Root bind:ref {collapsible} {...restProps}>
    <Sidebar.Header>
        <Header />
    </Sidebar.Header>
    <Sidebar.Content>
        {#each Object.entries(dashboardItems) as [label, items] (label)}
            <NavGroup {items} {label} />
        {/each}
    </Sidebar.Content>
    <Sidebar.Footer>
        <NavUser />
    </Sidebar.Footer>
    <Sidebar.Rail />
</Sidebar.Root>
