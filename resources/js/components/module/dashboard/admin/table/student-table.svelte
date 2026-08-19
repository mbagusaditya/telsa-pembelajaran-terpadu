<script lang="ts">
    import { inertia, page, router } from '@inertiajs/svelte';

    import {
        DataTable,
        type DataTableQuery,
    } from '@/components/core/data-table';
    import { Button } from '@/components/ui/button';

    import { columns } from './student-columns';
    import { EyeIcon, SquarePenIcon, Trash2Icon } from '@lucide/svelte';
    import { route } from '@/generated/helpers/route';
    import DeleteConfirmation from '@/components/core/alert-dialog/delete-confirmation.svelte';
    import { toast } from 'svelte-sonner';

    let {
        students,
    }: {
        students: PaginatedResponse<App.Data.Student.StudentData>;
    } = $props();

    let search = $state('');
    let selectedStudent = $state<App.Data.Student.StudentData | null>(null);
    let isDeleting = $state(false);

    function onQueryChange(query: DataTableQuery) {
        router.visit(route('dashboard.admin.students.index'), {
            data: {
                search: query.search || undefined,

                page: query.page ?? 1,

                perPage: query.perPage ?? 20,
            },

            preserveState: true,
            preserveScroll: true,
        });
    }

    function handleDelete() {
        if (!selectedStudent) return;

        let toastId = toast.loading('Sedang menghapus');

        router.delete(
            route('dashboard.admin.students.destroy', {
                student: selectedStudent.id,
            }),
            {
                preserveScroll: true,
                onStart: () => {
                    isDeleting = true;
                },
                onFinish: () => {
                    isDeleting = false;
                    selectedStudent = null; // Tutup dialog

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

<DataTable
    data={students.data}
    {columns}
    pagination={students}
    bind:search
    searchPlaceholder="Cari dengan NIS / nama..."
    {onQueryChange}
>
    {#snippet toolbarActions()}
        <a href="/dashboard/admin/students/create" class="w-fit" use:inertia>
            <Button variant="default">Tambah siswa</Button>
        </a>
    {/snippet}

    {#snippet rowActions({ row })}
        <div class="flex justify-end gap-2">
            <a href={`/dashboard/admin/students/${row.id}`} use:inertia>
                <Button variant="ghost" size="icon">
                    <EyeIcon class="w-4 h-4" />
                </Button>
            </a>

            <a href={`/dashboard/admin/students/${row.id}/edit`} use:inertia>
                <Button variant="ghost" size="icon">
                    <SquarePenIcon class="w-4 h-4" />
                </Button>
            </a>

            <Button
                variant="ghost"
                size="icon"
                class="text-destructive"
                onclick={() => (selectedStudent = row)}
            >
                <Trash2Icon class="w-4 h-4" />
            </Button>
        </div>
    {/snippet}
</DataTable>

<DeleteConfirmation
    isOpened={selectedStudent !== null}
    onOpenChange={(open) => {
        if (!open) selectedStudent = null;
    }}
    {handleDelete}
    {isDeleting}
>
    {#snippet description()}
        Data siswa <strong>{selectedStudent?.name}</strong> akan dihapus permanen.
        Tindakan ini tidak dapat dibatalkan.
    {/snippet}
</DeleteConfirmation>
