import {
    HouseIcon,
    CalendarIcon,
    ClipboardListIcon,
    GraduationCapIcon,
    LayoutGridIcon,
} from '@lucide/svelte';

export default {
    'main menu': [
        {
            title: 'Home',
            url: '#',
            icon: HouseIcon,
            isActive: true,
        },
    ],
    'Kelas saya': [
        {
            title: 'Kelas online',
            url: '#',
            icon: LayoutGridIcon,
        },
        {
            title: 'Jadwal sekolah',
            url: '#',
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
                    url: '#',
                },
                {
                    title: 'Tugas',
                    url: '#',
                },
            ],
        },
        {
            title: 'Nilai akhir',
            url: '#',
            icon: GraduationCapIcon,
        },
    ],
};
