<script lang="ts">
    import * as AlertDialog from '@/components/ui/alert-dialog';

    type Props = {
        isOpened: boolean;
        onOpenChange?: (open: boolean) => void | null;
        isSubmitting: boolean;
        handler: () => void;
    };

    let { isOpened, onOpenChange, isSubmitting, handler }: Props = $props();
</script>

<AlertDialog.Root open={isOpened} {onOpenChange}>
    <AlertDialog.Content>
        <AlertDialog.Header>
            <AlertDialog.Title>Apakah Anda yakin?</AlertDialog.Title>
            <AlertDialog.Description>
                Anda akan <strong>Sign Out</strong> sekarang. Apakah anda akan melanjutkan?
            </AlertDialog.Description>
        </AlertDialog.Header>

        <AlertDialog.Footer>
            <AlertDialog.Cancel disabled={isSubmitting}>
                Batal
            </AlertDialog.Cancel>

            <AlertDialog.Action
                onclick={handler}
                disabled={isSubmitting}
                variant="destructive"
            >
                {isSubmitting ? 'Mengirim...' : 'Ya, Lanjut'}
            </AlertDialog.Action>
        </AlertDialog.Footer>
    </AlertDialog.Content>
</AlertDialog.Root>
