<script lang="ts">
    import * as Card from '@/components/ui/card';
    import * as FormControl from '@/components/core/form-control';
    import { page, router, useForm } from '@inertiajs/svelte';
    import { Button } from '@/components/ui/button';
    import { toast } from 'svelte-sonner';
    import { getPublicFile } from '@/utils/asset';
    import { route } from '@/generated/helpers/route';

    let { student }: { student: App.Data.Student.StudentData } = $props();

    let toastId = $state<string | number | undefined>(undefined);
    let shouldCreateAnother = $state<boolean | null>(null);

    const form = useForm({
        _method: 'PUT',
        name: student.name,
        email: student.user?.email,
        nik: student.nik,
        gender: student.gender,
        nis: student.nis,
        nisn: student.nisn,
        birth_place: student.birth_place,
        birth_date: student.birth_date,
        admission_year: student.admission_year,
        status: student.status,
        avatar: null as File | null,
    });

    const genderOptions = [
        {
            label: 'Laki-laki',
            value: 'male',
        },
        {
            label: 'Perempuan',
            value: 'female',
        },
    ];

    const statusOptions = [
        {
            label: 'Aktif',
            value: 'active',
        },
        {
            label: 'Lulus',
            value: 'graduated',
        },
        {
            label: 'Pindah',
            value: 'transferred',
        },
        {
            label: 'Dikeluarkan',
            value: 'dropped_out',
        },
    ];

    function onsubmit(e: SubmitEvent) {
        e.preventDefault();

        toastId = toast.loading('Sedang menyimpan');

        form.post(
            route('dashboard.admin.students.update', {
                student: student.id,
            }),
            {
                preserveScroll: true,
                forceFormData: true,
                onFinish: () => {
                    if (!page.flash.toast) {
                        toast.dismiss(toastId);

                        return;
                    }

                    const func = toast[page.flash.toast.type as ToastType];

                    func(page.flash.toast.message, { id: toastId });

                    form.reset();
                },
                onSuccess: () => {
                    if (shouldCreateAnother) {
                        form.reset();
                        form.clearErrors();
                    }
                },
            },
        );
    }

    function handleCancel() {
        // 1. Batalkan request jika form sedang dalam proses submit
        if (form.processing) {
            form.cancel();

            // Tutup atau ubah toast loading jika sedang tampil
            if (toastId) {
                toast.dismiss(toastId);
            }

            toast.info('Penyimpanan dibatalkan');
        }

        // 2. Navigasi kembali (pilih salah satu sesuai kebutuhan)
        if (window.history.length > 1) {
            window.history.back();
        } else {
            router.visit(route('dashboard.admin.students.index'));
        }
    }
</script>

<Card.Root>
    <Card.Header>
        <Card.Title>Form edit siswa</Card.Title>
    </Card.Header>

    <Card.Content>
        <form class="grid grid-cols-1 md:grid-cols-2 gap-4" {onsubmit}>
            <FormControl.Input
                id="student-name"
                label="Nama siswa"
                bind:value={form.name}
                error={form.errors.name}
                placeholder="Masukkan nama siswa"
                required
                autofocus
            />

            <FormControl.Input
                id="student-email"
                label="Email siswa"
                bind:value={form.email}
                error={form.errors.email}
                placeholder="Masukkan email siswa"
                required
            />

            <FormControl.Input
                id="student-nik"
                label="NIK siswa"
                bind:value={form.nik}
                error={form.errors.nik}
                placeholder="Masukkan NIK siswa"
                required
            />

            <FormControl.Select
                id="student-gender"
                label="Jenis kelamin siswa"
                bind:value={form.gender}
                error={form.errors.gender}
                placeholder="Masukkan jenis kelamin siswa"
                options={genderOptions}
                required
            />

            <FormControl.Input
                id="student-nis"
                label="NIS siswa"
                bind:value={form.nis}
                error={form.errors.nis}
                placeholder="Masukkan NIS siswa"
                required
            />

            <FormControl.Input
                id="student-nisn"
                label="NISN siswa"
                bind:value={form.nisn}
                error={form.errors.nisn}
                placeholder="Masukkan NISN siswa"
                required
            />

            <FormControl.Input
                id="student-born-place"
                label="Tempat lahir siswa"
                bind:value={form.birth_place}
                error={form.errors.birth_place}
                placeholder="Masukkan tempat lahir siswa"
                required
            />

            <FormControl.DateInput
                id="student-born-date"
                label="Tanggal lahir siswa"
                bind:value={form.birth_date}
                error={form.errors.birth_date}
                placeholder="Masukkan tanggal lahir siswa"
                required
            />

            <FormControl.Input
                id="student-admission-year"
                label="Tahun masuk siswa"
                bind:value={form.admission_year}
                error={form.errors.admission_year}
                placeholder="Masukkan tahun masuk siswa"
                type="number"
                required
            />

            <FormControl.Select
                id="student-status"
                label="Status siswa"
                bind:value={form.status}
                error={form.errors.status}
                placeholder="Masukkan status siswa"
                options={statusOptions}
                required
            />

            <FormControl.Dropzone
                id="student-avatar"
                label="Pas foto siswa"
                bind:file={form.avatar}
                error={form.errors.avatar}
                accept=".png,.jpg,.jpeg,.webp"
                maxSizeMb={2}
            />

            <FormControl.PreviewImage
                label="Preview avatar"
                bind:file={form.avatar}
                initialUrl={getPublicFile(student.user?.avatar)}
                aspectRatio="3:4"
                removable
            />

            <div class="md:col-span-2 flex gap-3 justify-end">
                <Button variant="ghost" type="button" onclick={handleCancel}
                    >Batalkan</Button
                >

                <Button type="submit" disabled={form.processing}>Simpan</Button>
            </div>
        </form>
    </Card.Content>
</Card.Root>
