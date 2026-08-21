export type StudentStatus =
    'active' | 'graduated' | 'transferred' | 'dropped_out';

export interface UserSummary {
    id: string;
    name: string;
    email: string;
}

export interface Student {
    id: string;
    nik: string;
    nis: string;
    nisn: string;
    name: string;
    born_date: string; // Format ISO date string 'YYYY-MM-DD'
    born_place: string;
    birth_info?: string; // Helper dari Resource: 'Tempat, Tanggal Lahir'
    age?: number | null;
    admission_year: number;
    status: StudentStatus;
    user_id: string | null;
    created_by: string | null;

    // Relasi kondisional (whenLoaded)
    user?: UserSummary | null;
    creator?: UserSummary | null;

    // Timestamps
    created_at: string;
    updated_at: string;
    created_at_formatted?: string;
}
