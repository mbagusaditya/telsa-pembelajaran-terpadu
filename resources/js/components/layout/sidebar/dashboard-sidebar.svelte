<script lang="ts" module>
    import AudioWaveformIcon from '@lucide/svelte/icons/audio-waveform';
    import BookOpenIcon from '@lucide/svelte/icons/book-open';
    import BotIcon from '@lucide/svelte/icons/bot';
    import ChartPieIcon from '@lucide/svelte/icons/chart-pie';
    import CommandIcon from '@lucide/svelte/icons/command';
    import FrameIcon from '@lucide/svelte/icons/frame';
    import GalleryVerticalEndIcon from '@lucide/svelte/icons/gallery-vertical-end';
    import MapIcon from '@lucide/svelte/icons/map';
    import Settings2Icon from '@lucide/svelte/icons/settings-2';
    import SquareTerminalIcon from '@lucide/svelte/icons/square-terminal';

    const data = {
        navMain: [
            {
                title: 'Playground',
                url: '#',
                icon: SquareTerminalIcon,
                isActive: true,
                collapsible: true,
                items: [
                    {
                        title: 'History',
                        url: '#',
                    },
                    {
                        title: 'Starred',
                        url: '#',
                    },
                    {
                        title: 'Settings',
                        url: '#',
                    },
                ],
            },
            {
                title: 'Models',
                url: '#',
                icon: BotIcon,
                collapsible: true,
                items: [
                    {
                        title: 'Genesis',
                        url: '#',
                    },
                    {
                        title: 'Explorer',
                        url: '#',
                    },
                    {
                        title: 'Quantum',
                        url: '#',
                    },
                ],
            },
            {
                title: 'Documentation',
                url: '#',
                icon: BookOpenIcon,
                collapsible: false,
            },
            {
                title: 'Settings',
                url: '#',
                icon: Settings2Icon,
                collapsible: false,
            },
        ],
    };
</script>

<script lang="ts">
    import * as Sidebar from '@/components/ui/sidebar';
    import NavMain from './dashboard-sidebar/nav-main.svelte';
    import NavUser from './dashboard-sidebar/nav-user.svelte';
    import Header from './dashboard-sidebar/header.svelte';
    import type { ComponentProps } from 'svelte';
    let {
        ref = $bindable(null),
        collapsible = 'icon',
        ...restProps
    }: ComponentProps<typeof Sidebar.Root> = $props();
</script>

<Sidebar.Root bind:ref {collapsible} {...restProps}>
    <Sidebar.Header>
        <Header />
    </Sidebar.Header>
    <Sidebar.Content>
        <NavMain items={data.navMain} />
    </Sidebar.Content>
    <Sidebar.Footer>
        <NavUser />
    </Sidebar.Footer>
    <Sidebar.Rail />
</Sidebar.Root>
