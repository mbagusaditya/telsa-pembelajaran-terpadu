import type { AuthUser } from '@/types/user';

type HttpStatusCode =
    200 | 201 | 204 | 400 | 401 | 403 | 404 | 409 | 422 | 429 | 500 | 502 | 503;

declare global {
    type ToastType = 'success' | 'error' | 'warning' | 'info';

    interface PaginatedResponse<T> {
        data: T[];
        links?: {
            first: string | null;
            last: string | null;
            prev: string | null;
            next: string | null;
        };
        meta?: {
            current_page: number;
            from: number | null;
            last_page: number;
            per_page: number;
            to: number | null;
            total: number;
        };
    }
}

declare module '@inertiajs/core' {
    export interface InertiaConfig {
        sharedPageProps: {
            auth: {
                user: AuthUser | null;
            };
            appName: string;
            httpStatusCodes: HttpStatusCode;
        };

        flashDataType: {
            toast?: {
                type: 'success' | 'error' | 'warning' | 'info';
                message: string;
                code: HttpStatusCode;
            };
        };

        errorValueType: string[];

        layoutProps: {
            title: string;
            showSidebar: boolean;
        };

        namedLayoutProps: {
            app: {
                title: string;
                theme: 'light' | 'dark';
            };
            content: {
                padding: string;
                maxWidth: string;
            };
        };
    }
}

export {};
