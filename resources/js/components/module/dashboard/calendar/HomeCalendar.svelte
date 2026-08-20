<script>
    import {
        Card,
        CardHeader,
        CardTitle,
        CardContent,
    } from '@/components/ui/card';
    import { Badge } from '@/components/ui/badge';
    import { Button } from '@/components/ui/button';

    const days = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];

    // Svelte 5 State: Track bulan dan tahun aktif
    let current = $state(new Date());

    // Svelte 5 Derived: Menghitung grid secara otomatis saat state 'current' berubah
    let year = $derived(current.getFullYear());
    let month = $derived(current.getMonth());

    let monthLabel = $derived(
        current.toLocaleString('id-ID', { month: 'long', year: 'numeric' }),
    );

    // Hitung jumlah hari dalam bulan & indeks hari pertama
    let daysInMonth = $derived(new Date(year, month + 1, 0).getDate());
    let firstDayIndex = $derived(new Date(year, month, 1).getDay());

    // Navigasi Bulan & Tahun
    function prevMonth() {
        current = new Date(year, month - 1, 1);
    }

    function nextMonth() {
        current = new Date(year, month + 1, 1);
    }

    // Helper penanda tanggal hari ini
    const realToday = new Date();
    let isCurrentMonth = $derived(
        realToday.getFullYear() === year && realToday.getMonth() === month,
    );
    let todayDate = $derived(isCurrentMonth ? realToday.getDate() : null);

    // Dummy list event untuk preview di samping kalender
    const upcomingEvents = [
        { time: '09:30 - 12:00', title: 'Sistem Terdistribusi', tag: 'Kuliah' },
        { time: '12:30 - 15:00', title: 'Pemrograman Klien', tag: 'Lab' },
        { time: '15:30 - 18:00', title: 'Pemrograman Server', tag: 'Besok' },
    ];
</script>

<Card class="w-full shadow-sm">
    <CardHeader class="pb-3 border-b">
        <div class="flex items-center justify-between">
            <div>
                <CardTitle class="text-lg font-bold capitalize"
                    >{monthLabel}</CardTitle
                >
                <p class="text-xs text-muted-foreground">
                    Kalender & Agenda Dashboard
                </p>
            </div>

            <!-- Tombol Navigasi Prev / Next -->
            <div class="flex items-center gap-1.5">
                <Button
                    variant="outline"
                    size="sm"
                    class="h-8 w-8 p-0"
                    onclick={prevMonth}
                >
                    &larr;
                </Button>
                <Button
                    variant="outline"
                    size="sm"
                    class="h-8 w-8 p-0"
                    onclick={nextMonth}
                >
                    &rarr;
                </Button>
            </div>
        </div>
    </CardHeader>

    <CardContent class="p-6 grid grid-cols-1 md:grid-cols-5 gap-6">
        <!-- Kolom Kiri: Mini Calendar Grid (3/5 lebar) -->
        <div class="md:col-span-3 space-y-3">
            <!-- Nama Hari -->
            <div
                class="grid grid-cols-7 text-center text-xs font-semibold text-muted-foreground pb-1 border-b"
            >
                {#each days as day}
                    <div>{day}</div>
                {/each}
            </div>

            <!-- Grid Tanggal -->
            <div class="grid grid-cols-7 gap-1 text-center text-sm">
                <!-- Slot Kosong Awal Bulan -->
                {#each Array(firstDayIndex) as _}
                    <div class="h-8"></div>
                {/each}

                <!-- Deretan Tanggal -->
                {#each Array(daysInMonth) as _, i}
                    {@const date = i + 1}
                    {@const isToday = date === todayDate}

                    <div
                        class="h-8 flex flex-col items-center justify-center relative"
                    >
                        <span
                            class="w-7 h-7 flex items-center justify-center rounded-full text-xs transition-colors
                            {isToday
                                ? 'bg-primary text-primary-foreground font-bold shadow-sm'
                                : 'hover:bg-muted text-foreground'}"
                        >
                            {date}
                        </span>
                    </div>
                {/each}
            </div>
        </div>

        <!-- Kolom Kanan: List Agenda Ringkas (2/5 lebar) -->
        <div
            class="md:col-span-2 md:border-l md:pl-6 space-y-3 flex flex-col justify-center"
        >
            <h4
                class="text-xs font-semibold uppercase tracking-wider text-muted-foreground"
            >
                Jadwal Terdekat
            </h4>

            <div class="space-y-2">
                {#each upcomingEvents as item}
                    <div
                        class="p-2.5 rounded-lg border bg-muted/30 flex items-start justify-between gap-2"
                    >
                        <div class="space-y-0.5">
                            <p class="text-xs font-semibold leading-none">
                                {item.title}
                            </p>
                            <p class="text-[11px] text-muted-foreground">
                                {item.time}
                            </p>
                        </div>
                        <Badge
                            variant="secondary"
                            class="text-[10px] px-1.5 py-0 h-5"
                        >
                            {item.tag}
                        </Badge>
                    </div>
                {/each}
            </div>
        </div>
    </CardContent>
</Card>
