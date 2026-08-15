<script lang="ts">
    import * as Card from '@/components/ui/card';
    import { Button } from '@/components/ui/button';
    import * as FormControl from '@/components/core/form-control';
    import { useForm } from '@inertiajs/svelte';

    const form = useForm({
        email: null,
        password: null,
        remember: false,
    }).dontRemember('password');

    function onsubmit(e: Event) {
        e.preventDefault();

        form.post('/auth/login/admin');
    }
</script>

<Card.Root class="w-full sm:w-[70%] md:w-[60%] lg:w-[40%] mx-auto">
    <Card.Content>
        <form {onsubmit} class="flex flex-col gap-3">
            <FormControl.Input
                id="admin-email"
                type="email"
                label="Email"
                bind:value={form.email}
                name="email"
                placeholder="Masukkan Email"
                error={form.errors.email}
                required
            />

            <FormControl.PasswordInput
                id="admin-password"
                label="Password"
                bind:value={form.password}
                name="password"
                placeholder="Masukkan kata sandi"
                error={form.errors.password}
                required
            />

            <Button type="submit" class="w-full mt-3">Masuk</Button>
        </form>
    </Card.Content>
</Card.Root>
