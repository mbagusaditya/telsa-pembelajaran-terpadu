<script lang="ts">
    import { Label } from '@/components/ui/label';
    import * as Select from '@/components/ui/select';

    export type SelectOption = {
        value: string;
        label: string;
        disabled?: boolean;
    };

    type Props = {
        id: string;
        name?: string;
        label: string;
        placeholder?: string;
        required?: boolean;
        disabled?: boolean;
        options: SelectOption[];
        value: string | null;
        error?: string | null;
    };

    let {
        value = $bindable(null),
        label,
        options = [],
        placeholder = 'Pilih opsi...',
        error,
        id,
        disabled = false,
        required = false,
        name,
    }: Props = $props();

    // Mencari label dari opsi yang sedang terpilih untuk ditampilkan pada trigger
    let selectedLabel = $derived(
        options.find((opt) => opt.value === value)?.label,
    );
</script>

<div class="flex flex-col gap-2 mb-3">
    <Label for={id}>
        {label}
        {#if required}
            <span class="text-red-600">*</span>
        {/if}
    </Label>

    <Select.Root type="single" bind:value={value as any} {disabled} {name}>
        <Select.Trigger
            {id}
            class="w-full {error
                ? 'border-destructive focus-visible:ring-destructive'
                : ''}"
            aria-invalid={Boolean(error)}
            aria-describedby={error ? `${id}-error` : undefined}
        >
            <span class={!selectedLabel ? 'text-muted-foreground' : ''}>
                {selectedLabel || placeholder}
            </span>
        </Select.Trigger>

        <Select.Content>
            {#each options as option (option.value)}
                <Select.Item
                    value={option.value}
                    label={option.label}
                    disabled={option.disabled}
                >
                    {option.label}
                </Select.Item>
            {/each}
        </Select.Content>
    </Select.Root>

    {#if error}
        <span id="{id}-error" class="text-destructive text-normal">
            {error}
        </span>
    {/if}
</div>
