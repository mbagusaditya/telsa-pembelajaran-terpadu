<script lang="ts">
    import { Checkbox } from '@/components/ui/checkbox';
    import { Label } from '@/components/ui/label';

    type Props = {
        id?: string;
        name?: string;
        label?: string;
        checked?: boolean;
        disabled?: boolean;
    };

    let {
        id = 'remember',
        name = 'remember',
        label = 'Ingat saya',
        checked = $bindable(false),
        disabled = false,
    }: Props = $props();
</script>

<div class="flex items-center gap-3">
    <Checkbox {id} {name} bind:checked {disabled} />

    <Label for={id}>
        {label}
    </Label>
</div>
