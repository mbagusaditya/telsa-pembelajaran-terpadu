<script lang="ts">
    import AdminAuthLayout from '@/layouts/admin-auth.svelte';
    import * as Card from '@/components/ui/card';
    import { Input } from '@/components/ui/input';
    import * as InputGroup from '@/components/ui/input-group';
    import { Label } from '@/components/ui/label';
    import { Button } from '@/components/ui/button';
    import { Checkbox } from '@/components/ui/checkbox';
    import { EyeIcon, EyeOffIcon } from '@lucide/svelte';
    import { useForm } from '@inertiajs/svelte';
    import { cn } from 'tailwind-variants';

    let isPasswordRevealed = $state(false);

    const form = useForm({
        email: null,
        password: null,
        remember: false,
    }).dontRemember('password');

    function submit(e: Event) {
        e.preventDefault();

        form.post('/auth/login/admin');
    }
</script>

<AdminAuthLayout>
    <div class="py-8 px-8 lg:px-12 pt-20">
        <div
            class="bg-gray-300 size-24 md:size-40 mb-4 md:mb-8 flex justify-center items-center mx-auto"
        >
            logo
        </div>

        <header class="mb-8 lg:mb-12">
            <h1
                class="text-xl md:text-2xl font-semibold leading-tight text-center"
            >
                Portal Web administrasi
            </h1>

            <h4 class="text-normal text-center">Masuk sebagai admin</h4>
        </header>

        <Card.Root class="w-full sm:w-[70%] md:w-[60%] lg:w-[40%] mx-auto">
            <Card.Content>
                <form onsubmit={submit}>
                    <div class="flex flex-col gap-2 mb-3">
                        <Label for="admin-email">
                            Email <span class="text-red-600">*</span>
                        </Label>

                        <Input
                            name="nis"
                            id="admin-email"
                            bind:value={form.email}
                            aria-invalid={Boolean(form.errors.email)}
                        />

                        {#if form.errors.email}
                            <span class="text-destructive text-normal">
                                {form.errors.email}
                            </span>
                        {/if}
                    </div>

                    <div class="flex flex-col gap-2 mb-3">
                        <Label for="admin-password">
                            Password <span class="text-red-600">*</span>
                        </Label>

                        <InputGroup.Root>
                            <InputGroup.Input
                                type={isPasswordRevealed ? 'text' : 'password'}
                                name="password"
                                id="admin-password"
                                bind:value={form.password}
                                autocomplete="current-password"
                                aria-invalid={Boolean(form.errors.password)}
                            />
                            <InputGroup.Addon align="inline-end">
                                <InputGroup.Button
                                    onclick={() =>
                                        (isPasswordRevealed =
                                            !isPasswordRevealed)}
                                >
                                    {#if isPasswordRevealed}
                                        <EyeIcon />
                                    {:else}
                                        <EyeOffIcon />
                                    {/if}
                                </InputGroup.Button>
                            </InputGroup.Addon>
                        </InputGroup.Root>

                        {#if form.errors.password}
                            <span class="text-destructive text-normal">
                                {form.errors.password}
                            </span>
                        {/if}
                    </div>

                    <div class="flex items-center gap-3 mb-6">
                        <Checkbox
                            id="student-remember"
                            name="remember"
                            bind:checked={form.remember}
                        />
                        <Label for="student-remember">Ingat saya</Label>
                    </div>

                    <Button type="submit" class="w-full">Masuk</Button>
                </form>
            </Card.Content>
        </Card.Root>
    </div>
</AdminAuthLayout>
