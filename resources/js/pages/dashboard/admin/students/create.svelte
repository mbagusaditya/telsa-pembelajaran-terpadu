<script lang="ts">
    import DashboardLayout from '@/layouts/dashboard.svelte';
    import { type BreadcrumbItem } from '@/types/navigation';
    import CreateStudentForm from '@/components/module/dashboard/admin/form/create-student-form.svelte';

    let { title } = $props();

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
            label: 'Tambah siswa',
        },
    ];
</script>

<DashboardLayout {title} {breadcrumbItems}>
    <CreateStudentForm />
</DashboardLayout>
