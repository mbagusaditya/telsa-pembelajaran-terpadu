<script lang="ts">
    import DashboardLayout from '@/layouts/dashboard.svelte';
    import StudentInfolist from '@/components/module/dashboard/admin/infolist/student-infolist.svelte';
    import { type BreadcrumbItem } from '@/types/navigation';
    import { inertia, page, router, useForm } from '@inertiajs/svelte';
    import { route } from '@/generated/helpers/route';
    import {
        ArrowLeftIcon,
        LockIcon,
        SquarePenIcon,
        Trash2Icon,
    } from '@lucide/svelte';
    import { Button, buttonVariants } from '@/components/ui/button';
    import { toast } from 'svelte-sonner';
    import DeleteConfirmation from '@/components/core/alert-dialog/delete-confirmation.svelte';
    import * as Dialog from '@/components/ui/dialog';
    import * as FormControl from '@/components/core/form-control';

    type Props = {
        title: string;
        student: App.Data.Student.StudentData;
    };

    let { title, student }: Props = $props();

    const breadcrumbItems: BreadcrumbItem[] = [
        {
            label: 'Dashboard',
            href: route('dashboard'),
        },
        {
            label: 'Daftar siswa',
            href: route('dashboard.admin.students.index'),
        },
        {
            label: student.name,
        },
    ];

    const changePasswordForm = useForm({
        password: '',
        confirmation_password: '',
        student_name: '',
    });

    // change password dialog
    let isChangePassword = $state(false);

    // delete dialog
    let isOpened = $state(false);
    let isDeleting = $state(false);

    function submitChangePassword(e: Event) {
        e.preventDefault();
    }

    function handleDelete() {
        let toastId = toast.loading('Sedang menghapus');

        router.delete(
            route('dashboard.admin.students.destroy', {
                student: student.id,
            }),
            {
                preserveScroll: true,
                onStart: () => {
                    isDeleting = true;
                },
                onFinish: () => {
                    isDeleting = false;
                    isOpened = false; // Tutup dialog

                    if (!page.flash.toast) {
                        toast.dismiss(toastId);

                        return;
                    }

                    const func = toast[page.flash.toast.type as ToastType];

                    func(page.flash.toast.message, { id: toastId });
                },
            },
        );
    }
</script>

<DashboardLayout {title} {breadcrumbItems}>
    <div class="grid grid-cols-1">
        <h2 class="text-xl font-bold mb-4">Data diri siswa</h2>

        <a
            href={route('dashboard.admin.students.index')}
            class="mb-3 underline inline-flex items-center gap-1"
            use:inertia
        >
            <ArrowLeftIcon class="size-[1.1em]" />
            Kembali ke halaman utama siswa
        </a>

        <StudentInfolist {student} />

        <div
            class="grid grid-cols-1 md:flex mt-3 flex-wrap md:justify-end gap-3"
        >
            <a
                href={route('dashboard.admin.students.edit', {
                    student: student.id,
                })}
                use:inertia
            >
                <Button class="w-full" variant="outline">
                    <SquarePenIcon />
                    Edit siswa
                </Button>
            </a>

            <Button class="" onclick={() => (isChangePassword = true)}>
                <LockIcon />
                Ubah password
            </Button>

            <Button variant="destructive" onclick={() => (isOpened = true)}>
                <Trash2Icon />
                Hapus siswa
            </Button>
        </div>
    </div>
</DashboardLayout>

<DeleteConfirmation
    {isOpened}
    {handleDelete}
    {isDeleting}
    onOpenChange={(open) => {
        if (!open) isOpened = false;
    }}
>
    {#snippet description()}
        Data siswa <strong>{student?.name}</strong> akan dihapus permanen. Tindakan
        ini tidak dapat dibatalkan.
    {/snippet}
</DeleteConfirmation>

<Dialog.Root
    open={isChangePassword}
    onOpenChange={(open) => {
        isChangePassword = open;
    }}
>
    <Dialog.Content>
        <Dialog.Header>
            <Dialog.Title>Ubah password</Dialog.Title>
            <Dialog.Description>
                Form untuk mengubah password siswa oleh admin. Isi nama siswa
                untuk konfirmasi tidak salah input.
            </Dialog.Description>
        </Dialog.Header>

        <form class="space-y-3" onsubmit={submitChangePassword}>
            <FormControl.PasswordInput
                id="student-new-password"
                label="Password baru"
                placeholder="Masukkan password baru di sini"
                bind:value={changePasswordForm.password}
                error={changePasswordForm.errors.password}
            />

            <FormControl.PasswordInput
                id="student-confirmation-password"
                label="Konfirmasi password"
                placeholder="Konfirmasi password baru di sini"
                bind:value={changePasswordForm.confirmation_password}
                error={changePasswordForm.errors.confirmation_password}
            />

            <FormControl.Input
                id="student-name"
                label="Konfirmasi nama siswa"
                placeholder="Konfirmasi nama siswa demi keamanan"
                bind:value={changePasswordForm.student_name}
                error={changePasswordForm.errors.student_name}
            />

            <div class="flex justify-end gap-3">
                <Dialog.Close
                    type="button"
                    class={buttonVariants({ variant: 'ghost' })}
                    >Batalkan</Dialog.Close
                >
                <Button type="submit">Submit</Button>
            </div>
        </form>
    </Dialog.Content>
</Dialog.Root>
