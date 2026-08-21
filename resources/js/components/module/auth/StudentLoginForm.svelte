<script lang="ts">
    import * as Card from '@/components/ui/card';
    import { Button } from '@/components/ui/button';
    import { Spinner } from '@/components/ui/spinner';
    import * as FormControl from '@/components/core/form-control';
    import { page, useForm } from '@inertiajs/svelte';
    import { toast } from 'svelte-sonner';

    const form = useForm({
        nis: null,
        password: null,
        remember: false,
    }).dontRemember('password');

    function onsubmit(e: Event) {
        e.preventDefault();

        form.post('/auth/login', {
            onFinish: () => {
                if (!page.flash.toast) return;

                const func = toast[page.flash.toast.type as ToastType];

                func(page.flash.toast.message);
            },
        });
    }
</script>

<Card.Root
    class="w-full sm:w-[70%] mx-auto lg:shadow-none lg:ring-0 lg:p-0 lg:rounded-none lg:overflow-visible"
>
    <Card.Content class="lg:p-0">
        <form {onsubmit} class="flex flex-col gap-3">
            <FormControl.Input
                id="student-nis"
                type="text"
                label="NIS"
                bind:value={form.nis}
                name="nis"
                placeholder="Masukkan NIS"
                error={form.errors.nis?.[0]}
                autofocus
                required
            />

            <FormControl.PasswordInput
                id="student-password"
                label="Password"
                bind:value={form.password}
                name="password"
                placeholder="Masukkan kata sandi"
                error={form.errors.password?.[0]}
                required
            />

            <FormControl.RememberCheckbox
                label="Ingat saya"
                bind:checked={form.remember}
            />

            <Button
                type="submit"
                class="w-full mt-3"
                disabled={form.processing}
            >
                {#if form.processing}
                    <Spinner />
                {:else}
                    <span>Masuk</span>
                {/if}
            </Button>
        </form>
    </Card.Content>
</Card.Root>
