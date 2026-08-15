<script lang="ts">
    import { Toaster } from '@/components/ui/sonner';
</script>

<div class="grid grid-cols-1 grid-rows-1 min-h-dvh">
    <slot />
</div>

<Toaster richColors />
