<script lang="ts">
    import DashboardLayout from '@/layouts/dashboard.svelte';
    import StudentInfolist from '@/components/module/dashboard/admin/infolist/student-infolist.svelte';
    import { type BreadcrumbItem } from '@/types/navigation';
    import { inertia } from '@inertiajs/svelte';
    import { route } from '@/generated/helpers/route';
    import { ArrowLeftIcon, SquarePenIcon, Trash2Icon } from '@lucide/svelte';
    import { Button } from '@/components/ui/button';

    type Props = {
        title: string;
        student: App.Data.Student.StudentData;
    };

    let { title, student }: Props = $props();

    const breadcrumbItems: BreadcrumbItem[] = [
        {
            label: 'Dashboard',
            href: '/dashboard',
        },
        {
            label: 'Daftar siswa',
            href: '/dashboard/admin/students',
        },
        {
            label: 'Info siswa',
        },
    ];
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
            <Button class="" variant="outline">
                <SquarePenIcon />
                Edit siswa
            </Button>

            <Button class="" variant="destructive">
                <Trash2Icon />
                Hapus siswa
            </Button>
        </div>
    </div>
</DashboardLayout>
