<script lang="ts">
    import * as Card from '@/components/ui/card';
    import * as FormControl from '@/components/core/form-control';
    import { page, router, useForm } from '@inertiajs/svelte';
    import { Button } from '@/components/ui/button';
    import { toast } from 'svelte-sonner';

    let toastId = $state<string | number | undefined>(undefined);

    const form = useForm({
        name: 'lorem ipsum',
        email: 'lorem@ipsum.com',
        nik: '123333123',
        gender: 'male',
        nis: '011041',
        nisn: '12415',
        born_place: 'Jepara',
        born_date: '2004-01-01',
        admission_year: '4003',
        status: 'active',
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

        form.post('/dashboard/admin/students', {
            onFinish: () => {
                if (!page.flash.toast) return;

                const func = toast[page.flash.toast.type as ToastType];

                func(page.flash.toast.message, { id: toastId });
            },
        });
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
            router.visit('/dashboard/admin/students');
        }
    }
</script>

<Card.Root>
    <Card.Header>
        <Card.Title>Form tambah siswa</Card.Title>
    </Card.Header>

    <Card.Content>
        <form class="grid grid-cols-1 md:grid-cols-2 gap-4" {onsubmit}>
            <FormControl.Input
                id="student-name"
                label="Nama siswa"
                bind:value={form.name}
                error={form.errors.name?.[0]}
                placeholder="Masukkan nama siswa"
                required
                autofocus
            />

            <FormControl.Input
                id="student-email"
                label="Email siswa"
                bind:value={form.email}
                error={form.errors.email?.[0]}
                placeholder="Masukkan email siswa"
                required
            />

            <FormControl.Input
                id="student-nik"
                label="NIK siswa"
                bind:value={form.nik}
                error={form.errors.nik?.[0]}
                placeholder="Masukkan NIK siswa"
                required
            />

            <FormControl.Select
                id="student-gender"
                label="Jenis kelamin siswa"
                bind:value={form.gender}
                error={form.errors.gender?.[0]}
                placeholder="Masukkan jenis kelamin siswa"
                options={genderOptions}
                required
            />

            <FormControl.Input
                id="student-nis"
                label="NIS siswa"
                bind:value={form.nis}
                error={form.errors.nisn?.[0]}
                placeholder="Masukkan NIS siswa"
                required
            />

            <FormControl.Input
                id="student-nisn"
                label="NISN siswa"
                bind:value={form.nisn}
                error={form.errors.nisn?.[0]}
                placeholder="Masukkan NISN siswa"
                required
            />

            <FormControl.Input
                id="student-born-place"
                label="Tempat lahir siswa"
                bind:value={form.born_place}
                error={form.errors.born_place?.[0]}
                placeholder="Masukkan tempat lahir siswa"
                required
            />

            <FormControl.DateInput
                id="student-born-date"
                label="Tanggal lahir siswa"
                bind:value={form.born_date}
                error={form.errors.born_date?.[0]}
                placeholder="Masukkan tanggal lahir siswa"
                required
            />

            <FormControl.Input
                id="student-admission-year"
                label="Tahun masuk siswa"
                bind:value={form.admission_year}
                error={form.errors.admission_year?.[0]}
                placeholder="Masukkan tahun masuk siswa"
                required
            />

            <FormControl.Select
                id="student-status"
                label="Status siswa"
                bind:value={form.status}
                error={form.errors.status?.[0]}
                placeholder="Masukkan status siswa"
                options={statusOptions}
                required
            />

            <div class="md:col-span-2 flex gap-3 justify-end">
                <Button variant="ghost" type="button" onclick={handleCancel}
                    >Batalkan</Button
                >
                <Button
                    variant="outline"
                    type="submit"
                    disabled={form.processing}>Simpan</Button
                >
                <Button type="submit" disabled={form.processing}
                    >Simpan dan buat lagi</Button
                >
            </div>
        </form>
    </Card.Content>
</Card.Root>
