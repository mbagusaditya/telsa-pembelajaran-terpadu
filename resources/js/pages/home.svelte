<script lang="ts">
    import Button from '@/components/ui/button/button.svelte';
    import { page } from '@inertiajs/svelte';
</script>

<Button href="/auth/logout">logout button</Button>

<p>user: {JSON.stringify(page.props.auth.user ?? 'no user')}</p>
