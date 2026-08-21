import {
    createAppColumnHelper,
    type DataTableColumnDef,
} from '@/components/core/data-table';
import { renderComponent } from '@tanstack/svelte-table';
import StudentTableStatusCell from './student-table-status-cell.svelte';

const columnHelper = createAppColumnHelper<App.Data.Student.StudentData>();

export const columns: DataTableColumnDef<App.Data.Student.StudentData, any>[] =
    columnHelper.columns([
        columnHelper.accessor('nis', {
            header: 'NIS',
        }),
        columnHelper.accessor('name', {
            header: 'Nama',
        }),
        columnHelper.accessor('admission_year', {
            header: 'Angkatan',
        }),
        columnHelper.accessor('status', {
            header: 'Status',
            cell: ({ getValue }) => {
                return renderComponent(StudentTableStatusCell, {
                    status: getValue() as any,
                });
            },
        }),
    ]);
