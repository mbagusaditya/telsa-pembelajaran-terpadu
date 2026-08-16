<script lang="ts">
    import ChevronsUpDownIcon from '@lucide/svelte/icons/chevrons-up-down';
    import * as Sidebar from '@/components/ui/sidebar/index.js';
    import { GalleryVerticalEndIcon } from '@lucide/svelte';
</script>

<Sidebar.Menu>
    <Sidebar.MenuItem>
        <Sidebar.MenuButton size="lg">
            {#snippet child({ props })}
                <a href="##" {...props}>
                    <div
                        class="flex aspect-square size-8 items-center justify-center rounded-lg bg-sidebar-primary text-sidebar-primary-foreground"
                    >
                        <GalleryVerticalEndIcon class="size-4" />
                    </div>
                    <div class="flex flex-col gap-0.5 leading-none">
                        <span class="font-medium">Documentation</span>
                        <span class="">v1.0.0</span>
                    </div>
                </a>
            {/snippet}
        </Sidebar.MenuButton>
    </Sidebar.MenuItem>
</Sidebar.Menu>
