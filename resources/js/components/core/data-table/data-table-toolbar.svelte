<script lang="ts">
    import { Input } from '@/components/ui/input';

    let {
        search = '',
        onSearch,
    }: {
        search?: string;
        onSearch?: (value: string) => void;
    } = $props();
</script>

<div class="flex items-center justify-between">
    <Input
        value={search}
        placeholder="Search..."
        class="max-w-sm"
        oninput={(event) => {
            onSearch?.(event.currentTarget.value);
        }}
    />
</div>
