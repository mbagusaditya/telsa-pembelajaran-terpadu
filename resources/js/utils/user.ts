import type { AuthUser } from '@/types/user';

type User = AuthUser | App.Data.User.UserData;

export function getUserName(authUser: User | null | undefined): string | null {
    if (!authUser) return null;

    if (authUser.role === 'admin')
        return (authUser.profile as App.Data.Admin.AdminData)?.username;

    return (authUser.profile as App.Data.Student.StudentData)?.name;
}
