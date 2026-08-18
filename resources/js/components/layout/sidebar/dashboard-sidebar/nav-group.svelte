<script lang="ts">
    import ChevronRightIcon from '@lucide/svelte/icons/chevron-right';
    import * as Collapsible from '@/components/ui/collapsible';
    import * as Sidebar from '@/components/ui/sidebar';
    import { CoreSidebarMenuButton } from '@/components/core/sidebar';
    import { type Component } from 'svelte';
    import { inertia } from '@inertiajs/svelte';

    let {
        label,
        items,
    }: {
        label: string;
        items: {
            title: string;
            url: string;
            icon?: Component;
            isActive?: boolean;
            collapsible?: boolean;
            items?: {
                title: string;
                url: string;
            }[];
        }[];
    } = $props();
</script>

<Sidebar.Group>
    <Sidebar.GroupLabel class="capitalize">{label}</Sidebar.GroupLabel>
    <Sidebar.Menu>
        {#each items as item (item.title)}
            {#if item.collapsible}
                <Collapsible.Root
                    open={item.isActive}
                    class="group/collapsible"
                >
                    {#snippet child({ props })}
                        <Sidebar.MenuItem {...props}>
                            <Collapsible.Trigger>
                                {#snippet child({ props })}
                                    <CoreSidebarMenuButton
                                        {...props}
                                        tooltipContent={item.title}
                                    >
                                        {#if item.icon}
                                            <item.icon />
                                        {/if}

                                        <span>{item.title}</span>

                                        <ChevronRightIcon
                                            class="ms-auto transition-transform duration-200 group-data-[state=open]/collapsible:rotate-90"
                                        />
                                    </CoreSidebarMenuButton>
                                {/snippet}
                            </Collapsible.Trigger>

                            <Collapsible.Content>
                                <Sidebar.MenuSub>
                                    {#each item.items ?? [] as subItem (subItem.title)}
                                        <Sidebar.MenuSubItem>
                                            <Sidebar.MenuSubButton>
                                                {#snippet child({ props })}
                                                    <a
                                                        href={subItem.url}
                                                        {...props}
                                                        use:inertia
                                                    >
                                                        <span
                                                            >{subItem.title}</span
                                                        >
                                                    </a>
                                                {/snippet}
                                            </Sidebar.MenuSubButton>
                                        </Sidebar.MenuSubItem>
                                    {/each}
                                </Sidebar.MenuSub>
                            </Collapsible.Content>
                        </Sidebar.MenuItem>
                    {/snippet}
                </Collapsible.Root>
            {:else}
                <Sidebar.MenuItem>
                    <CoreSidebarMenuButton isActive={item.isActive}>
                        {#snippet child({ props })}
                            <a href={item.url} {...props} use:inertia>
                                {#if item.icon}
                                    <item.icon />
                                {/if}

                                <span>{item.title}</span>
                            </a>
                        {/snippet}
                    </CoreSidebarMenuButton>
                </Sidebar.MenuItem>
            {/if}
        {/each}
    </Sidebar.Menu>
</Sidebar.Group>
