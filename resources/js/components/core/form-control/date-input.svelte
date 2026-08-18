<script lang="ts">
    import { Label } from '@/components/ui/label';
    import { Button } from '@/components/ui/button';
    import { Calendar } from '@/components/ui/calendar';
    import * as Popover from '@/components/ui/popover';
    import { Calendar as CalendarIcon } from '@lucide/svelte';
    import { parseDate, type DateValue } from '@internationalized/date';

    type Props = {
        id: string;
        name?: string;
        label: string;
        placeholder?: string;
        required?: boolean;
        disabled?: boolean;
        value: string | null; // Format standar ISO: 'YYYY-MM-DD'
        error?: string | null;
        minValue?: string; // Batas tanggal minimum (opsional, 'YYYY-MM-DD')
        maxValue?: string; // Batas tanggal maksimum (opsional, 'YYYY-MM-DD')
    };

    let {
        value = $bindable(null),
        label,
        placeholder = 'Pilih tanggal...',
        error,
        id,
        disabled = false,
        required = false,
        minValue,
        maxValue,
    }: Props = $props();

    let open = $state(false);

    // Konversi string 'YYYY-MM-DD' ke DateValue untuk Calendar shadcn
    let internalDate = $derived.by<DateValue | undefined>(() => {
        if (!value) return undefined;

        try {
            return parseDate(value);
        } catch {
            return undefined;
        }
    });

    // Batas minimum & maksimum jika diisi
    let parsedMin = $derived(minValue ? parseDate(minValue) : undefined);
    let parsedMax = $derived(maxValue ? parseDate(maxValue) : undefined);

    // Format tampilan label di trigger (e.g. "17 Agustus 2024")
    let displayFormattedDate = $derived.by(() => {
        if (!internalDate) return null;

        const jsDate = internalDate.toDate('Asia/Jakarta');

        return new Intl.DateTimeFormat('id-ID', {
            day: 'numeric',
            month: 'long',
            year: 'numeric',
        }).format(jsDate);
    });

    function handleDateSelect(selected: DateValue | undefined) {
        if (selected) {
            value = selected.toString(); // Menghasilkan string 'YYYY-MM-DD'
        } else {
            value = null;
        }

        open = false;
    }
</script>

<div class="flex flex-col gap-2 mb-3">
    <Label for={id}>
        {label}
        {#if required}
            <span class="text-red-600">*</span>
        {/if}
    </Label>

    <Popover.Root bind:open>
        <Popover.Trigger>
            {#snippet child({ props })}
                <Button
                    {...props}
                    {id}
                    variant="outline"
                    {disabled}
                    class="w-full justify-start text-left font-normal h-10 px-3
                        {error
                        ? 'border-destructive focus-visible:ring-destructive'
                        : ''}
                        {!value ? 'text-muted-foreground' : ''}"
                    aria-invalid={Boolean(error)}
                    aria-describedby={error ? `${id}-error` : undefined}
                >
                    <CalendarIcon class="mr-2 h-4 w-4 shrink-0 opacity-70" />

                    <span class="truncate"
                        >{displayFormattedDate || placeholder}</span
                    >
                </Button>
            {/snippet}
        </Popover.Trigger>

        <Popover.Content class="w-auto p-0" align="start">
            <Calendar
                type="single"
                value={internalDate}
                onValueChange={handleDateSelect}
                minValue={parsedMin}
                maxValue={parsedMax}
                initialFocus
            />
        </Popover.Content>
    </Popover.Root>

    {#if error}
        <span id="{id}-error" class="text-destructive text-normal">
            {error}
        </span>
    {/if}
</div>
