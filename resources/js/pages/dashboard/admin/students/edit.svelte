<script lang="ts">
    import DashboardLayout from '@/layouts/dashboard.svelte';
    import { type BreadcrumbItem } from '@/types/navigation';
    import EditStudentForm from '@/components/module/dashboard/admin/form/edit-student-form.svelte';
    import { route } from '@/generated/helpers/route';

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
            href: route('dashboard.admin.students.show', {
                student: student.id,
            }),
        },
        {
            label: 'Edit siswa',
        },
    ];
</script>

<DashboardLayout {title} {breadcrumbItems}>
    <EditStudentForm {student} />
</DashboardLayout>
