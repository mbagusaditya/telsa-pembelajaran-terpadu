<script lang="ts">
    import AdminAuthLayout from '@/layouts/admin-auth.svelte';
    import AdminLoginForm from '@/components/module/auth/AdminLoginForm.svelte';
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

        <AdminLoginForm />
    </div>
</AdminAuthLayout>
