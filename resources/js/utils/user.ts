import type { AuthUser } from '@/types/user';

export function getUserName(authUser: AuthUser | null): string | null {
    if (!authUser) return null;

    if (authUser.role === 'admin') return authUser.profile.username;

    return authUser.profile.name;
}
