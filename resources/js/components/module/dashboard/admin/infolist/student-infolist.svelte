<script lang="ts">
    import * as FormControl from '@/components/core/form-control';
    import {
        GENDER_MAP,
        STUDENT_STATUS_BADGE_MAP,
        STUDENT_STATUS_MAP,
    } from '@/constants/enum';
    import { getUserName } from '@/utils/user';
    import { cn } from 'tailwind-variants';
    import { formatDate } from '@/utils/date';
    import { Badge } from '@/components/ui/badge';

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
            value: formatDate(student.birth_date, 'long'),
        },
        {
            label: 'Jenis kelamin',
            value: GENDER_MAP[student.gender],
            capitalize: true,
        },
        {
            label: 'Tahun masuk',
            value: student.admission_year,
        },
        {
            label: 'Status',
            value: STUDENT_STATUS_MAP[student.status],
            variant: STUDENT_STATUS_BADGE_MAP[student.status],
        },
        {
            label: 'Email',
            value: student.user?.email,
        },
        {
            label: 'Dibuat oleh',
            value: getUserName(student.creator),
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
                    <td class={cn(data.capitalize ? 'capitalize' : '')}>
                        {#if data.variant}
                            <Badge variant={data.variant}>
                                {data.value}
                            </Badge>
                        {:else}
                            {data.value}
                        {/if}
                    </td>
                </tr>
            {/each}
        </tbody>
    </table>
</div>
