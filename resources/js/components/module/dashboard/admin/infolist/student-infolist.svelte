<script lang="ts">
    import * as FormControl from '@/components/core/form-control';

    let {
        student,
        ...restProps
    }: {
        student: App.Data.Student.StudentData;
    } = $props();

    let studentData = $derived([
        {
            label: 'Nama',
            value: student.name,
        },
        {
            label: 'NIK',
            value: student.nik,
        },
        {
            label: 'NIS',
            value: student.nis,
        },
        {
            label: 'NISN',
            value: student.nisn,
        },
        {
            label: 'Tempat lahir',
            value: student.birth_place,
        },
        {
            label: 'Tanggal lahir',
            value: student.birth_date,
        },
        {
            label: 'Jenis kelamin',
            value: student.gender,
        },
        {
            label: 'Tahun masuk',
            value: student.admission_year,
        },
        {
            label: 'Email',
            value: student.user?.email,
        },
        {
            label: 'Dibuat oleh',
            value: student.name,
        },
    ]);
</script>

<!-- {JSON.stringify(student)} -->

<div class="grid grid-cols-1 lg:grid-cols-[auto_1fr] gap-4">
    <FormControl.PreviewImage
        initialUrl={student.user?.avatar
            ? `/storage/${student.user?.avatar}`
            : null}
        aspectRatio="3:4"
        class="mx-auto md:mx-0"
    />

    <table class="h-fit">
        <tbody class="*:*:py-1 md:*:*:py-2 *:border-b *:border-muted">
            {#each studentData as data}
                <tr class="flex md:table-row flex-col py-3 md:py-0">
                    <td class="w-32 font-semibold">{data.label}</td>
                    <td class="w-2 hidden">:</td>
                    <td>
                        {data.value}
                    </td>
                </tr>
            {/each}
        </tbody>
    </table>
</div>
