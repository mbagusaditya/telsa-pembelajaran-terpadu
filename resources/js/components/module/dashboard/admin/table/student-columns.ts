import {
    createAppColumnHelper,
    type DataTableColumnDef,
} from '@/components/core/data-table';

import { type Student } from '@/types/models';

const columnHelper = createAppColumnHelper<Student>();

export const columns: DataTableColumnDef<Student, any>[] = columnHelper.columns(
    [
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
        }),
    ],
);
