<script lang="ts">
    import AuthLayout from '@/layouts/auth.svelte';
    import StudentLoginForm from '@/components/module/auth/StudentLoginForm.svelte';
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

        <StudentLoginForm />
    </div>
</AuthLayout>
