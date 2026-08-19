<script lang="ts">
    import { inertia, router } from '@inertiajs/svelte';

    import {
        DataTable,
        type DataTableQuery,
    } from '@/components/core/data-table';
    import { Button } from '@/components/ui/button';

    import { columns } from './student-columns';
    import { EyeIcon, SquarePenIcon, Trash2Icon } from '@lucide/svelte';

    let {
        students,
    }: {
        students: PaginatedResponse<App.Data.Student.StudentData>;
    } = $props();

    let search = $state('');

    function onQueryChange(query: DataTableQuery) {
        router.visit('/dashboard/admin/students', {
            data: {
                search: query.search || undefined,

                page: query.page ?? 1,

                perPage: query.perPage ?? 20,
            },

            preserveState: true,
            preserveScroll: true,
        });
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

            <Button
                variant="ghost"
                size="icon"
                href={`/dashboard/admin/students/${row.id}/edit`}
            >
                <SquarePenIcon class="w-4 h-4" />
            </Button>

            <Button variant="ghost" size="icon" class="text-destructive">
                <Trash2Icon class="w-4 h-4" />
            </Button>
        </div>
    {/snippet}
</DataTable>
