import { page } from '@inertiajs/svelte';
import {
    HouseIcon,
    GraduationCapIcon,
    UsersIcon,
    Building2Icon,
    BookOpenIcon,
    SchoolIcon,
    BookMarkedIcon,
} from '@lucide/svelte';

export default (currentUrl: string) => ({
    'Main Menu': [
        {
            title: 'Home',
            url: '/dashboard',
            isActive: currentUrl === '/dashboard',
            icon: HouseIcon,
        },
    ],

    'Master Data': [
        {
            title: 'Siswa',
            url: '/dashboard/admin/students',
            isActive: currentUrl.startsWith('/dashboard/admin/students'),
            icon: GraduationCapIcon,
        },
        {
            title: 'Guru',
            url: '/dashboard/admin/teachers',
            isActive: currentUrl.startsWith('/dashboard/admin/teachers'),
            icon: UsersIcon,
        },
        {
            title: 'Jurusan',
            url: '/dashboard/admin/majors',
            isActive: currentUrl.startsWith('/dashboard/admin/majors'),
            icon: Building2Icon,
        },
        {
            title: 'Mata Pelajaran',
            url: '/dashboard/admin/subjects',
            isActive: currentUrl.startsWith('/dashboard/admin/subjects'),
            icon: BookOpenIcon,
        },
    ],

    Akademik: [
        {
            title: 'Kelas',
            url: '/dashboard/admin/class-groups',
            isActive: currentUrl.startsWith(
                '/dashboard/admin/admin/class-groups',
            ),
            icon: SchoolIcon,
        },
        {
            title: 'Penawaran Mata Pelajaran',
            url: '/dashboard/admin/course-offerings',
            isActive: currentUrl.startsWith(
                '/dashboard/admin/course-offerings',
            ),
            icon: BookMarkedIcon,
        },
    ],
});
