import type { ColumnDef } from '@tanstack/svelte-table';

import {
    createAppColumnHelper,
    type DataTableFeatures,
} from '@/components/core/data-table';

export type Student = {
    id: number;
    name: string;
};

const columnHelper = createAppColumnHelper<Student>();

export const columns: ColumnDef<DataTableFeatures, Student>[] =
    columnHelper.columns([
        columnHelper.accessor('id', {
            header: 'ID',
        }),

        columnHelper.accessor('name', {
            header: 'Name',
        }),
    ]);
