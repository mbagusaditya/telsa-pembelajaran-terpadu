<script lang="ts">
    import { Badge } from '@/components/ui/badge';

    type StatusType = 'active' | 'graduated' | 'transferred' | 'dropped_out';

    interface Props {
        status: StatusType;
    }

    let { status }: Props = $props();

    const statusConfig: Record<
        StatusType,
        {
            label: string;
            variant: 'default' | 'secondary' | 'outline' | 'destructive';
        }
    > = {
        active: { label: 'Aktif', variant: 'default' },
        graduated: { label: 'Lulus', variant: 'secondary' },
        transferred: { label: 'Pindah', variant: 'outline' },
        dropped_out: { label: 'Dikeluarkan', variant: 'destructive' },
    };

    let current = $derived(
        statusConfig[status] ?? { label: status, variant: 'outline' },
    );
</script>

<Badge variant={current.variant}>
    {current.label}
</Badge>
