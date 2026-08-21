<script lang="ts">
    import { Toaster } from '@/components/ui/sonner';
    import { type Snippet } from 'svelte';

    const { children }: { children: Snippet<[]> } = $props();
</script>

<div class="grid grid-cols-1 grid-rows-1 min-h-dvh">
    {@render children?.()}
</div>

<Toaster richColors />
