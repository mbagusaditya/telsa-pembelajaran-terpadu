import {
    HouseIcon,
    CalendarIcon,
    ClipboardListIcon,
    GraduationCapIcon,
    LayoutGridIcon,
    UsersIcon,
    Building2Icon,
    BookOpenIcon,
    SchoolIcon,
    BookMarkedIcon,
} from '@lucide/svelte';

export default {
    'Main Menu': [
        {
            title: 'Home',
            url: '/dashboard',
            icon: HouseIcon,
        },
    ],

    'Master Data': [
        {
            title: 'Siswa',
            url: '/dashboard/admin/students',
            icon: GraduationCapIcon,
        },
        {
            title: 'Guru',
            url: '/dashboard/admin/teachers',
            icon: UsersIcon,
        },
        {
            title: 'Jurusan',
            url: '/dashboard/admin/majors',
            icon: Building2Icon,
        },
        {
            title: 'Mata Pelajaran',
            url: '/dashboard/admin/subjects',
            icon: BookOpenIcon,
        },
    ],

    Akademik: [
        {
            title: 'Kelas',
            url: '/dashboard/admin/class-groups',
            icon: SchoolIcon,
        },
        {
            title: 'Penawaran Mata Pelajaran',
            url: '/dashboard/admin/course-offerings',
            icon: BookMarkedIcon,
        },
    ],
};
