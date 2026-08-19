<script lang="ts">
    import * as FormControl from '@/components/core/form-control';

    let { student } = $props();

    let studentData = $derived([
        {
            label: 'Nama',
            value: student.data.name,
        },
        {
            label: 'NIK',
            value: student.data.nik,
        },
        {
            label: 'NIS',
            value: student.data.nis,
        },
        {
            label: 'NISN',
            value: student.data.nisn,
        },
        {
            label: 'Tempat lahir',
            value: student.data.birth_place,
        },
        {
            label: 'Tanggal lahir',
            value: student.data.birth_date,
        },
        {
            label: 'Jenis kelamin',
            value: student.data.gender,
        },
        {
            label: 'Tahun masuk',
            value: student.data.admission_year,
        },
        {
            label: 'Email',
            value: student.data.user.email,
        },
        {
            label: 'Dibuat oleh',
            value: student.data.name,
        },
    ]);
</script>

<!-- {JSON.stringify(student)} -->

<div class="grid grid-cols-1 lg:grid-cols-[auto_1fr] gap-4">
    <FormControl.PreviewImage
        initialUrl={student.data.user.avatar
            ? `/storage/${student.data.user.avatar}`
            : null}
        aspectRatio="3:4"
    />

    <table class="h-fit">
        <colgroup>
            <col class="w-32" />
            <col class="w-2" />
            <col />
        </colgroup>
        <tbody class="*:*:py-2 *:border-b *:border-muted">
            {#each studentData as data}
                <tr>
                    <td>{data.label}</td>
                    <td>:</td>
                    <td>
                        {data.value}
                    </td>
                </tr>
            {/each}
        </tbody>
    </table>
</div>
