<script lang="ts">
    import * as AlertDialog from '@/components/ui/alert-dialog';
    import { type Snippet } from 'svelte';

    type Props = {
        isOpened: boolean;
        onOpenChange: (open: boolean) => void | null;
        isDeleting: boolean;
        description: Snippet<[]> | null;
        handleDelete: () => void;
    };

    let {
        isOpened,
        onOpenChange,
        isDeleting,
        description,
        handleDelete,
    }: Props = $props();
</script>

<AlertDialog.Root open={isOpened} {onOpenChange}>
    <AlertDialog.Content>
        <AlertDialog.Header>
            <AlertDialog.Title>Apakah Anda yakin?</AlertDialog.Title>
            <AlertDialog.Description>
                {@render description?.()}
            </AlertDialog.Description>
        </AlertDialog.Header>

        <AlertDialog.Footer>
            <AlertDialog.Cancel disabled={isDeleting}>Batal</AlertDialog.Cancel>
            <AlertDialog.Action
                onclick={handleDelete}
                disabled={isDeleting}
                variant="destructive"
            >
                {isDeleting ? 'Menghapus...' : 'Ya, Hapus'}
            </AlertDialog.Action>
        </AlertDialog.Footer>
    </AlertDialog.Content>
</AlertDialog.Root>
