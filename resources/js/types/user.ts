export type StudentProfile = {
    id: string;
    nis: string;
    nisn: string;
    name: string;
    admission_year: number;
    status: string;
};

export type TeacherProfile = {
    id: string;
    name: string;
};

export type AdminProfile = {
    id: string;
    username: string;
};

export type BaseUser = {
    id: string;
    email: string;
    avatar: string | null;
};

export type StudentUser = BaseUser & {
    role: 'student';
    profile: StudentProfile;
};

export type TeacherUser = BaseUser & {
    role: 'teacher';
    profile: TeacherProfile;
};

export type AdminUser = BaseUser & {
    role: 'admin';
    profile: AdminProfile;
};

export type AuthUser = StudentUser | TeacherUser | AdminUser;
