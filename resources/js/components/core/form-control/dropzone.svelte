<script lang="ts">
    import { Label } from '@/components/ui/label';
    import { Button } from '@/components/ui/button';
    import { UploadCloud, FileText, X, AlertCircle } from '@lucide/svelte';

    interface Props {
        id: string;
        label?: string;
        error?: string | null;
        description?: string;
        accept?: string; // misal: ".pdf,.docx,.zip" atau "image/*"
        maxSizeMb?: number; // default: 10MB
        required?: boolean;
        disabled?: boolean;
        file?: File | null;
        onFileChange?: (file: File | null) => void;
    }

    let {
        id,
        label,
        error,
        description,
        accept = '.pdf,.doc,.docx,.zip,.rar',
        maxSizeMb = 10,
        required = false,
        disabled = false,
        file = $bindable(null),
        onFileChange,
    }: Props = $props();

    let isDragging = $state(false);
    let clientError = $state<string | null>(null);
    let fileInputRef = $state<HTMLInputElement | null>(null);

    // Prioritas pesan error: error dari backend (Laravel) > validasi lokal frontend
    let displayError = $derived(error || clientError);

    function formatFileSize(bytes: number): string {
        if (bytes === 0) return '0 B';

        const k = 1024;
        const sizes = ['B', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));

        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    function validateAndAssignFile(selectedFile: File) {
        clientError = null;

        // Validasi Ukuran Maksimal
        if (selectedFile.size > maxSizeMb * 1024 * 1024) {
            clientError = `Ukuran file melebihi batas maksimal (${maxSizeMb}MB)`;
            return;
        }

        file = selectedFile;
        onFileChange?.(selectedFile);
    }

    function handleFileSelect(e: Event) {
        const target = e.target as HTMLInputElement;

        if (target.files && target.files.length > 0) {
            validateAndAssignFile(target.files[0]);
        }
    }

    function handleDrop(e: DragEvent) {
        e.preventDefault();

        isDragging = false;

        if (disabled) return;

        if (e.dataTransfer?.files && e.dataTransfer.files.length > 0) {
            validateAndAssignFile(e.dataTransfer.files[0]);
        }
    }

    function handleDragOver(e: DragEvent) {
        e.preventDefault();

        if (!disabled) isDragging = true;
    }

    function handleDragLeave(e: DragEvent) {
        e.preventDefault();

        isDragging = false;
    }

    function removeFile() {
        file = null;
        clientError = null;

        if (fileInputRef) fileInputRef.value = '';

        onFileChange?.(null);
    }
</script>

<div class="flex flex-col gap-2 mb-3">
    {#if label}
        <Label for={id} class={displayError ? 'text-destructive' : ''}>
            {label}
            {#if required}
                <span class="text-red-600">*</span>
            {/if}
        </Label>
    {/if}

    <!-- Input File Tersembunyi -->
    <input
        {id}
        bind:this={fileInputRef}
        type="file"
        {accept}
        {required}
        {disabled}
        onchange={handleFileSelect}
        aria-invalid={Boolean(displayError)}
        aria-describedby={displayError ? `${id}-error` : undefined}
        class="hidden"
    />

    {#if !file}
        <!-- Area Dropzone Saat Kosong (Menggunakan Button Semantik) -->
        <button
            type="button"
            aria-label={label || 'Unggah file'}
            ondrop={handleDrop}
            ondragover={handleDragOver}
            ondragleave={handleDragLeave}
            onclick={() => fileInputRef?.click()}
            {disabled}
            class="relative flex w-full flex-col items-center justify-center p-6 border-2 border-dashed rounded-lg cursor-pointer transition-colors text-left font-normal
                    {isDragging
                ? 'border-primary bg-primary/5'
                : 'border-muted-foreground/25 hover:bg-muted/50'}
                    {displayError ? 'border-destructive bg-destructive/5' : ''}
                    {disabled ? 'opacity-60 cursor-not-allowed' : ''}"
        >
            <div
                class="flex flex-col items-center text-center space-y-2 pointer-events-none"
            >
                <div class="p-3 rounded-full bg-muted">
                    <UploadCloud class="w-6 h-6 text-muted-foreground" />
                </div>
                <div class="text-sm">
                    <span class="font-semibold text-primary"
                        >Klik untuk unggah</span
                    > atau seret file ke sini
                </div>
                <p class="text-xs text-muted-foreground">
                    Format: {accept} (Maks. {maxSizeMb}MB)
                </p>
            </div>
        </button>
    {:else}
        <!-- Tampilan File Terpilih (Preview Card) -->
        <div
            class="flex items-center justify-between p-3 border rounded-lg bg-card text-card-foreground shadow-sm"
        >
            <div class="flex items-center space-x-3 truncate">
                <div class="p-2 rounded-md bg-primary/10 text-primary shrink-0">
                    <FileText class="w-5 h-5" />
                </div>
                <div class="truncate text-left">
                    <p class="text-sm font-medium truncate">{file.name}</p>
                    <p class="text-xs text-muted-foreground">
                        {formatFileSize(file.size)}
                    </p>
                </div>
            </div>

            <Button
                type="button"
                variant="ghost"
                size="icon"
                onclick={removeFile}
                {disabled}
                class="shrink-0 text-muted-foreground hover:text-destructive"
            >
                <X class="w-4 h-4" />
            </Button>
        </div>
    {/if}

    {#if description && !displayError}
        <p class="text-xs text-muted-foreground">{description}</p>
    {/if}

    {#if displayError}
        <span
            id={`${id}-error`}
            class="text-xs font-medium text-destructive flex items-center gap-1 mt-1"
        >
            <AlertCircle class="w-3.5 h-3.5" />
            {displayError}
        </span>
    {/if}
</div>
