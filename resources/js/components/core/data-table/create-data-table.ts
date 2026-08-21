import { createTableHook } from '@tanstack/svelte-table';
import { dataTableFeatures } from './features';

export const { createAppTable, createAppColumnHelper } = createTableHook({
    features: dataTableFeatures,
});
