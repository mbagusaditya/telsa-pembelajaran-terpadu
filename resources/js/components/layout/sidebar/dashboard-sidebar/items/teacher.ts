import {
    HouseIcon,
    CalendarIcon,
    ClipboardListIcon,
    LayoutGridIcon,
    BookOpenIcon,
    SchoolIcon,
    LibraryIcon,
    FileQuestionMarkIcon,
    GraduationCapIcon,
    ChartNoAxesCombinedIcon,
    UsersIcon,
    ClipboardCheckIcon,
} from '@lucide/svelte';

export default {
    'Main Menu': [
        {
            title: 'Home',
            url: '/dashboard',
            icon: HouseIcon,
            isActive: true,
        },
    ],

    Pengajaran: [
        {
            title: 'Mata pelajaran saya',
            url: '/dashboard/teacher/my-courses',
            icon: BookOpenIcon,
        },
        {
            title: 'Kelas saya',
            url: '/dashboard/teacher/classes',
            icon: SchoolIcon,
        },
        {
            title: 'Jadwal saya',
            url: '/dashboard/teacher/schedule',
            icon: CalendarIcon,
        },
        {
            title: 'Materi',
            url: '/dashboard/teacher/materials',
            icon: LibraryIcon,
        },
    ],

    Penilaian: [
        {
            title: 'Tugas',
            url: '/dashboard/teacher/assignments',
            icon: ClipboardListIcon,
        },
        // {
        //     title: 'Ujian',
        //     url: '/dashboard/teacher/exams',
        //     icon: FileQuestionMarkIcon,
        // },
        // {
        //     title: 'Nilai',
        //     url: '/dashboard/teacher/grades',
        //     icon: GraduationCapIcon,
        // },
        {
            title: 'Rekap nilai',
            url: '/dashboard/teacher/grade-reports',
            icon: ChartNoAxesCombinedIcon,
        },
    ],

    Siswa: [
        {
            title: 'Daftar siswa',
            url: '/dashboard/teacher/students',
            icon: UsersIcon,
        },
        {
            title: 'Kehadiran',
            url: '/dashboard/teacher/attendance',
            icon: ClipboardCheckIcon,
        },
    ],
};
