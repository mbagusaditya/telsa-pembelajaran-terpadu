export const GENDER_MAP = {
    male: 'laki-laki',
    female: 'perempuan',
} as const;

export const STUDENT_STATUS_MAP = {
    active: 'aktif',
    graduated: 'lulus',
    transferred: 'pindah',
    dropped_out: 'dikeluarkan',
} as const;

export const STUDENT_STATUS_BADGE_MAP = {
    active: 'default',
    graduated: 'default',
    transferred: 'secondary',
    dropped_out: 'destructive',
} as const;
