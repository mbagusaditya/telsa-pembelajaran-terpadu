<script>
    import * as Card from '@/components/ui/card';
    import {
        Users,
        GraduationCap,
        BookOpenCheck,
        CalendarDays,
        ArrowUpRight,
        ArrowDownRight,
    } from '@lucide/svelte';

    // Dummy data metrik dashboard admin
    const stats = [
        {
            title: 'Siswa Aktif',
            value: '1,020',
            description: '+12% dari semester lalu',
            trend: 'up',
            icon: Users,
            color: 'text-blue-600 dark:text-blue-400',
            bgColor: 'bg-blue-500/10 border-blue-500/20',
        },
        {
            title: 'Tenaga Pengajar',
            value: '64',
            description: '4 pengajar baru',
            trend: 'up',
            icon: GraduationCap,
            color: 'text-emerald-600 dark:text-emerald-400',
            bgColor: 'bg-emerald-500/10 border-emerald-500/20',
        },
        {
            title: 'Kelas / Rombel',
            value: '32',
            description: 'Kapasitas 95% terisi',
            trend: 'neutral',
            icon: BookOpenCheck,
            color: 'text-purple-600 dark:text-purple-400',
            bgColor: 'bg-purple-500/10 border-purple-500/20',
        },
        {
            title: 'Tingkat Kehadiran',
            value: '96.4%',
            description: '-0.8% minggu ini',
            trend: 'down',
            icon: CalendarDays,
            color: 'text-amber-600 dark:text-amber-400',
            bgColor: 'bg-amber-500/10 border-amber-500/20',
        },
    ];
</script>

<!-- Grid Container: 1 Kolom di Mobile, 2 di Tablet, 4 di Desktop -->
<div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
    {#each stats as item}
        <Card.Root
            class="relative overflow-hidden transition-all duration-200 hover:shadow-md hover:border-primary/30 group"
        >
            <Card.Content class="p-6">
                <div class="flex items-center justify-between space-y-0 pb-3">
                    <p
                        class="text-sm font-medium text-muted-foreground tracking-tight"
                    >
                        {item.title}
                    </p>
                    <!-- Icon Container dengan soft background -->
                    <div
                        class="p-2.5 rounded-xl border {item.bgColor} transition-transform group-hover:scale-105 duration-200"
                    >
                        <svelte:component
                            this={item.icon}
                            class="size-5 {item.color}"
                        />
                    </div>
                </div>

                <div class="flex flex-col gap-1">
                    <div
                        class="text-2xl font-bold tracking-tight text-foreground"
                    >
                        {item.value}
                    </div>

                    <!-- Keterangan & Indikator Tren -->
                    <!-- <div
                        class="flex items-center gap-1.5 text-xs text-muted-foreground pt-1"
                    >
                        {#if item.trend === 'up'}
                            <span
                                class="inline-flex items-center font-medium text-emerald-600 dark:text-emerald-400"
                            >
                                <ArrowUpRight class="size-3.5 mr-0.5" />
                            </span>
                        {:else if item.trend === 'down'}
                            <span
                                class="inline-flex items-center font-medium text-rose-600 dark:text-rose-400"
                            >
                                <ArrowDownRight class="size-3.5 mr-0.5" />
                            </span>
                        {/if}
                        <span>{item.description}</span>
                    </div> -->
                </div>
            </Card.Content>
        </Card.Root>
    {/each}
</div>
