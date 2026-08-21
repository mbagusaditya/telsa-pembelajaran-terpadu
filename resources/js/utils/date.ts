import {
    DateFormatter,
    parseDate,
    getLocalTimeZone,
    type DateValue,
} from '@internationalized/date';

// 1. Buat formatter untuk format tanggal panjang (contoh: "04 Juli 1988")
const longDateFormatter = new DateFormatter('id-ID', {
    day: '2-digit',
    month: 'long',
    year: 'numeric',
});

// 2. Buat formatter untuk format ringkas (contoh: "04/07/1988")
const shortDateFormatter = new DateFormatter('id-ID', {
    day: '2-digit',
    month: '2-digit',
    year: 'numeric',
});

/**
 * Format string tanggal standar SQL ("YYYY-MM-DD") atau DateValue
 */
export function formatDate(
    value: string | DateValue | null | undefined,
    format: 'long' | 'short' = 'long',
): string {
    if (!value) return '-';

    try {
        const formatter =
            format === 'long' ? longDateFormatter : shortDateFormatter;

        // Jika input berupa string "YYYY-MM-DD" (seperti dari database/Inertia)
        if (typeof value === 'string') {
            const parsed = parseDate(value);
            return formatter.format(parsed.toDate(getLocalTimeZone()));
        }

        // Jika input sudah berupa object DateValue dari date picker
        return formatter.format(value.toDate(getLocalTimeZone()));
    } catch (e) {
        return value.toString();
    }
}
