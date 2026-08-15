<script lang="ts">
    import { Label } from '@/components/ui/label';
    import * as InputGroup from '@/components/ui/input-group';
    import { EyeIcon, EyeOffIcon } from '@lucide/svelte';

    type Props = {
        id: string;
        name?: string;
        placeholder?: string;
        required?: boolean;
        disabled?: boolean;

        label: string;
        value: string | null;
        error?: string | null;
    };

    let isPasswordRevealed = $state(false);

    let {
        value = $bindable(''),
        label,
        error,
        id,
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

    <InputGroup.Root>
        <InputGroup.Input
            {id}
            type={isPasswordRevealed ? 'text' : 'password'}
            bind:value
            autocomplete="current-password"
            aria-invalid={Boolean(error)}
            aria-describedby={error ? `${id}-error` : undefined}
            {...restProps}
        />
        <InputGroup.Addon align="inline-end">
            <InputGroup.Button
                type="button"
                aria-label={isPasswordRevealed
                    ? 'Sembunyikan kata sandi'
                    : 'Tampilkan kata sandi'}
                onclick={() => (isPasswordRevealed = !isPasswordRevealed)}
            >
                {#if isPasswordRevealed}
                    <EyeIcon aria-hidden="true" />
                {:else}
                    <EyeOffIcon aria-hidden="true" />
                {/if}
            </InputGroup.Button>
        </InputGroup.Addon>
    </InputGroup.Root>

    {#if error}
        <span class="text-destructive text-normal">
            {error}
        </span>
    {/if}
</div>
