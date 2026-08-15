<script lang="ts">
    import AuthLayout from '@/layouts/auth.svelte';
    import * as Card from '@/components/ui/card';
    import { Input } from '@/components/ui/input';
    import * as InputGroup from '@/components/ui/input-group';
    import { Label } from '@/components/ui/label';
    import { Button } from '@/components/ui/button';
    import { Checkbox } from '@/components/ui/checkbox';
    import { EyeIcon, EyeOffIcon } from '@lucide/svelte';
    import { useForm } from '@inertiajs/svelte';

    let isPasswordRevealed = $state(false);

    const form = useForm({
        nis: null,
        password: null,
        remember: false,
    }).dontRemember('password');

    function submit(e: Event) {
        e.preventDefault();

        form.post('/auth/login');
    }
</script>

<AuthLayout>
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
                Portal Web SMK Tunas harapan
            </h1>

            <h4 class="text-normal text-center">Masuk sebagai siswa</h4>
        </header>

        <Card.Root
            class="w-full sm:w-[70%] mx-auto lg:shadow-none lg:ring-0 lg:p-0 lg:rounded-none lg:overflow-visible"
        >
            <Card.Content class="lg:p-0">
                <form onsubmit={submit}>
                    <div class="flex flex-col gap-2 mb-3">
                        <Label for="student-nis">
                            NIS <span class="text-red-600">*</span>
                        </Label>

                        <Input
                            name="nis"
                            id="student-nis"
                            bind:value={form.nis}
                            aria-invalid={Boolean(form.errors.nis)}
                        />

                        {#if form.errors.nis}
                            <span class="text-destructive text-normal">
                                {form.errors.nis}
                            </span>
                        {/if}
                    </div>

                    <div class="flex flex-col gap-2 mb-3">
                        <Label for="student-password">
                            Password <span class="text-red-600">*</span>
                        </Label>

                        <InputGroup.Root>
                            <InputGroup.Input
                                type={isPasswordRevealed ? 'text' : 'password'}
                                name="password"
                                id="student-password"
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
</AuthLayout>
