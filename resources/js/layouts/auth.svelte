<script lang="ts">
    import { Toaster } from '@/components/ui/sonner';
    import { type Snippet } from 'svelte';

    const { children }: { children: Snippet<[]> } = $props();
</script>

<div class="grid grid-cols-1 lg:grid-cols-2 grid-rows-1 min-h-dvh">
    <div class="justify-center content-center bg-gray-200 hidden lg:grid">
        ini banner
    </div>

    {@render children?.()}
</div>

<Toaster richColors />
