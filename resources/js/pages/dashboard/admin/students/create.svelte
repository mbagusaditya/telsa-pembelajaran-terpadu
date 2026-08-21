<script lang="ts">
    import DashboardLayout from '@/layouts/dashboard.svelte';
    import { type BreadcrumbItem } from '@/types/navigation';
    import CreateStudentForm from '@/components/module/dashboard/admin/form/create-student-form.svelte';
    import { route } from '@/generated/helpers/route';

    let { title } = $props();

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
            label: 'Tambah siswa',
        },
    ];
</script>

<DashboardLayout {title} {breadcrumbItems}>
    <CreateStudentForm />
</DashboardLayout>
