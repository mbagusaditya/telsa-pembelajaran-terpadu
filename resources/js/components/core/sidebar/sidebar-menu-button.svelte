<script lang="ts">
    import SidebarMenuButton from '@/components/ui/sidebar/sidebar-menu-button.svelte';
    import { cn } from '@/lib/utils';
    import type { ComponentProps, Snippet } from 'svelte';

    type Props = ComponentProps<typeof SidebarMenuButton> & {
        children?: Snippet<[]>;
    };

    let {
        children,
        class: className,
        isActive,
        ...restProps
    }: Props = $props();
</script>

<SidebarMenuButton
    {isActive}
    class={cn(
        // Style default hover
        'hover:bg-sidebar-accent hover:text-sidebar-accent-foreground',
        // Override state active ke primary
        'data-[active=true]:bg-sidebar-primary data-[active=true]:text-sidebar-primary-foreground data-[active=true]:hover:bg-sidebar-primary/90 data-[active=true]:hover:text-sidebar-primary-foreground',
        'aria-[current=page]:bg-sidebar-primary aria-[current=page]:text-sidebar-primary-foreground aria-[current=page]:hover:bg-sidebar-primary/90 aria-[current=page]:hover:text-sidebar-primary-foreground',
        className,
    )}
    {...restProps}
>
    {@render children?.()}
</SidebarMenuButton>
