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

export default (currentUrl: string) => ({
    'Main Menu': [
        {
            title: 'Home',
            url: '/dashboard',
            icon: HouseIcon,
            isActive: currentUrl === '/dashboard',
        },
    ],

    Pengajaran: [
        {
            title: 'Mata pelajaran saya',
            url: '/dashboard/teacher/my-courses',
            icon: BookOpenIcon,
            isActive: currentUrl.startsWith('/dashboard/teacher/my-courses'),
        },
        {
            title: 'Kelas saya',
            url: '/dashboard/teacher/classes',
            icon: SchoolIcon,
            isActive: currentUrl.startsWith('/dashboard/teacher/classes'),
        },
        {
            title: 'Jadwal saya',
            url: '/dashboard/teacher/schedule',
            icon: CalendarIcon,
            isActive: currentUrl.startsWith('/dashboard/teacher/schedule'),
        },
        {
            title: 'Materi',
            url: '/dashboard/teacher/materials',
            icon: LibraryIcon,
            isActive: currentUrl.startsWith('/dashboard/teacher/materials'),
        },
    ],

    Penilaian: [
        {
            title: 'Tugas',
            url: '/dashboard/teacher/assignments',
            icon: ClipboardListIcon,
            isActive: currentUrl.startsWith('/dashboard/teacher/assignments'),
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
            isActive: currentUrl.startsWith('/dashboard/teacher/grade-reports'),
        },
    ],

    Siswa: [
        {
            title: 'Daftar siswa',
            url: '/dashboard/teacher/students',
            icon: UsersIcon,
            isActive: currentUrl.startsWith('/dashboard/teacher/students'),
        },
        {
            title: 'Kehadiran',
            url: '/dashboard/teacher/attendance',
            icon: ClipboardCheckIcon,
            isActive: currentUrl.startsWith('/dashboard/teacher/attendance'),
        },
    ],
});
