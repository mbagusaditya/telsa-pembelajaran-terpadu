<script lang="ts">
    import { Label } from '@/components/ui/label';
    import { Input } from '@/components/ui/input';

    type Props = {
        id: string;
        name?: string;
        type?: 'text' | 'email' | 'number' | 'tel' | 'url' | 'search';
        placeholder?: string;
        required?: boolean;
        disabled?: boolean;
        autofocus?: boolean;

        label: string;
        value: string | null;
        error?: string | null;
    };

    let {
        value = $bindable(''),
        label,
        error,
        id,
        type = 'text',
        ...restProps
    }: Props = $props();
</script>

<div class="flex flex-col gap-2 mb-3">
    <Label for={id}>
        {label}
        {#if restProps.required}
            <span class="text-red-600">*</span>
        {/if}
    </Label>

    <Input
        {id}
        {type}
        bind:value
        aria-invalid={Boolean(error)}
        aria-describedby={error ? `${id}-error` : undefined}
        {...restProps}
    />

    {#if error}
        <span class="text-destructive text-normal">
            {error}
        </span>
    {/if}
</div>
