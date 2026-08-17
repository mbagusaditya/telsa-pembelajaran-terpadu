import { type Component } from 'svelte';

export type BreadcrumbItem = {
    label: string;
    href?: string;
};

export type DashboardItem = {
    title: string;
    url: string;
    icon?: Component;
    isActive?: boolean;
    collapsible?: boolean;
    items?: {
        title: string;
        url: string;
    }[];
};
