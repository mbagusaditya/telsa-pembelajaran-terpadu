export function getUserName(authUser: AuthUser): string {
    if (authUser.role === 'admin') return authUser.profile.username;

    return authUser.profile.name;
}
