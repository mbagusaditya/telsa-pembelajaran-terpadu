import type { AuthUser } from '@/types/user';

type HttpStatusCode =
    200 | 201 | 204 | 400 | 401 | 403 | 404 | 409 | 422 | 429 | 500 | 502 | 503;

declare global {
    type ToastType = 'success' | 'error' | 'warning' | 'info';

    type PaginationLink = {
        url: string | null;
        label: string;
        page: number | null;
        active: boolean;
    };

    type Pagination<TData> = {
        current_page: number;
        data: TData;
        first_page_url: string;
        from: number | null;
        last_page: number;
        last_page_url: string;
        links: PaginationLink[];
        next_page_url: string | null;
        path: string;
        per_page: number;
        prev_page_url: string | null;
        to: number | null;
        total: number;
    };
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
