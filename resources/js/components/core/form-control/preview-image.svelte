<script lang="ts">
    import { Label } from '@/components/ui/label';
    import { ImageIcon, FileText, X } from '@lucide/svelte';

    type AspectRatio = '1:1' | '3:4' | '4:3' | '9:16' | '16:9';

    interface Props {
        id?: string;
        label?: string;
        file?: File | null;
        initialUrl?: string | null; // Untuk edit mode (misal: URL thumbnail lama dari Laravel)
        alt?: string;
        aspectRatio?: AspectRatio;
        removable?: boolean;
        class?: string;
        onRemove?: () => void;
    }

    let {
        id,
        label,
        file = $bindable(null),
        initialUrl = null,
        alt = 'Preview Gambar',
        aspectRatio = '1:1',
        removable = false,
        class: className = '',
        onRemove,
    }: Props = $props();

    let objectUrl = $state<string | null>(null);

    // Mapping aspect ratio ke utility classes Tailwind
    const aspectRatioClasses: Record<AspectRatio, string> = {
        '1:1': 'aspect-square',
        '3:4': 'aspect-[3/4]',
        '4:3': 'aspect-[4/3]',
        '9:16': 'aspect-[9/16]',
        '16:9': 'aspect-video',
    };

    let selectedAspectClass = $derived(
        aspectRatioClasses[aspectRatio] ?? 'aspect-square',
    );

    // Cek status tipe file
    let hasImageFile = $derived(file ? file.type.startsWith('image/') : false);
    let isNonImageFile = $derived(
        file ? !file.type.startsWith('image/') : false,
    );
    let hasPreview = $derived(hasImageFile || Boolean(initialUrl));

    // Sumber gambar aktif
    let previewSrc = $derived(hasImageFile ? objectUrl : initialUrl);

    // Generate Object URL dan kelola pembersihan memory (revoke)
    $effect(() => {
        if (file && file.type.startsWith('image/')) {
            const url = URL.createObjectURL(file);
            objectUrl = url;

            return () => {
                URL.revokeObjectURL(url);
                objectUrl = null;
            };
        } else {
            objectUrl = null;
        }
    });

    function handleRemove() {
        file = null;
        onRemove?.();
    }
</script>

<div class="flex flex-col gap-2 mb-3 {className}">
    {#if label}
        <Label for={id}>
            {label}
        </Label>
    {/if}

    <div class="relative w-fit">
        {#if hasPreview && previewSrc}
            <!-- Preview Gambar Aktif -->
            <div
                class="relative overflow-hidden rounded-lg border bg-muted w-64 {selectedAspectClass}"
            >
                <img
                    src={previewSrc}
                    {alt}
                    class="h-full w-full object-cover object-center rounded-lg"
                />

                {#if removable}
                    <button
                        type="button"
                        onclick={handleRemove}
                        class="absolute top-2 right-2 p-1 rounded-full bg-black/60 text-white hover:bg-destructive hover:text-destructive-foreground transition-colors shadow-sm"
                        aria-label="Hapus gambar"
                    >
                        <X class="w-4 h-4" />
                    </button>
                {/if}
            </div>
        {:else if isNonImageFile}
            <!-- Fallback Skeleton saat file non-image dipilih (layout aspect ratio tetap terjaga) -->
            <div
                class="relative flex flex-col items-center justify-center p-4 rounded-lg border border-dashed bg-muted/40 text-muted-foreground w-64 text-center {selectedAspectClass}"
            >
                <div class="p-2.5 rounded-md bg-muted mb-2 shrink-0">
                    <FileText class="w-6 h-6 text-muted-foreground" />
                </div>
                <p
                    class="text-xs font-medium text-foreground truncate max-w-[90%]"
                >
                    {file?.name}
                </p>
                <p class="text-[11px] text-muted-foreground mt-1 leading-tight">
                    Format file tidak mendukung preview
                </p>

                {#if removable}
                    <button
                        type="button"
                        onclick={handleRemove}
                        class="absolute top-2 right-2 p-1 rounded-full bg-muted-foreground/20 text-foreground hover:bg-destructive hover:text-destructive-foreground transition-colors shadow-sm"
                        aria-label="Hapus file"
                    >
                        <X class="w-4 h-4" />
                    </button>
                {/if}
            </div>
        {:else}
            <!-- Default Skeleton Placeholder saat belum ada file dipilih -->
            <div
                class="flex flex-col items-center justify-center rounded-lg border border-dashed bg-muted/30 text-muted-foreground/60 w-64 {selectedAspectClass}"
            >
                <ImageIcon
                    class="w-8 h-8 stroke-1 text-muted-foreground/40 mb-1"
                />
                <span class="text-xs text-muted-foreground/70"
                    >Tidak ada gambar</span
                >
            </div>
        {/if}
    </div>
</div>
