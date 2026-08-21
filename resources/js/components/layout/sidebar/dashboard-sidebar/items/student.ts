import {
    HouseIcon,
    CalendarIcon,
    ClipboardListIcon,
    GraduationCapIcon,
    LayoutGridIcon,
} from '@lucide/svelte';

export default (currentUrl: string) => ({
    'main menu': [
        {
            title: 'Home',
            url: '/dashboard',
            icon: HouseIcon,
            isActive: currentUrl === '/dashboard',
        },
    ],
    'Kelas saya': [
        {
            title: 'Kelas online',
            url: '/my-courses',
            isActive: currentUrl.startsWith('/dashboard/my-courses'),
            icon: LayoutGridIcon,
        },
        {
            title: 'Jadwal sekolah',
            url: '/my-schedule',
            isActive: currentUrl.startsWith('/dashboard/my-schedule'),
            icon: CalendarIcon,
        },
        {
            title: 'Tugas sekolah',
            url: '#',
            icon: ClipboardListIcon,
            collapsible: true,
            items: [
                {
                    title: 'Semua tugas',
                    url: '/all-assignments',
                    isActive: currentUrl.startsWith(
                        '/dashboard/all-assignments',
                    ),
                },
                {
                    title: 'Tugas lalu',
                    url: '/previous-assignments',
                    isActive: currentUrl.startsWith(
                        '/dashboard/previous-assignments',
                    ),
                },
            ],
        },
        {
            title: 'Nilai akhir',
            url: '/my-grades',
            icon: GraduationCapIcon,
            isActive: currentUrl.startsWith('/dashboard/my-grades'),
        },
    ],
});
