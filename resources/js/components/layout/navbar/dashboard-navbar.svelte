<script lang="ts">
    import Separator from '@/components/ui/separator/separator.svelte';
    import { SidebarTrigger } from '@/components/ui/sidebar';
    import * as Breadcrumb from '@/components/ui/breadcrumb';
    import * as DropdownMenu from '@/components/ui/dropdown-menu';
    import { type BreadcrumbItem as BreadcrumbItemType } from '@/types/navigation';

    type Props = {
        breadcrumbItems: BreadcrumbItemType[];
    };

    const { breadcrumbItems }: Props = $props();
</script>

<header
    class="flex h-16 shrink-0 items-center gap-2 transition-[width,height] ease-linear group-has-data-[collapsible=icon]/sidebar-wrapper:h-12"
>
    <div class="flex items-center gap-2 px-4">
        <SidebarTrigger class="-ms-1" />

        <Separator
            orientation="vertical"
            class="me-2 data-[orientation=vertical]:h-4"
        />

        <Breadcrumb.Root>
            <Breadcrumb.List>
                <Breadcrumb.Item class="block md:hidden">
                    <DropdownMenu.Root>
                        <DropdownMenu.Trigger class="flex items-center gap-1">
                            <Breadcrumb.Ellipsis class="size-4" />
                            <span class="sr-only">Toggle menu</span>
                        </DropdownMenu.Trigger>

                        <DropdownMenu.Content align="start">
                            {#each breadcrumbItems.slice(0, breadcrumbItems.length - 1) as item}
                                <DropdownMenu.Item>
                                    {#if item.href}
                                        <a href={item.href}>
                                            {item.label}
                                        </a>
                                    {:else}
                                        <span>{item.label}</span>
                                    {/if}
                                </DropdownMenu.Item>
                            {/each}
                        </DropdownMenu.Content>
                    </DropdownMenu.Root>
                </Breadcrumb.Item>

                <Breadcrumb.Separator class="block md:hidden" />

                {#each breadcrumbItems as item, index}
                    <Breadcrumb.Item class="hidden last:block md:block">
                        {#if item.href}
                            <Breadcrumb.Link href={item.href}>
                                {item.label}
                            </Breadcrumb.Link>
                        {:else}
                            <Breadcrumb.Page>
                                {item.label}
                            </Breadcrumb.Page>
                        {/if}
                    </Breadcrumb.Item>

                    {#if index !== breadcrumbItems.length - 1}
                        <Breadcrumb.Separator class="hidden md:block" />
                    {/if}
                {/each}
            </Breadcrumb.List>
        </Breadcrumb.Root>
    </div>
</header>
