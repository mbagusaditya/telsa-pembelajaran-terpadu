<script lang="ts">
    import DashboardLayout from '@/layouts/dashboard.svelte';
    import StudentInfolist from '@/components/module/dashboard/admin/infolist/student-infolist.svelte';
    import { type BreadcrumbItem } from '@/types/navigation';
    import { inertia, page, router } from '@inertiajs/svelte';
    import { route } from '@/generated/helpers/route';
    import { ArrowLeftIcon, SquarePenIcon, Trash2Icon } from '@lucide/svelte';
    import { Button } from '@/components/ui/button';
    import { toast } from 'svelte-sonner';
    import DeleteConfirmation from '@/components/core/alert-dialog/delete-confirmation.svelte';

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

    let isOpened = $state(false);
    let isDeleting = $state(false);

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

        <div class="flex mt-3 justify-end gap-3">
            <a
                href={route('dashboard.admin.students.edit', {
                    student: student.id,
                })}
                use:inertia
            >
                <Button class="" variant="outline">
                    <SquarePenIcon />
                    Edit siswa
                </Button>
            </a>

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
